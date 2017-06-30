<?php

namespace App\Http\Controllers\Kl;

use App\Http\Controllers\Controller;
use App\Kl;
use App\Sinkronisasi;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class KlController extends Controller
{
    public function review(Request $request)
    {

        return view('kl.kl.review');

    }

    public function pemda(Request $request)
    {

        Auth::login(User::find(7590));

        $kl_id = Auth::user()->role->object_id;
        $bidangs = DB::table('bidang_kl')->where('kl_id', $kl_id)->pluck('bidang_id');
        $pemda_id = $request->pemda_id;

        $pemda = \App\Pemda::find($pemda_id);
        $sinkronisasis = Sinkronisasi::with('kegiatan.subbidang.bidang', 'kldata')
            ->where('pemda_id', $pemda_id)
            ->whereIn('bidang_id', $bidangs)
            ->get();

        // return $sinkronisasis;

        return view('kl.kl.pemda', compact('sinkronisasis', 'pemda'));
    }

    public function sinkronisasi($id)
    {
        $sinkronisasi = Sinkronisasi::find($id);
        return view('kl.kl.sinkronisasi', compact('sinkronisasi'));
    }

    public function confirm(Request $request)
    {
        $sinkronisasi = Sinkronisasi::find($request->sinkronisasi_id);
        $sinkronisasi->is_flag_kl = $request->flag;
        $sinkronisasi->kl_note = $request->note;
        $sinkronisasi->save();
        return redirect('kl/sinkronisasi/' . $sinkronisasi->id)->withMessage('Data Telah Diupdate');

    }
}
