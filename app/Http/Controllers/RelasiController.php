<?php

namespace App\Http\Controllers;

use App\Models\Relasi;
use App\Http\Requests\StoreRelasiRequest;
use App\Http\Requests\UpdateRelasiRequest;

class RelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relasis = Relasi::all();
        return view('pages.relasi.index', ['relasis' => $relasis]);
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
     * @param  \App\Http\Requests\StoreRelasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRelasiRequest $request)
    {
        try {
            Relasi::create($request->validated());
            return response()->json(['message' => 'Relasi created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Relasi.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function show(Relasi $relasi)
    {
        return response()->json($relasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Relasi $relasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRelasiRequest  $request
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRelasiRequest $request, Relasi $relasi)
    {
        try {
            $relasi->update($request->validated());
            return response()->json(['message' => 'Relasi updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update Relasi.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relasi $relasi)
    {
        try {
            $relasi->delete();
            return response()->json(['message' => 'Relasi deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Relasi.'], 500);
        }
    }
}
