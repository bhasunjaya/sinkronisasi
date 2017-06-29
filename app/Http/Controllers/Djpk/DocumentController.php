<?php

namespace App\Http\Controllers\Djpk;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use Symfony\Component\Process\Process as Process;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $documents = \App\Document::with('subbidang')
            ->where('is_processed', false)
            ->get();

        return view('djpk.document.index', compact('documents'));
    }

    public function listKegiatan(Request $request, $id)
    {
        return \App\Kegiatan::where('subbidang_id', $id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        dd($listPemda);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oMessages = [];
        $rules = [
            'subbidang_id' => 'required',
            'file' => 'required',
        ];
        $message = [
            'subbidang_id.required' => "Harus memilih subbidang",
            'file.required' => "Harus memilih file excell yang akan di upload",
            'file.mimes' => "File harus berformat excell",
        ];
        $this->validate($request, $rules, $message);

        $path = $request->file->store('uploads');
        // dd($path);

        $subbidang_id = $request->subbidang_id;
        $kegiatan_id = $request->kegiatan_id;
        $jenis = $request->jenis;

        $document = new Document;
        $document->subbidang_id = $request->subbidang_id;
        $document->kegiatan_id = $request->kegiatan_id;
        $document->kegiatan_id = $request->kegiatan_id;
        $document->jenis = $request->jenis;
        $document->nama = $path;
        $document->save();

        return redirect('djpk/document')->withMessage('File telah terupload');

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

    public function download(Request $request)
    {
        return response()->download(app_path('../data/TEMPLATE-UPLOAD.xlsx'));
    }
}
