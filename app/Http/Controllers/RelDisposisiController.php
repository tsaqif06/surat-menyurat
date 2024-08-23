<?php

namespace App\Http\Controllers;

use App\Models\RelDisposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\StoreRelDisposisiRequest;
use App\Http\Requests\UpdateRelDisposisiRequest;

class RelDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $since = $request->input('since');
        $until = $request->input('until');

        $query = RelDisposisi::query();

        $query->with('suratMasuk');

        if ($since && $until) {
            $query->whereHas('suratMasuk', function ($query) use ($since, $until) {
                $query->whereBetween('tanggal_disposisi', [$since, $until]);
            });
        }

        $disposisis = $query->get();

        return view('pages.ldisposisi.index', [
            'disposisis' => $disposisis,
            'since' => $since,
            'until' => $until,
            'query' => $request->getQueryString(),
        ]);
    }

    public function print(Request $request)
    {
        $agenda = __('menu.agenda.menu');
        $letter = __('menu.agenda.incoming_letter');
        $title = App::getLocale() == 'id' ? "$agenda $letter" : "$letter $agenda";

        $since = $request->input('since');
        $until = $request->input('until');

        $query = RelDisposisi::query();

        $query->with('suratMasuk');

        if ($since && $until) {
            $query->whereHas('suratMasuk', function ($query) use ($since, $until) {
                $query->whereBetween('tanggal_disposisi', [$since, $until]);
            });
        }

        $disposisis = $query->get();

        return view('pages.ldisposisi.print', [
            'disposisis' => $disposisis,
            'since' => $since,
            'until' => $until,
            'title' => $title,
        ]);
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
     * @param  \App\Http\Requests\StoreRelDisposisiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRelDisposisiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RelDisposisi  $relDisposisi
     * @return \Illuminate\Http\Response
     */
    public function show(RelDisposisi $relDisposisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RelDisposisi  $relDisposisi
     * @return \Illuminate\Http\Response
     */
    public function edit(RelDisposisi $relDisposisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRelDisposisiRequest  $request
     * @param  \App\Models\RelDisposisi  $relDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRelDisposisiRequest $request, RelDisposisi $relDisposisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RelDisposisi  $relDisposisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelDisposisi $relDisposisi)
    {
        //
    }
}
