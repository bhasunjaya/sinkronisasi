<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use App\Kldata;
use App\Pemdadata;
use App\Sinkronisasi;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bidang['all'] = [6];

        $bidang['reguler'] = [13, 1, 5, 14];
        $bidang['penugasan'] = [1, 14, 4, 5];
        $bidang['afirmasi'] = [13, 14, 1];
        $pemda_id = 1;

        $sinkronisasis = Sinkronisasi::with('kldata', 'pemdadata', 'kegiatan.subbidang.bidang')
            ->whereIn('bidang_id', $bidang['all'])
            ->where('pemda_id', $pemda_id)
            ->orderBy('jenis')
            ->orderBy('bidang_id')
            ->get();
        // return $sinkronisasis;

        return view('pemda.entry.index', compact('sinkronisasis'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            return 'cea';
            //data sinkronisasi
            //data kl
            //data pemda

        } else {

            return view('pemda.entry.show', compact('id'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $this->validate($request, [
            'prioritas' => 'required',
            'volume' => 'required',
            'satuan' => 'required',
            'unit_cost' => 'required',
            'dana' => 'required',
            'target' => 'required',
        ], [
            'prioritas.required' => 'Prioritas harus diisi',
            'volume.required' => 'Volume harus diisi',
            'satuan.required' => 'Satuan harus diisi',
            'unit_cost.required' => 'Unit Cost harus diisi',
            'dana.required' => 'Kebutuhan dana harus diisi',
            'target.required' => 'target pencapaian harus diisi',
        ]);
        $sinkronisasi = Sinkronisasi::findOrFail($id);
        // return $sinkronisasi;

        $pemdadata = Pemdadata::where('sinkronisasi_id', $id)->first();
        // return $pemdadata;
        if (!$pemdadata) {
            $pemdadata = new Pemdadata;
        }

        // dd(json_encode($request->lokasi));

        $pemdadata->sinkronisasi_id = $id;
        $pemdadata->pemda_id = $request->pemda_id;
        $pemdadata->bidang_id = $request->bidang_id;
        $pemdadata->subbidang_id = $request->subbidang_id;
        $pemdadata->kegiatan_id = $request->kegiatan_id;
        $pemdadata->jenis = $request->jenis;
        $pemdadata->volume = $request->volume;
        $pemdadata->satuan = $request->satuan;
        $pemdadata->unit_cost = $request->unit_cost;
        $pemdadata->target = $request->target;
        $pemdadata->prioritas = $request->prioritas;
        $pemdadata->lokasi = json_encode($request->lokasi);
        $pemdadata->save();

        $sinkronisasi->is_entry_pemda = true;
        $sinkronisasi->save();
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

    public function getDataEntry($id)
    {
        $sinkronisasi = Sinkronisasi::with('kegiatan.subbidang.bidang')
            ->where('id', $id)
            ->first();

        $kldata = Kldata::where('pemda_id', $sinkronisasi->pemda_id)
            ->where('bidang_id', $sinkronisasi->bidang_id)
            ->where('kegiatan_id', $sinkronisasi->kegiatan_id)
            ->where('subbidang_id', $sinkronisasi->subbidang_id)
            ->where('jenis', $sinkronisasi->jenis)
            ->first();

        $pemdadata = Pemdadata::where('sinkronisasi_id', $sinkronisasi->id)->first();

        return [
            'sinkronisasi' => $sinkronisasi,
            'kldata' => $kldata,
            'pemdadata' => $pemdadata,
        ];
    }
}
