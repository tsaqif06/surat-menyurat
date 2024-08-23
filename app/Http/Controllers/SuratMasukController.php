<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Relasi;
use App\Models\JenisSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\RuangPenyimpanan;
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
        dd($request->input());
        try {
            // Log::info($request->all());

            // Log::info('Update Surat Masuk request data:', $request->all());
            $suratMasuk = SuratMasuk::findOrFail($id);
    
            if ($request->hasFile('file_surat')) {
                $file = $request->file('file_surat');
                $filePath = $file->store('surat_masuk_files');
                Log::info('File uploaded to: ' . $filePath);
                $suratMasuk->file_surat = $filePath;
            }
            
    
            // Update other fields
            $suratMasuk->update($request->except(['file_surat']));
    
            return response()->json(['message' => 'Surat Masuk updated successfully.']);
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
            $suratMasuk->delete();
            return response()->json(['message' => 'Surat Masuk deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Surat Masuk.'], 500);
        }
    }
}
