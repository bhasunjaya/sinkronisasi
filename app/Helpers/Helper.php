<?php
function prefixActive($prefix, $output = 'open active')
{
    if (Route::getCurrentRoute()->getPrefix() == $prefix) {
        return $output;
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
