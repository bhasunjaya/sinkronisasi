<?php

namespace App\Console\Commands;

use App\Kldata;
use App\Pemdadata;
use App\Sinkronisasi;
use Illuminate\Console\Command;

class ProcessRaw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dak:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proses Raw Data DAK ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Kldata::truncate();
        Pemdadata::truncate();
        // dd(rand(1, 5));
        $sinkronisasi = Sinkronisasi::where('pemda_id', 1)->get();
        foreach ($sinkronisasi as $s) {
            $kldata = new Kldata;
            $kldata->sinkronisasi_id = $s->id;
            $kldata->pemda_id = $s->pemda_id;
            $kldata->bidang_id = $s->bidang_id;
            $kldata->subbidang_id = $s->subbidang_id;
            $kldata->kegiatan_id = $s->kegiatan_id;
            $kldata->jenis = $s->jenis;
            $kldata->volume = $s->output ?: 0;
            $kldata->satuan = $s->satuan;
            $kldata->unit_cost = $s->unit_cost;
            $kldata->target = $s->target;
            $kldata->lokasi = $s->lokasi;
            $kldata->is_entry_pemda = 1;
            $kldata->save();

            $lokasis = explode(";", $s->lokasi);
            $count = 1;
            $jlokasi = [];
            foreach ($lokasis as $l) {
                if ($l) {

                    $ins = [];
                    $ins['lokasi'] = $l;
                    $ins['prioritas'] = $count;
                    $jlokasi[] = $ins;
                    $count++;
                }
            }

            $pemdadata = new Pemdadata;
            $pemdadata->prioritas = rand(1, 5);
            $pemdadata->sinkronisasi_id = $s->id;
            $pemdadata->pemda_id = $s->pemda_id;
            $pemdadata->bidang_id = $s->bidang_id;
            $pemdadata->subbidang_id = $s->subbidang_id;
            $pemdadata->kegiatan_id = $s->kegiatan_id;
            $pemdadata->jenis = $s->jenis;
            $pemdadata->volume = $s->output ?: 0;
            $pemdadata->satuan = $s->satuan;
            $pemdadata->unit_cost = $s->unit_cost;
            $pemdadata->target = $s->target;
            $pemdadata->lokasi = json_encode($jlokasi);
            $pemdadata->save();

        }
    }
}
