<?php
/**
 * Menampilkan angka dengan format indonesia
 *
 * @param  float/numeric number
 * @return string
 */
function angka($number)
{
    $number = $number + 0;
    if (strpos($number, '.')) {
        return number_format($number, 2, ',', '.');
    } else {
        return number_format($number, 0, ',', '.');
    }

}

/**
 * Mencari pemda_id dari user yang login
 *
 * @return integer
 */
function getPemdaIdFromAuth()
{
    $userpemda = \DB::table('pemda_user')->where('user_id', Auth::id())->first();
    return object_get($userpemda, 'pemda_id', false);
}

function getUserDinasFromAuth()
{
    return Auth::user()->role->object_id;
}

function getFlagSinkronisasi($sinkronisasi)
{
    if ($sinkronisasi->pemdadata) {
        return $sinkronisasi->is_flag_bappenas || $sinkronisasi->is_flag_kl ?
        '<span class="label label-danger">butuh diskusi</span>' :
        ' <span class="label label-success">confirmed</span>';
    }

}

function getUserBidang()
{
    \DB::table('bidang_dinas')
        ->where('dinas_id', $dinas_id)
        ->pluck('bidang_id');
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
