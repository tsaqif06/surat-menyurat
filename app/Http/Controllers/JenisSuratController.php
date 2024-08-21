<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Http\Requests\StoreJenisSuratRequest;
use App\Http\Requests\UpdateJenisSuratRequest;

class JenisSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenissurats = JenisSurat::all();
        return view('pages.jenissurat.index', ['jenissurats' => $jenissurats]);
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
     * @param  \App\Http\Requests\StoreJenisSuratRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJenisSuratRequest $request)
    {
        try {
            JenisSurat::create($request->validated());
            return response()->json(['message' => 'Jenis Surat created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Jenis Surat.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisSurat  $jenisSurat
     * @return \Illuminate\Http\Response
     */
    public function show($jenisSurat)
    {
        $jenisSurat = JenisSurat::findOrFail($jenisSurat);
        return response()->json($jenisSurat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisSurat  $jenisSurat
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJenisSuratRequest  $request
     * @param  \App\Models\JenisSurat  $jenisSurat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJenisSuratRequest $request, $id)
    {
        try {
            $jenisSurat = JenisSurat::findOrFail($id);
            $jenisSurat->update($request->validated());
            return response()->json(['message' => 'jenis Surat updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update jenis Surat.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisSurat  $jenisSurat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jenisSurat = JenisSurat::findOrFail($id);
            $jenisSurat->delete();
            return response()->json(['message' => 'jenis Surat deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete jenis Surat.'], 500);
        }
    }
}
