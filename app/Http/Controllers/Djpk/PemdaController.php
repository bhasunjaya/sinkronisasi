<?php

namespace App\Http\Controllers\Djpk;

use App\Http\Controllers\Controller;
use App\Pemda;
use Illuminate\Http\Request;

class PemdaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemdas = Pemda::all();
        return view('djpk.pemda.index', compact('pemdas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('djpk.pemda.create');
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
            'prov' => 'required',
            'kab' => 'required',
            'nama' => 'required',
            'idpemda' => 'required|numeric',
        ], [
            'prov.required' => 'Kode Provinsi Harus Diisi',
            'kab.required' => 'Kode Kab/Kota Harus Diisi',
            'nama.required' => 'Nama Harus Diisi',
            'idpemda.required' => 'ID Pemda Harus Diisi',
            'idpemda.numeric' => 'ID Pemda Harus Angka',
        ]);

        $pemda = new Pemda;
        $pemda->prov = $request->prov;
        $pemda->kab = $request->kab;
        $pemda->nama = $request->nama;
        $pemda->idpemda = $request->idpemda;
        $pemda->save();

        return redirect('djpk/pemda')->withStatus('Data Pemda sukses bertambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pemda $pemda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemda $pemda)
    {
        return view('djpk.pemda.edit', compact('pemda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemda $pemda)
    {
        $this->validate($request, [
            'prov' => 'required',
            'kab' => 'required',
            'nama' => 'required',
            'idpemda' => 'required|numeric',
        ], [
            'prov.required' => 'Kode Provinsi Harus Diisi',
            'kab.required' => 'Kode Kab/Kota Harus Diisi',
            'nama.required' => 'Nama Harus Diisi',
            'idpemda.required' => 'ID Pemda Harus Diisi',
            'idpemda.numeric' => 'ID Pemda Harus Angka',
        ]);

        $pemda->prov = $request->prov;
        $pemda->kab = $request->kab;
        $pemda->nama = $request->nama;
        $pemda->idpemda = $request->idpemda;
        $pemda->save();

        return redirect('djpk/pemda')->withStatus('Data Pemda sukses diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemda $pemda)
    {
        $pemda->delete();
        return $pemda->id;
    }
}
