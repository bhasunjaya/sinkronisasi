<?php

namespace App\Http\Controllers\Kl;

use App\Http\Controllers\Controller;
use App\Kldata;
use Illuminate\Http\Request;

class KldataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemda_id = 1;

        $bidang['reguler'] = [13, 1, 5, 14];
        $bidang['penugasan'] = [1, 4, 5, 14];
        $bidang['afirmasi'] = [4, 5, 13, 14];
        $allbidangs = [1, 4, 5, 13, 14];

        $kldatas = Kldata::with('subbidang.bidang')
            ->whereIn('bidang_id', $allbidangs)
            ->where('pemda_id', $pemda_id)
            ->get();
        // return $kldatas;
        return view('kl.kldata.index', compact('kldatas'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
