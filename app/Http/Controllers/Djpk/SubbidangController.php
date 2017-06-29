<?php

namespace App\Http\Controllers\Djpk;

use App\Http\Controllers\Controller;
use App\Subbidang;
use Illuminate\Http\Request;

class SubbidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subbidangs = Subbidang::with('bidang')->orderBy('bidang_id')->get();
        return view('djpk.subbidang.index', compact('subbidangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('djpk.subbidang.create');
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
            'bidang_id' => 'required',
            'nama' => 'required',
        ], [
            'bidang_id.required' => 'Bidang Harus Diisi',
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $subbidang = new Subbidang;
        $subbidang->bidang_id = $request->bidang_id;
        $subbidang->nama = $request->nama;
        $subbidang->save();

        return redirect('djpk/subbidang')->withStatus('Data Sub bidang sukses bertambah');
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
    public function edit(Subbidang $subbidang)
    {
        return view('djpk.subbidang.edit', compact('subbidang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subbidang $subbidang)
    {
        $this->validate($request, [
            'bidang_id' => 'required',
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
            'bidang_id.required' => 'Nama Harus Diisi',
        ]);

        $subbidang->bidang_id = $request->nama;
        $subbidang->nama = $request->nama;
        $subbidang->save();

        return redirect('djpk/subbidang')->withStatus('Data subbidang sukses terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subbidang $subbidang)
    {
        $subbidang->delete();
        return $subbidang->id;
    }
}
