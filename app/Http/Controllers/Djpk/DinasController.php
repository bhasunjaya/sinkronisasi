<?php

namespace App\Http\Controllers\Djpk;

use App\Dinas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dinas = Dinas::all();
        return view('djpk.dinas.index', compact('dinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('djpk.dinas.create');
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

        $dina = new Dinas;
        $dina->nama = $request->nama;
        $dina->save();

        return redirect('djpk/dinas')->withStatus('Data Dinas sukses bertambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dinas $dina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dinas $dina)
    {
        return view('djpk.dinas.edit', compact('dina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dinas $dina)
    {

        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi',
        ]);

        $dina->nama = $request->nama;
        $dina->save();

        return redirect('djpk/dinas')->withStatus('Data Dinas sukses terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dinas $dina)
    {
        $dina->delete();
        return $dina->id;
    }
}
