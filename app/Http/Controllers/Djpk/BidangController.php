<?php

namespace App\Http\Controllers\Djpk;

use App\Bidang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidangs = Bidang::orderBy('nama')->get();
        return view('djpk.bidang.index', compact('bidangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('djpk.bidang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $bidang = new Bidang;
        $bidang->nama = $request->nama;
        $bidang->save();

        return redirect('djpk/bidang')->withStatus('Data Bidang sukses bertambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bidang $bidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidang $bidang)
    {

        return view('djpk.bidang.edit', compact('bidang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidang $bidang)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $bidang->nama = $request->nama;
        $bidang->save();

        return redirect('djpk/bidang')->withStatus('Data bidang sukses terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidang $bidang)
    {
        $bidang->delete();
        return $bidang->id;
    }
}
