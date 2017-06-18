<?php

use Illuminate\Database\Seeder;

class KegiatansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatans')->truncate();

        $subbidangs = \App\Subbidang::with('bidang')->get();
        $ss = [];
        $bidangs = [];
        foreach ($subbidangs as $r) {
            $key = str_slug($r->bidang->nama . '-' . $r->nama);
            $ss[$key] = $r->id;
            $bidangs[$key] = $r->bidang_id;
        }
        if (($handle = fopen("data/kegiatan.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    $key = str_slug($data[0] . '-' . $data[1]);
                    $ins = [
                        'bidang_id' => $bidangs[$key],
                        'subbidang_id' => $ss[$key],
                        'kegiatan' => htmlentities($data[2]),
                    ];
                    // print_r($ins);
                    DB::table('kegiatans')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
