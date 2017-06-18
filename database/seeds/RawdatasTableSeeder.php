<?php

use Illuminate\Database\Seeder;

class RawdatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rawdatas')->truncate();
        die;
        if (($handle = fopen("data/data.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    //kode  nama    jenis   kode_bidang bidang  subbidang
                    //kegiatan    kode_proyek proyek  satuan  output  lokasi  dana

                    $data[7] = preg_replace('/[[:^print:]]/', '', $data[7]);
                    $data[9] = preg_replace('/[[:^print:]]/', '', $data[9]);
                    $data[10] = preg_replace('/[[:^print:]]/', '', $data[10]);

                    $ins = [
                        'kode' => $data[1],
                        'nama' => $data[2],
                        'jenis' => $data[3],
                        'kode_bidang' => $data[4],
                        'bidang' => $data[5],
                        'subbidang' => $data[6],
                        'kegiatan' => mb_convert_encoding($data[7], 'UTF-8'),
                        'kode_proyek' => $data[8],
                        'proyek' => mb_convert_encoding($data[9], 'UTF-8'),
                        'satuan' => mb_convert_encoding($data[10], 'UTF-8'),
                        'output' => $data[11],
                        'lokasi' => $data[12],
                        'dana' => $data[13],
                    ];
                    DB::table('rawdatas')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
