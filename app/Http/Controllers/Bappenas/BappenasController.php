<?php

namespace App\Http\Controllers\Bappenas;

use App\Http\Controllers\Controller;
use App\Sinkronisasi;
use App\User;
use Auth;
use DB;
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
        $kl_id = Auth::user()->role->object_id;
        $bidangs = DB::table('bidang_kl')->where('kl_id', $kl_id)->pluck('bidang_id');

        $pemda = \App\Pemda::find($pemda_id);
        $sinkronisasis = Sinkronisasi::with('kegiatan.subbidang.bidang', 'kldata')
            ->where('pemda_id', $pemda_id)
            ->whereIn('bidang_id', $bidangs)
            ->get();

        return view('bappenas.bappenas.pemda', compact('sinkronisasis', 'pemda'));
    }

    public function sinkronisasi($id)
    {
        $sinkronisasi = Sinkronisasi::find($id);
        return view('bappenas.bappenas.sinkronisasi', compact('sinkronisasi'));
    }

    public function confirm(Request $request)
    {
        $sinkronisasi = Sinkronisasi::find($request->sinkronisasi_id);
        $sinkronisasi->is_flag_bappenas = $request->flag;
        $sinkronisasi->bappenas_note = $request->note;
        $sinkronisasi->save();
        return redirect('bappenas/sinkronisasi/' . $sinkronisasi->id)->withMessage('Data Telah Diupdate');

    }
}
