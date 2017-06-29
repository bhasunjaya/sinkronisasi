<?php
function angka($number)
{
    $number = $number + 0;
    if (strpos($number, '.')) {
        return number_format($number, 2, ',', '.');
    } else {
        return number_format($number, 0, ',', '.');
    }

}
function getTipeTotal($o, $m)
{
    $total = 0;
    foreach ($o as $bidang => $rBidang) {
        foreach ($rBidang as $sub => $rSub) {
            foreach ($rSub as $e) {
                $total += $e->$m;
            }
        }
    }
    return number_format($total, 2, ',', '.');
}
function getBidangTotal($rBidang, $m)
{
    $total = 0;
    foreach ($rBidang as $sub => $rSub) {
        foreach ($rSub as $e) {
            $total += $e->$m;
        }
    }
    return number_format($total, 2, ',', '.');
}
function getBidangSub($rSub, $m)
{
    $total = 0;
    foreach ($rSub as $e) {
        $total += $e->$m;
    }
    return number_format($total, 2, ',', '.');
}

function getTipeText($t)
{
    switch ($t) {
        case 'penugasan':
            return 'Dana Alokasi Penugasan';
            break;
        case 'reguler':
            return 'Dana Alokasi Reguler';
            break;

        default:
            return 'Dana Alokasi Afirmasi';
            break;
    }
}

function getSelectDak()
{
    $ddDak = [
        'reguler' => 'DAK REGULER',
        'penugasan' => 'DAK PENUGASAN',
        'afirmasi' => 'DAK AFIRMASI',
    ];
    return $ddDak;
}

function getSelectBidang()
{
    // return [
    //     'Cats' => ['leopard' => 'Leopard', 'wwwleopard' => 'wwwLeopard'],
    //     'Dogs' => ['spaniel' => 'Spaniel'],
    // ];
    $bidangs = \App\Bidang::orderBy('id')
        ->with('subbidangs')->get();
    $listing = [];
    foreach ($bidangs as $row) {
        $ele = [];
        foreach ($row->subbidangs as $r) {
            $listing[$row->nama][$r->id] = $r->nama;
        }
    }
    return $listing;
}

function getTipeTotalKL($data, $tipe)
{
    $total = 0;
    $kl = [];
    foreach ($data as $r) {
        if ($r->jenis == $tipe) {
            $total += $r->volume;
        }
    }
    return $total;
}

function getTipeTotalKLBidang($allBidang, $data, $bidang)
{
    $total = 0;
    $kl = [];
    $bid = $allBidang[strtolower($bidang)];
    foreach ($data as $r) {
        if ($r->bidang_id == $bid) {
            $total += $r->volume;
        }
    }
    return $total;
}

function getTipeTotalKLSubBidang($allSubbidang, $data, $bidang, $sub)
{
    $total = 0;
    $kl = [];
    $bid = $allSubbidang[strtolower($bidang . $sub)];
    foreach ($data as $r) {
        if ($r->subbidang_id == $bid) {
            $total += $r->volume;
        }
    }
    return $total;
}

function getKlData($bidang, $sub)
{
    dd($bidang, $sub);
    $bid = $allSubbidang[strtolower($bidang . $sub)];
    foreach ($data as $r) {
        if ($r->jenis == $jenis && $kegiatan_id == $r->kegiatan_id) {
            return $r->$param;
        }
    }
}
