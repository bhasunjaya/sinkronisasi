<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use App\Kldata;
use App\Pemdadata;
use App\Usulan;
use Illuminate\Http\Request;

class EntryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		// dinas pu
		$bidang['all'] = [13, 1, 5, 14];
		$bidang['reguler'] = [13, 1, 5, 14];
		$bidang['penugasan'] = [1, 14, 5];
		$bidang['afirmasi'] = [13, 14, 1];
		$pemda_id = 6;

		$pemdadatas = Pemdadata::with('kegiatan.subbidang.bidang')
			->whereIn('bidang_id', $bidang['all'])
			->where('pemda_id', $pemda_id)
			->get();
		// return $pemdadatas;
		if (!$pemdadatas->count()) {
			$usulans = Usulan::with('kegiatan.subbidang.bidang')
				->whereIn('bidang_id', $bidang['all'])
				->where('pemda_id', $pemda_id)
				->orderBy('jenis', 'bidang_id', 'subbidang_id')
				->groupBy('jenis', 'bidang_id', 'subbidang_id', 'kegiatan_id')
				->select(\DB::raw('jenis,bidang_id,subbidang_id,kegiatan_id'))
				->get();
			// return $usulans;
			foreach ($usulans as $u) {
				$pemdadata = Pemdadata::where('jenis', $u->jenis)
					->where('bidang_id', $u->bidang_id)
					->where('subbidang_id', $u->subbidang_id)
					->where('kegiatan_id', $u->kegiatan_id)
					->where('pemda_id', $pemda_id)
					->first();
				if (!$pemdadata) {
					$pemdadata = new Pemdadata;
					$pemdadata->pemda_id = $pemda_id;
					$pemdadata->bidang_id = $u->bidang_id;
					$pemdadata->subbidang_id = $u->subbidang_id;
					$pemdadata->kegiatan_id = $u->kegiatan_id;
					$pemdadata->jenis = $u->jenis;
					$pemdadata->save();
				}
			}

			$pemdadatas = Pemdadata::with('kegiatan.subbidang.bidang')
				->whereIn('bidang_id', $bidang['all'])
				->where('pemda_id', $pemda_id)
				->get();
		}
		// return $pemdadatas;

		return view('pemda.entry.index', compact('pemdadatas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Pemdadata $entry) {
		$kldata = Kldata::where('pemda_id', $entry->pemda_id)
			->where('bidang_id', $entry->bidang_id)
			->where('subbidang_id', $entry->subbidang_id)
			->where('kegiatan_id', $entry->kegiatan_id)
			->where('jenis', $entry->jenis)
			->first();
		$usulan = Usulan::where('pemda_id', $entry->pemda_id)
			->where('bidang_id', $entry->bidang_id)
			->where('subbidang_id', $entry->subbidang_id)
			->where('kegiatan_id', $entry->kegiatan_id)
			->where('jenis', $entry->jenis)
			->groupBy('jenis', 'bidang_id', 'subbidang_id', 'kegiatan_id')
			->select(\DB::raw('jenis,bidang_id,subbidang_id,kegiatan_id,sum(output) as output,sum(dana) as dana'))
			->get();

		return view('pemda.entry.show', compact('usulan', 'kldata', 'entry'));
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
