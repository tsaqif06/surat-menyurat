<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Relasi;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Models\RuangPenyimpanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreSuratKeluarRequest;
use App\Http\Requests\UpdateSuratKeluarRequest;

class SuratKeluarController extends Controller
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
        $suratkeluars = SuratKeluar::all();
        return view('pages.suratkeluar.index', ['suratkeluars' => $suratkeluars, 'relasis' => $relasis, 'bagians' => $bagians, 'ruangPenyimpanans' => $ruangPenyimpanans, 'jenisSurats' => $jenisSurats]);
    }

    public function persetujuan()
    {

        $suratkeluars = SuratKeluar::all();
        return view('pages.approve.index', ['suratkeluars' => $suratkeluars]);
    }

    public function setuju($id)
    {
        try {
            $suratKeluar = SuratKeluar::findOrFail($id);
            $suratKeluar->status_surat = 2;
            $suratKeluar->save();

            return response()->json(['message' => 'Surat berhasil disetujui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyetujui surat.'], 500);
        }
    }

    // Handle Tolak
    public function tolak($id)
    {
        try {
            $suratKeluar = SuratKeluar::findOrFail($id);
            $suratKeluar->status_surat = 0;
            $suratKeluar->save();

            return response()->json(['message' => 'Surat berhasil ditolak.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menolak surat.'], 500);
        }
    }

    public function uploadFile(Request $request, $id)
    {
        try {
            // Temukan surat keluar berdasarkan ID
            $suratkeluar = SuratKeluar::findOrFail($id);

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                if ($suratkeluar->file_surat && Storage::exists(str_replace('storage/', 'public/', $suratkeluar->file_surat))) {
                    Storage::delete(str_replace('storage/', 'public/', $suratkeluar->file_surat));
                }

                // Simpan file ke storage public suratkeluar
                $filePath = $file->store('public/suratkeluar');

                // Simpan path file ke kolom file_surat di database
                $suratkeluar->file_surat = str_replace('public/', 'storage/', $filePath);
                $suratkeluar->save();

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
     * @param  \App\Http\Requests\StoreSuratKeluarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSuratKeluarRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                // Simpan file ke dalam storage
                $filePath = $file->store('surat_keluar_files');

                $validatedData['file_surat'] = $filePath;
            }

            $validatedData['tanggal_surat_keluar'] = now();

            $suratkeluar = SuratKeluar::create($validatedData);

            return response()->json([
                'message' => 'Surat Keluar created successfully.',
                'id_surat_keluar' => $suratkeluar->id_surat_keluar, // Mengembalikan ID
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to create Surat Keluar: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create Surat Keluar.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show($suratKeluar)
    {
        $suratKeluar = SuratKeluar::findOrFail($suratKeluar);
        return response()->json($suratKeluar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuratKeluarRequest  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $suratkeluar = SuratKeluar::findOrFail($id);

            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');

                $filePath = $file->store('surat_keluar_files');

                if ($suratkeluar->file_surat && Storage::exists($suratkeluar->file_surat)) {
                    Storage::delete($suratkeluar->file_surat);
                }

                $suratkeluar->file_surat = $filePath;
            }

            $suratkeluar->update($request->except(['file_surat']));

            return response()->json([
                'message' => 'Surat Keluar updated successfully.',
                'id_surat_keluar' => $suratkeluar->id_surat_keluar,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating Surat Keluar: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to update Surat Keluar.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $suratkeluar = SuratKeluar::findOrFail($id);
            $suratkeluar->delete();
            return response()->json(['message' => 'Surat Keluar deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Surat Keluar.'], 500);
        }
    }
}
