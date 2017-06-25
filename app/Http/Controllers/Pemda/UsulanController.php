<?php

namespace App\Http\Controllers\Pemda;

use App\Bidang;
use App\Http\Controllers\Controller;
use App\Kldata;
use Illuminate\Http\Request;

class UsulanController extends Controller {

	public function index(Request $request) {

		// return $this->postIndex($request);
		// return $dd;
		return view('pemda.usulan.index');

	}
	public function postIndex(Request $request) {
		$pemda_id = 1;
		$danas = getAllUsulanPerBidang($pemda_id);
		$kldatas = Kldata::wherePemdaId($pemda_id)->get();
		$bidangs = Bidang::with('subbidangs.kegiatans')->get();

		// return $kldatas;

		$all = [];
		$tipes = ['reguler', 'penugasan', 'afirmasi'];

		foreach ($tipes as $tipe) {
			$ins = [];
			$ins['level'] = 1;
			$ins['label'] = ['level' => 1, 'label' => $tipe];
			$ins['output'] = hitungTotalOutputTipe($danas, $tipe);
			$ins['dana'] = hitungTotalOutputDana($danas, $tipe);

			$ins['kl_output'] = getKlByTipe($kldatas, $tipe, 'output');
			$ins['kl_target'] = '';
			$ins['kl_lokasi'] = '';
			$all[] = $ins;

			foreach ($bidangs as $bidang) {
				$ins = [];
				$ins['level'] = 2;
				$ins['label'] = ['level' => 2, 'label' => $bidang->nama];
				$ins['output'] = hitungTotalOutputBidang($danas, $tipe, $bidang->id);
				$ins['dana'] = hitungTotalDanaBidang($danas, $tipe, $bidang->id);
				$ins['kl_output'] = getKlByBidang($kldatas, $tipe, 'output');
				$ins['kl_target'] = '';
				$ins['kl_lokasi'] = '';

				\Debugbar::log(hitungTotalDanaBidang($danas, $tipe, $bidang->id));

				if (array_get($ins, 'output', false)) {
					$all[] = $ins;

					foreach ($bidang->subbidangs as $subbidang) {

						$ins = [];
						$ins['level'] = 3;
						$ins['label'] = ['level' => 3, 'label' => $subbidang->nama];
						$ins['output'] = hitungTotalOutputSubbidang($danas, $tipe, $subbidang->id);
						$ins['dana'] = hitungTotalDanaSubbidang($danas, $tipe, $subbidang->id);

						$ins['kl_output'] = getKlBySubbidang($kldatas, $tipe, $subbidang->id, 'output');
						$ins['kl_target'] = '';
						$ins['kl_lokasi'] = '';

						if (array_get($ins, 'output', false)) {
							$all[] = $ins;

							foreach ($subbidang->kegiatans as $kegiatan) {
								$ins = [];
								$ins['level'] = 4;
								$ins['label'] = ['level' => 4, 'label' => $kegiatan->kegiatan];
								$ins['output'] = hitungTotalOutputKegiatan($danas, $tipe, $kegiatan->id);
								$ins['dana'] = hitungTotalDanaKegiatan($danas, $tipe, $kegiatan->id);

								$oKlData = getKlByKegiatan($kldatas, $tipe, $kegiatan->id);
								$ins['kl_output'] = object_get($oKlData, 'volume', '');
								$ins['kl_target'] = object_get($oKlData, 'target', '');
								$ins['kl_lokasi'] = object_get($oKlData, 'lokasi', '');

								// $ins['kl_output'] = $tipe;
								// $ins['kl_target'] = $kegiatan->id;
								// $ins['kl_lokasi'] = 'ss';

								if (array_get($ins, 'output', false)) {
									$all[] = $ins;
								}
							}
						}
					}
				}

			}
		}

		return $all;

	}

}
