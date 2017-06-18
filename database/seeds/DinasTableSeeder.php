<?php

use Illuminate\Database\Seeder;

class DinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dinas')->truncate();
        if (($handle = fopen("data/dinas.csv", "r")) !== false) {
            $row = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row) {
                    $ins = [
                        'id' => $data[0],
                        'nama' => trim($data[1]),
                    ];
                    // print_r($ins);
                    DB::table('dinas')->insert($ins);
                }
                $row++;
            }
            fclose($handle);
        }
    }
}
