<?php

namespace App\Http\Controllers\Djpk;

use App\Bappenas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BappenasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bappenas = Bappenas::orderBy('nama')->get();
        return view('djpk.bappenas.index', compact('bappenas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('djpk.bappenas.create');
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

        $bappena = new Bappenas;
        $bappena->nama = $request->nama;
        $bappena->save();

        return redirect('djpk/bappenas')->withStatus('Data Bappenas sukses bertambah');
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
    public function edit(Bappenas $bappena)
    {
        return view('djpk.bappenas.edit', compact('bappena'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bappenas $bappena)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $bappena->nama = $request->nama;
        $bappena->save();

        return redirect('djpk/bappenas')->withStatus('Data Bappenas sukses terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bappenas $bappena)
    {
        return $bappena->id;
    }
}
