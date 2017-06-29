<?php

namespace App\Console\Commands;

use App\Document;
use App\Kldata;
use App\Pemda;
use App\Sinkronisasi;
use App\Subbidang;
use Excel;
use Illuminate\Console\Command;

class ImportManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doc:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the excell';
    protected $chunkSize = 100;
    protected $rows = 100;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handleBidangKL()
    {
        $kl[1]['reguler'] = 'Perumahan dan Permukiman, Air Minum, Jalan, Sanitasi';
        $kl[1]['penugasan'] = 'Air Minum, Sanitasi, Irigasi, Jalan';
        $kl[1]['afirmasi'] = 'Perumahan dan Permukiman, Sanitasi, Air Minum';

        $kl[2]['reguler'] = 'Pendidikan';
        $kl[2]['penugasan'] = 'Pendidikan';
        $kl[2]['afirmasi'] = 'Pendidikan';

        $kl[3]['reguler'] = 'Kesehatan dan KB';
        $kl[3]['penugasan'] = 'Kesehatan dan KB';
        $kl[3]['afirmasi'] = 'Kesehatan dan KB';

        $kl[4]['reguler'] = 'Kesehatan dan KB';
        $kl[4]['penugasan'] = 'Kesehatan dan KB';
        $kl[4]['afirmasi'] = 'Kesehatan dan KB';

        $kl[5]['reguler'] = 'Pertanian';
        $kl[6]['reguler'] = 'Kelautan dan Perikanan';
        $kl[7]['reguler'] = 'Industri Kecil dan Menengah';
        $kl[8]['reguler'] = 'Pariwisata';
        $kl[9]['reguler'] = 'Pasar';
        $kl[9]['penugasan'] = 'Pasar';

        $kl[10]['penugasan'] = 'Energi Skala Kecil';
        $kl[11]['afirmasi'] = 'Transportasi';
        $kl[12]['penugasan'] = 'Lingkungan Hidup dan Kehutanan';

        $bidangs = [];
        foreach (\App\Bidang::pluck('id', 'nama') as $k => $v) {
            $bidangs[strtolower($k)] = $v;
        }

        // dd($bidangs);

        foreach ($kl as $kl_id => $k) {
            foreach ($k as $jenis => $v) {
                $strings = explode(",", $v);
                foreach ($strings as $c) {
                    $key = trim(strtolower($c));
                    $in = [];
                    $in['dinas_id'] = $kl_id;
                    $in['bidang_id'] = array_get($bidangs, $key);
                    $in['jenis'] = $jenis;
                    \DB::table('bidang_kl')->insert($in);
                }
            }
        }
        // print_r($bidangs);
        // print_r($in);
        die;

    }
    public function handle2()
    {
        $kl[13]['reguler'] = 'Perumahan dan Permukiman, Air Minum, Jalan, Sanitasi';
        $kl[13]['penugasan'] = 'Air Minum, Sanitasi, Irigasi, Jalan';
        $kl[13]['afirmasi'] = 'Perumahan dan Permukiman, Sanitasi, Air Minum';

        $kl[1]['reguler'] = 'Perumahan dan Permukiman, Air Minum, Jalan, Sanitasi';
        $kl[1]['penugasan'] = 'Air Minum, Sanitasi, Irigasi, Jalan';
        $kl[1]['afirmasi'] = 'Perumahan dan Permukiman, Sanitasi, Air Minum';

        $kl[2]['reguler'] = 'Perumahan dan Permukiman, Air Minum, Jalan, Sanitasi';
        $kl[2]['penugasan'] = 'Air Minum, Sanitasi, Irigasi, Jalan';
        $kl[2]['afirmasi'] = 'Perumahan dan Permukiman, Sanitasi, Air Minum';

        $kl[14]['reguler'] = 'Perumahan dan Permukiman, Air Minum, Jalan, Sanitasi';
        $kl[14]['penugasan'] = 'Air Minum, Sanitasi, Irigasi, Jalan';
        $kl[14]['afirmasi'] = 'Perumahan dan Permukiman, Sanitasi, Air Minum';

        $kl[3]['reguler'] = 'Pendidikan';
        $kl[3]['penugasan'] = 'Pendidikan';
        $kl[3]['afirmasi'] = 'Pendidikan';

        $kl[6]['reguler'] = 'Kesehatan dan KB';
        $kl[6]['penugasan'] = 'Kesehatan dan KB';
        $kl[6]['afirmasi'] = 'Kesehatan dan KB';

        $kl[12]['reguler'] = 'Pertanian';

        $kl[5]['reguler'] = 'Kelautan dan Perikanan';
        $kl[11]['reguler'] = 'Industri Kecil dan Menengah';
        $kl[8]['reguler'] = 'Pariwisata';
        $kl[9]['reguler'] = 'Pasar';
        $kl[9]['penugasan'] = 'Pasar';

        $kl[4]['penugasan'] = 'Energi Skala Kecil';
        $kl[10]['afirmasi'] = 'Transportasi';
        $kl[7]['penugasan'] = 'Lingkungan Hidup dan Kehutanan';

        $bidangs = [];
        foreach (\App\Bidang::pluck('id', 'nama') as $k => $v) {
            $bidangs[strtolower($k)] = $v;
        }

        // dd($bidangs);

        foreach ($kl as $kl_id => $k) {
            foreach ($k as $jenis => $v) {
                $strings = explode(",", $v);
                foreach ($strings as $c) {
                    $key = trim(strtolower($c));
                    $in = [];
                    $in['dinas_id'] = $kl_id;
                    $in['bidang_id'] = array_get($bidangs, $key);
                    $in['jenis'] = $jenis;
                    \DB::table('dinas_kl')->insert($in);
                }
            }
        }
        // print_r($bidangs);
        // print_r($in);
        die;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $documents = Document::where('is_processed', false)
            ->limit(20)->get();
        config([
            'excel.import.heading' => 'numeric',
            'excel.import.startRow' => 5,
        ]);
        $pemdas = Pemda::all();
        $listPemda = [];
        foreach ($pemdas as $p) {
            $key = sprintf("%02d-%02d", $p->prov, $p->kab);
            $listPemda[$key] = $p->id;
        }
        foreach ($documents as $doc) {

            $ins = [];
            $bidang = Subbidang::find($doc->subbidang_id);
            $file_path = storage_path($doc->nama);

            $bidang_id = $bidang->id;
            $subbidang_id = $doc->subbidang_id;
            $kegiatan_id = $doc->kegiatan_id;
            $jenis = $doc->jenis;

            $sinkronisasis = Sinkronisasi::where('subbidang_id', $subbidang_id)
                ->where('kegiatan_id', $kegiatan_id)
                ->where('jenis', $jenis)
                ->select(\DB::raw("id,lower(CONCAT(pemda_id,'-',subbidang_id,'-',kegiatan_id,'-',jenis,'-',satuan)) as kk"))
                ->get();
            $oSinkronisasi = [];
            foreach ($sinkronisasis as $r) {
                $oSinkronisasi[$r->kk] = $r->id;
            }

            Excel::filter('chunk')
                ->selectSheetsByIndex(0)
                ->load($file_path)
                ->chunk($this->chunkSize, function ($result) use (&$ins, $oSinkronisasi, $listPemda, $bidang_id, $subbidang_id, $kegiatan_id, $jenis) {
                    $rows = $result->toArray();
                    foreach ($rows as $k => $row) {
                        if ($row[5] && $row[6]) {
                            $pemdaKey = $row[1] . '-' . $row[2];
                            $pemda_id = array_get($listPemda, $pemdaKey, false);

                            if ($pemda_id) {
                                $key = strtolower($pemda_id . '-' . $subbidang_id . '-' . $kegiatan_id . '-' . $jenis . '-' . trim($row[6]));

                                $sinkronisasi_id = array_get($oSinkronisasi, $key, false);
                                if ($sinkronisasi_id) {

                                    $kldata = Kldata::where('sinkronisasi_id', $sinkronisasi_id)->first();
                                    if (!$kldata) {
                                        $kldata = new Kldata;
                                    }

                                    $kldata->sinkronisasi_id = $sinkronisasi_id;
                                    $kldata->pemda_id = $pemda_id;
                                    $kldata->bidang_id = $bidang_id;
                                    $kldata->subbidang_id = $subbidang_id;
                                    $kldata->kegiatan_id = $kegiatan_id;
                                    $kldata->jenis = $jenis;
                                    $kldata->volume = $row[5];
                                    $kldata->satuan = $row[6];
                                    $kldata->unit_cost = $row[7];
                                    $kldata->target = $row[9];
                                    $kldata->lokasi = $row[10];
                                    $kldata->save();
                                }

                            }

                        }
                    }
                });
            // $doc->is_processed = true;
            // $doc->save();
        }
    }
}
