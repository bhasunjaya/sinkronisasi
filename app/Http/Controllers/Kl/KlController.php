<?php

namespace App\Http\Controllers\Kl;

use App\Http\Controllers\Controller;
use App\Sinkronisasi;
use Illuminate\Http\Request;

class KlController extends Controller
{
    public function review(Request $request)
    {

        return view('kl.kl.review');

    }

    public function pemda(Request $request, $pemda_id)
    {

        $pemda_id = 1;
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

        return view('kl.kl.pemda', compact('sinkronisasis', 'pemda'));
    }

    public function sinkronisasi($id)
    {
        $sinkronisasi = Sinkronisasi::find($id);
        return view('kl.kl.sinkronisasi', compact('sinkronisasi'));
    }
}
