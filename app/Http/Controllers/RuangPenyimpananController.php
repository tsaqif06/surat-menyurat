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
        return view('pages.ruang.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function show(RuangPenyimpanan $ruangPenyimpanan)
    {
        //
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
    public function update(UpdateRuangPenyimpananRequest $request, RuangPenyimpanan $ruangPenyimpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RuangPenyimpanan  $ruangPenyimpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RuangPenyimpanan $ruangPenyimpanan)
    {
        //
    }
}
