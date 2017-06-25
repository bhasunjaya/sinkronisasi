<?php

function hitungTotalOutputTipe($data, $tipe) {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe) {
			$total += $r->output;
		}
	}

	return $total ?: '';
}

function hitungTotalOutputDana($data, $tipe) {

	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe) {
			$total += $r->dana;
		}
	}
	return $total ?: '';
}

function hitungTotalOutputBidang($data, $tipe, $bidang_id) {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->bidang_id == $bidang_id) {
			$total += $r->output;
		}
	}

	return $total ?: '';
}

function hitungTotalDanaBidang($data, $tipe, $bidang_id) {

	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->bidang_id == $bidang_id) {
			$total += $r->dana;
		}
	}
	return $total ?: '';
}

function hitungTotalOutputSubbidang($data, $tipe, $subbidang_id) {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->subbidang_id == $subbidang_id) {
			$total += $r->output;
		}
	}

	return $total ?: '';
}

function hitungTotalDanaSubbidang($data, $tipe, $subbidang_id) {

	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->subbidang_id == $subbidang_id) {
			$total += $r->dana;
		}
	}
	return $total ?: '';
}

function hitungTotalOutputKegiatan($data, $tipe, $kegiatan_id) {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->kegiatan_id == $kegiatan_id) {
			$total += $r->output;
		}
	}

	return $total ?: '';
}

function hitungTotalDanaKegiatan($data, $tipe, $kegiatan_id) {

	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->kegiatan_id == $kegiatan_id) {
			$total += $r->dana;
		}
	}
	return $total ?: '';
}

function getAllUsulanPerBidang($pemda) {
	$results = DB::table('usulans')
		->where('pemda_id', $pemda)
		->groupBy('jenis', 'bidang_id', 'subbidang_id', 'kegiatan_id')
		->select(DB::raw('jenis,bidang_id,subbidang_id,kegiatan_id,sum(output) as output,sum(dana) as dana'))
		->get();
	return $results;
}

/**
 * Mendapatkan data kl untuk daerah itu
 */

function getKlByTipe($data, $tipe, $mode = "") {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe) {
			$total += $r->$mode;
		}
	}

	return $total ?: '';
}

/**
 * Mendapatkan data kl per bidang untuk daerah itu
 */

function getKlByBidang($data, $tipe, $bidang_id, $mode = "") {
	$total = 0;
	foreach ($data as $r) {

		if ($r->jenis == $tipe && $r->bidang_id == $bidang_id) {
			$total += $r->$mode;
		}
	}

	return $total ?: '';
}

/**
 * Mendapatkan data kl per bidang untuk daerah itu
 */

function getKlBySubbidang($data, $tipe, $subbidang_id, $mode = "") {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->subbidang_id == $subbidang_id) {
			$total += $r->$mode;
		}
	}

	return $total ?: '';
}

function getKlByKegiatan($data, $tipe, $kegiatan_id) {
	$total = 0;
	foreach ($data as $r) {
		if ($r->jenis == $tipe && $r->kegiatan_id == $kegiatan_id) {
			return $r;
		}
	}

	return null;
}
