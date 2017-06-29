<?php

namespace App\Console\Commands;

use App\Sinkronisasi;
use Excel;
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

        $usulans = \App\Usulan::where('pemda_id', 1)
            ->select(\DB::raw('pemda_id,bidang_id,subbidang_id,kegiatan_id,jenis,satuan,sum(output) as output,sum(dana) as dana'))
            ->groupBy('pemda_id', 'bidang_id', 'subbidang_id', 'kegiatan_id', 'jenis', 'satuan')
            ->get();
        Excel::create('usulans', function ($excel) use ($usulans) {
            $excel->sheet('Sheet 1', function ($sheet) use ($usulans) {
                $sheet->fromArray($usulans);
            });
        })->export('xls');
        die;
        foreach ($usulans as $r) {
            $sinkronisasi = new Sinkronisasi;
            $sinkronisasi->pemda_id = $r->pemda_id;
            $sinkronisasi->bidang_id = $r->bidang_id;
            $sinkronisasi->subbidang_id = $r->subbidang_id;
            $sinkronisasi->kegiatan_id = $r->kegiatan_id;
            $sinkronisasi->jenis = $r->jenis;
            $sinkronisasi->satuan = $r->satuan;
            $sinkronisasi->output = $r->output;
            $sinkronisasi->dana = $r->dana;
            $sinkronisasi->save();

        }
    }
}
