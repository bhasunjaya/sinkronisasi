<?php

namespace App\Http\Controllers\Djpk;

use App\Http\Controllers\Controller;
use App\Kldata;
use App\Pemda;
use App\Subbidang;
use Excel;
use Illuminate\Http\Request;

class DocumentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		// return getSelectBidang();
		return view('djpk.document.index');
	}

	public function listKegiatan(Request $request, $id) {
		return \App\Kegiatan::where('subbidang_id', $id)->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

		dd($listPemda);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$rules = [
			'subbidang_id' => 'required',
			'file' => 'required|mimes:xls,xlsx',
		];
		$message = [
			'subbidang_id.required' => "Harus memilih subbidang",
			'file.required' => "Harus memilih file excell yang akan di upload",
			'file.mimes' => "File harus berformat excell",
		];
		$this->validate($request, $rules, $message);

		$path = $request->file->store('uploads');

		$subbidang_id = $request->subbidang_id;
		$kegiatan_id = $request->kegiatan_id;
		$jenis = $request->jenis;
		$oSubbidang = Subbidang::find($subbidang_id);
		// return $oSubbidang;

		config([
			'excel.import.heading' => false,
			// 'excel.import.startRow' => 5,
		]);
		// config(['excel.import.startRow' => 1]);
		// $path = "app/" . "uploads/U4adCMJgXgPrrjQiEAYePT2dfoYr3AQ2Z9GNdjWH.xlsx";
		$rows = Excel::selectSheetsByIndex(0)->load(storage_path($path), function ($reader) {

		})->skip(4)->get();

		//prepare all the daerah
		$listPemda = [];
		$pemdas = Pemda::all();
		foreach ($pemdas as $p) {
			$listPemda[$p->prov][$p->kab] = $p->id;
		}
		foreach ($rows as $r) {
			// dd($rows);
			if (isset($listPemda[$r[1]][$r[2]])) {

				$matchPemdaId = $listPemda[$r[1]][$r[2]];
			} else {
				dd($r);
			}
			// dd($matchPemdaId);
			$kldata = Kldata::where([
				'subbidang_id' => $subbidang_id,
				'kegiatan_id' => $kegiatan_id,
				'jenis' => $jenis,
				'pemda_id' => $matchPemdaId,
			])->first();
			$ins = [];
			if ($r[5] && $r[6] && $r[7]) {

				if (!$kldata) {

					$ins['pemda_id'] = $matchPemdaId;
					$ins['bidang_id'] = $oSubbidang->bidang_id;
					$ins['subbidang_id'] = $subbidang_id;
					$ins['kegiatan_id'] = $kegiatan_id;
					$ins['jenis'] = $jenis;
					$ins['volume'] = $r[5];
					$ins['satuan'] = $r[6];
					$ins['unit_cost'] = $r[7];
					$ins['target'] = $r[9];
					$ins['lokasi'] = $r[10];
					Kldata::create($ins);
				} else {
					$kldata->update($ins);
				}
			}

		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
