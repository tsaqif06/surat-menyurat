<?php

namespace App\Http\Controllers;

use App\Models\RuangPenyimpanan;
use App\Http\Requests\StoreRuangPenyimpananRequest;
use App\Http\Requests\UpdateRuangPenyimpananRequest;

class RuangPenyimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangpenyimpanans = RuangPenyimpanan::all();
        return view('pages.ruang.index', ['ruangpenyimpanans' => $ruangpenyimpanans]);
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
     * @param  \App\Http\Requests\StoreRuangPenyimpananRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRuangPenyimpananRequest $request)
    {
        try {
            RuangPenyimpanan::create($request->validated());
            return response()->json(['message' => 'Ruang Penyimpanan created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Ruang Penyimpanan.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function show($ruangPenyimpanan)
    {
        $ruangPenyimpanan = RuangPenyimpanan::findOrFail($ruangPenyimpanan);
        return response()->json($ruangPenyimpanan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(RuangPenyimpanan $ruangPenyimpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRuangPenyimpananRequest  $request
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRuangPenyimpananRequest $request, $id)
    {
        try {
            $ruangPenyimpanan = RuangPenyimpanan::findOrFail($id);
            $ruangPenyimpanan->update($request->validated());
            return response()->json(['message' => 'Ruang Penyimpanan updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update Ruang Penyimpanan.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ruangPenyimpanan = RuangPenyimpanan::findOrFail($id);
            $ruangPenyimpanan->delete();
            return response()->json(['message' => 'Ruang Penyimpanan deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Ruang Penyimpanan.'], 500);
        }
    }
}
