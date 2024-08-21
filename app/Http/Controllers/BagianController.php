<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Http\Requests\StoreBagianRequest;
use App\Http\Requests\UpdateBagianRequest;

class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagians = Bagian::all();
        return view('pages.bagian.index', ['bagians' => $bagians]);
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
     * @param  \App\Http\Requests\StoreBagianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBagianRequest $request)
    {
        try {
            Bagian::create($request->validated());
            return response()->json(['message' => 'Bagian created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create Bagian.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function show(Bagian $bagian)
    {
        return response()->json($bagian);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function edit(Bagian $bagian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBagianRequest  $request
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBagianRequest $request, Bagian $bagian)
    {
        try {
            $bagian->update($request->validated());
            return response()->json(['message' => 'Bagian updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update Bagian.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian)
    {
        try {
            $bagian->delete();
            return response()->json(['message' => 'Bagian deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Bagian.'], 500);
        }
    }
}
