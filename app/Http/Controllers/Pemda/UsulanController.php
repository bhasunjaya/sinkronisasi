<?php

namespace App\Http\Controllers\Pemda;

use App\Bidang;
use App\Http\Controllers\Controller;
use App\Kldata;
use App\Subbidang;
use DB;
use Illuminate\Http\Request;

class UsulanController extends Controller
{

    public function postIndex(Request $request)
    {
        $pemda_id = 1;

        $bidangs = Bidang::with('subbidangs')->get();

        $tipe = ['reguler', 'penugasan', 'afirmasi'];
        $alldata = [];
        foreach ($tipe as $t) {
            $total = hitungTipeTotal($pemda_id, $t);
            $data = [];
            $data['label'] = $t;
            $data['output'] = object_get($total, 'touput', 0);
            $data['dana'] = object_get($total, 'tdana', 0);
            $alldata[] = $data;

            // //bidang
            foreach ($bidangs as $b) {
                $total = hitungBidangTotal($pemda_id, $t, $b->id);
                $data = [];
                $data['label'] = $b->nama;
                $data['output'] = object_get($total, 'output');
                $data['dana'] = object_get($total, 'dana');
                if ($data['output']) {
                    $alldata[] = $data;
                }
            }

        }

        return $alldata;

    }
    public function postIndex2(Request $request)
    {
        $pemda_id = 69;
        $space = "";
        $allBidang = [];
        $allSubbidang = [];
        foreach (Bidang::all() as $b) {
            $allBidang[strtolower($b->nama)] = $b->id;
        }
        foreach (Subbidang::with('bidang')->get() as $b) {
            $allSubbidang[strtolower($b->bidang->nama . $b->nama)] = $b->id;
        }

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

        $kldata = Kldata::where('pemda_id', $pemda_id)->get();
        return $dd;
        $all = [];
        foreach ($dd as $tipe => $r) {
            $all[] = [
                getTipeText($tipe),
                getTipeTotal($r, 'cv'),
                getTipeTotal($r, 'sd'),
                getTipeTotalKL($kldata, $tipe),
            ];
            foreach ($r as $bidang => $rBidang):
                $all[] = [
                    $bidang,
                    getBidangTotal($rBidang, 'cv'),
                    getBidangTotal($rBidang, 'sd'),
                    getTipeTotalKLBidang($allBidang, $kldata, $bidang),
                ];

                foreach ($rBidang as $sub => $rSub):
                    $all[] = [
                        $sub,
                        getBidangSub($rSub, 'cv'),
                        getBidangSub($rSub, 'sd'),
                        getTipeTotalKLSubBidang($allSubbidang, $kldata, $bidang, $sub),
                    ];

                    foreach ($rSub as $e):
                        $all[] = [
                            $e->kegiatan,
                            number_format($e->cv, 2, ',', '.'),
                            number_format($e->sd, 2, ',', '.'),
                            // number_format($kldata->volume, 2, ',', '.'),
                            // $kldata->volume,
                            getKlData($bidang, $sub),
                            $kldata->target,
                            $kldata->lokasi,
                        ];
                    endforeach;
                endforeach;

            endforeach;
        }
        return $all;
    }
    public function index(Request $request)
    {

        return $this->postIndex($request);
        // return $dd;
        return view('pemda.usulan.index');

    }

}
