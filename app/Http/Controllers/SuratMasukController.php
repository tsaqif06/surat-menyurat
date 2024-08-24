<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Relasi;
use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\RuangPenyimpanan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relasis = Relasi::all();
        $bagians = Bagian::all();
        $ruangPenyimpanans = RuangPenyimpanan::all();
        $jenisSurats = JenisSurat::all();
        $suratmasuks = SuratMasuk::all();
        return view('pages.suratmasuk.index', ['suratmasuks' => $suratmasuks, 'relasis' => $relasis, 'bagians' => $bagians, 'ruangPenyimpanans' => $ruangPenyimpanans, 'jenisSurats' => $jenisSurats]);
    }

    public function persetujuan()
    {

        $suratmasuks = SuratMasuk::whereNotNull('tanggal_disposisi')->get();
        return view('pages.pdisposisi.index', ['suratmasuks' => $suratmasuks]);
    }

    public function setuju($id)
    {
        try {
            $suratMasuk = SuratMasuk::findOrFail($id);
            $suratMasuk->status_surat = 2;
            $suratMasuk->save();

            return response()->json(['message' => 'Surat berhasil disetujui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyetujui surat.'], 500);
        }
    }

    // Handle Tolak
    public function tolak($id)
    {
        try {
            $suratMasuk = SuratMasuk::findOrFail($id);
            $suratMasuk->status_surat = 0;
            $suratMasuk->save();

            return response()->json(['message' => 'Surat berhasil ditolak.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menolak surat.'], 500);
        }
    }

    public function uploadFile(Request $request, $id)
    {
        try {
            // Temukan surat masuk berdasarkan ID
            $suratMasuk = SuratMasuk::findOrFail($id);

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                if ($suratMasuk->file_surat && Storage::exists(str_replace('storage/', 'public/', $suratMasuk->file_surat))) {
                    Storage::delete(str_replace('storage/', 'public/', $suratMasuk->file_surat));
                }

                // Simpan file ke storage public suratmasuk
                $filePath = $file->store('public/suratmasuk');

                // Simpan path file ke kolom file_surat di database
                $suratMasuk->file_surat = str_replace('public/', 'storage/', $filePath);
                $suratMasuk->save();

                return response()->json(['message' => 'Done successfully.']);
            } else {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error uploading file: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to upload file.'], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSuratMasukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuratMasukRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                // Simpan file ke dalam storage
                $filePath = $file->store('surat_masuk_files');

                $validatedData['file_surat'] = $filePath;
            }

            $validatedData['tanggal_surat_masuk'] = now();

            $suratMasuk = SuratMasuk::create($validatedData);

            return response()->json([
                'message' => 'Surat Masuk created successfully.',
                'id_surat_masuk' => $suratMasuk->id_surat_masuk, // Mengembalikan ID
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create Surat Masuk: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create Surat Masuk.'], 500);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show($suratMasuk)
    {
        $suratMasuk = SuratMasuk::findOrFail($suratMasuk);
        return response()->json($suratMasuk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuratMasukRequest  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $suratMasuk = SuratMasuk::findOrFail($id);

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                $filePath = $file->store('surat_masuk_files');

                if ($suratMasuk->file_surat && Storage::exists($suratMasuk->file_surat)) {
                    Storage::delete($suratMasuk->file_surat);
                }

                $suratMasuk->file_surat = $filePath;
            }

            $suratMasuk->update($request->except(['file_surat']));

            return response()->json([
                'message' => 'Surat Masuk updated successfully.',
                'id_surat_masuk' => $suratMasuk->id_surat_masuk,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating Surat Masuk: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to update Surat Masuk.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $suratMasuk = SuratMasuk::findOrFail($id);

            if ($suratMasuk->file_surat && Storage::exists(str_replace('storage/', 'public/', $suratMasuk->file_surat))) {
                Storage::delete(str_replace('storage/', 'public/', $suratMasuk->file_surat));
            }

            $suratMasuk->delete();

            return response()->json(['message' => 'Surat Masuk deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting Surat Masuk: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete Surat Masuk.'], 500);
        }
    }
}
