<?php

function hitungTipeTotal($pemda, $jenis)
{
    $gg = DB::table('usulans')
        ->where('pemda_id', $pemda)
        ->where('jenis', $jenis)
        ->select(DB::raw('count(output) as toutput,sum(dana) as tdana'))
        ->first();
    return $gg;
}

function hitungBidangTotal($pemda, $jenis)
{
    $gg = DB::table('usulans')
        ->where('pemda_id', $pemda)
        ->where('jenis', $jenis)
        ->groupBy('bidang_id')
        ->select(DB::raw('bidang_id,count(output) as output,sum(dana) as dana'))
        ->get();

    $data = [];
    foreach ($gg as $r) {
        $data[$r->bidang_id] = ['output' => $r->output, 'dana' => $r->dana];
    }
    return $data;
}
