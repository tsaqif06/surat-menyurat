<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Relasi;
use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\RuangPenyimpanan;
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

    public function uploadFile(Request $request)
    {
        try {
            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');
                // Simpan file ke storage public suratmasuk
                $filePath = $file->store('public/suratmasuk'); // simpan di storage/app/public/suratmasuk
                $fileUrl = Storage::url($filePath); // Mendapatkan URL yang bisa diakses publik

                return response()->json(['message' => 'File uploaded successfully.', 'file_url' => $fileUrl]);
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

            // Atur nilai file_surat jika ada file yang diunggah
            if ($request->hasFile('file_surat')) {
                $validatedData['file_surat'] = $request->file('file_surat')->store('file_surat');
            } else {
                $validatedData['file_surat'] = null;
            }

            SuratMasuk::create($validatedData);
            return response()->json(['message' => 'Surat Masuk created successfully.'], 201);
        } catch (\Exception $e) {
            \Log::error('Failed to create Surat Masuk: ' . $e->getMessage());
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
            // Temukan record Surat Masuk yang akan di-update
            $suratMasuk = SuratMasuk::findOrFail($id);

            // Jika ada file baru yang diunggah
            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                // Simpan file ke dalam storage
                $filePath = $file->store('surat_masuk_files');

                // Hapus file lama jika ada
                if ($suratMasuk->file_surat && \Storage::exists($suratMasuk->file_surat)) {
                    \Storage::delete($suratMasuk->file_surat);
                }

                // Update path file baru ke database
                $suratMasuk->file_surat = $filePath;
            }

            // Update fields lainnya
            $suratMasuk->update($request->except(['file_surat']));

            // Berikan respon sukses
            return response()->json(['message' => 'Surat Masuk updated successfully.']);
        } catch (\Exception $e) {
            // Logging error untuk debugging
            Log::error('Error updating Surat Masuk: ' . $e->getMessage());

            // Berikan respon error kepada pengguna
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
            $suratMasuk->delete();
            return response()->json(['message' => 'Surat Masuk deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Surat Masuk.'], 500);
        }
    }
}
