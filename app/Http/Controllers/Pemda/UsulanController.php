<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use App\Usulan;
use DB;
use Illuminate\Http\Request;

class UsulanController extends Controller
{

    public function index(Request $request)
    {
        $pemda_id = 69;
        $sql = "SELECT jenis,bidangs.nama as nbidang, subbidangs.nama as nsub, usulans.kegiatan, count(usulans.output) as cv, sum(usulans.dana) as sd FROM `usulans` LEFT JOIN kegiatans ON kegiatans.id = usulans.kegiatan_id LEFT JOIN subbidangs ON subbidangs.id = kegiatans.subbidang_id LEFT JOIN bidangs ON bidangs.id = subbidangs.bidang_id WHERE pemda_id=69 GROUP BY jenis,nbidang,nsub";
        $gg = DB::table('usulans')
            ->where('pemda_id', $pemda_id)
            ->groupBy('jenis', 'bidang', 'sub', 'kegiatan')
            ->leftJoin('kegiatans', 'usulans.kegiatan_id', '=', 'kegiatans.id')
            ->leftJoin('subbidangs', 'subbidangs.id', '=', 'kegiatans.subbidang_id')
            ->leftJoin('bidangs', 'bidangs.id', '=', 'subbidangs.bidang_id')
            ->select(DB::raw('jenis,bidangs.nama as bidang,
    subbidangs.nama as sub,
    kegiatans.kegiatan,
    count(usulans.output) as cv,
    sum(usulans.dana) as sd '))
            ->get();
        $d = $gg->groupBy('jenis');
        $cc = [];
        $dd = [];
        foreach ($d as $k => $v) {
            $cc[$k] = $v->groupBy('bidang');
            foreach ($cc[$k] as $l => $x) {
                $dd[$k][$l] = $x->groupBy('sub');
            }
        }

        // return $dd;

        return view('pemda.usulan.index', compact('dd'));

    }

    public function inde2x(Request $request)
    {

        $pemda_id = 69;

        $gg = Usulan::where('pemda_id', $pemda_id)
            ->groupBy('jenis', 'pemda_id', 'kegiatan_id')
            ->select(DB::raw('jenis,pemda_id,kegiatan_id,
            count(output) as cv,sum(dana) as sd'))
            ->get();

        $collect = [];
        $listKegiatans = [];
        $total = 0;
        $total_sd = 0;
        $total_cv = 0;
        foreach ($gg as $g) {
            $listKegiatans[] = $g->kegiatan_id;
            $col = ['jenis' => $g->jenis, 'kegiatan_id' => $g->kegiatan_id, 'cv' => $g->cv, 'sd' => $g->sd];
            $collect[] = $col;
        }

        $collection = collect($collect);
        $colgroup = $collection->groupBy('jenis');

        $rd = [];
        $total_cv = 0;
        $total_sd = 0;
        foreach ($colgroup as $tipe => $c) {
            $total_cv += getTotal($c, 'cv');
            $total_sd += getTotal($c, 'sd');
            $t = [];
            $t['title'] = $tipe;
            $t['total_cv'] = $total_cv;
            $t['total_sd'] = $total_sd;
            $t['data'] = $c;
            $rd[] = $t;
        }
        return $rd;

        // return $data;

        $lookupKegiatan = Kegiatan::with('subbidang.bidang')->whereIn('id', $listKegiatans)->get();
        $mKegiatans = [];
        foreach ($lookupKegiatan as $r) {
            $mKegiatans[$r->id] = $r;
        }
        return $mKegiatans;
        // dd($data);
        return view('pemda.usulan.index', compact('data', 'mKegiatans'));
    }
}
