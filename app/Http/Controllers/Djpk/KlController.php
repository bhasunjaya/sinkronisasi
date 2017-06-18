<?php

namespace App\Http\Controllers\Djpk;

use App\Http\Controllers\Controller;
use App\Kl;
use Illuminate\Http\Request;

class KlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kls = Kl::orderBy('nama', 'asc')->get();
        return view('djpk.kl.index', compact('kls'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('djpk.kl.create');
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

        $kl = new Kl;
        $kl->nama = $request->nama;
        $kl->save();

        return redirect('djpk/kl')->withStatus('Data K/L sukses bertambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kl $kl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kl $kl)
    {
        return view('djpk.kl.edit', compact('kl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kl $kl)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $kl->nama = $request->nama;
        $kl->save();

        return redirect('djpk/kl')->withStatus('Data K/L sukses terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kl $kl)
    {
        $kl->delete();
        return $kl->id;
    }
}
