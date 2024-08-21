<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
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
    public function update(UpdateSuratKeluarRequest $request, SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        //
    }
}
