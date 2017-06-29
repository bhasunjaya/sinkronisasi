<?php

namespace App\Http\Controllers\Bappenas;

use App\Http\Controllers\Controller;
use App\Sinkronisasi;
use Illuminate\Http\Request;

class BappenasController extends Controller
{
    public function verivikasi(Request $request)
    {
        return view('bappenas.bappenas.verivikasi');
    }

    public function review(Request $review)
    {
        return view('bappenas.bappenas.review');
    }

    public function pemda(Request $request)
    {

        $pemda_id = $request->pemda_id;
        $bidang['all'] = [2];
        // $bidang['all'] = [13, 1, 5, 4, 14];
        $bidang['reguler'] = [13, 1, 5, 14];
        $bidang['penugasan'] = [1, 14, 4, 5];
        $bidang['afirmasi'] = [13, 14, 1];

        $pemda = \App\Pemda::find($pemda_id);
        $sinkronisasis = Sinkronisasi::with('kegiatan.subbidang.bidang', 'kldata')
            ->where('pemda_id', $pemda_id)
            ->whereIn('bidang_id', $bidang['all'])
            ->get();

        return view('bappenas.bappenas.pemda', compact('sinkronisasis', 'pemda'));
    }

    public function sinkronisasi($id)
    {
        $sinkronisasi = Sinkronisasi::find($id);
        return view('bappenas.bappenas.sinkronisasi', compact('sinkronisasi'));
    }
}
