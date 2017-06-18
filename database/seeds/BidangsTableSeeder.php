<?php

use Illuminate\Database\Seeder;

class BidangsTableSeeder extends Seeder
{
    protected $pdo;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidangs')->truncate();
        if (($handle = fopen("data/bidangs.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    $ins = [
                        'id' => $data[0],
                        'nama' => trim($data[1]),
                    ];
                    // print_r($ins);
                    DB::table('bidangs')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }

        DB::table('subbidangs')->truncate();
        if (($handle = fopen("data/subbidangs.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    $ins = [
                        'id' => $data[0],
                        'bidang_id' => $data[1],
                        'nama' => trim($data[2]),
                    ];
                    DB::table('subbidangs')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
