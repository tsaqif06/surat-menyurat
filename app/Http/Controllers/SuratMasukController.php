<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
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
        return view('pages.suratmasuk.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
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
    public function update(UpdateSuratMasukRequest $request, SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        //
    }
}
