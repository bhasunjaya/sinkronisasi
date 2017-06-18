<?php

use Illuminate\Database\Seeder;

class PemdasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pemdas')->truncate();
        if (($handle = fopen("data/pemda.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    $ins = [
                        'prov' => $data[1],
                        'kab' => $data[2],
                        'nama' => trim($data[3]),
                        'idpemda' => $data[4],
                    ];
                    DB::table('pemdas')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
