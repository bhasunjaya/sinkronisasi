<?php

use App\Apemda;
use App\Dinas;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        //djpk
        DB::table('users')->insert([
            'name' => 'djpk',
            'password' => Hash::make('password'),
            'username' => 'djpk',
            'group' => 'djpk',
        ]);

        $u['otda'] = ['otda'];
        $u['bappenas'] = [
            'BKKBN ',
            'BNPP',
            'Direktorat  Perkotaan, Perumahan, dan Permukiman  Bappenas  ',
            'Direktorat Daerah Tertinggal, Transmigrasi dan Perdesaan ',
            'Direktorat Industri, Pariwisata, dan Ekonomi Kreatif Bappenas ',
            'Direktorat Kelautan dan Perikanan Bappenas ',
            'Direktorat Keluarga, Perempuan, Anak, Pemuda dan Olahraga Bappenas',
            'Direktorat Kesehatan dan Gizi Masyarakat  Bappenas ',
            'Direktorat Pangan dan Pertanian Bappenas ',
            ' Direktorat Pendidikan dan Agama Bappenas ',
            ' Direktorat Pengairan dan Irigasi Bappenas ',
            ' Direktorat Perdagangan, Investasi, dan Kerjasama Ekonomi Internasional Bappenas ',
            'Direktorat Transportasi Bappenas ',
            'Kementerian Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi ',
            ' Kementerian Kelautan dan Perikanan  ',
            ' Kementerian Kesehatan ',
            ' Kementerian Pariwisata   ',
            ' Kementerian Pekerjaan Umum dan Perumahan Rakyat ',
            'Kementerian Pendidikan dan Kebudayaan ',
            ' Kementerian Perdagangan ',
            'Kementerian Perindustrian ',
            'Kementerian Pertanian ',
            'Kementerian PU-Pera',
        ];
        // $u['pemda'] = [
        //     'Dinas Bina Marga',
        //     'Dinas Cipta Karya',
        //     'Dinas DIKBUD',
        //     'Dinas ESDM',
        //     'Dinas Kelautan dan Perikanan',
        //     'Dinas Kesehatan',
        //     'Dinas LHK',
        //     'Dinas Pariwisata',
        //     'Dinas Perdagangan',
        //     'Dinas Perhubungan',
        //     'Dinas Perindustrian',
        //     'Dinas Pertanian',
        //     'Dinas PU',
        //     'Dinas Sumber Daya Air',
        // ];
        $u['kl'] = [
            'Kementerian PUPERA',
            'Kementerian DIKBUD',
            'Kementerian Kesehatan',
            'BKKBN',
            'Kementerian Pertanian',
            'Kementerian Kelautan dan Perikanan',
            'Kementerian Perindustrian',
            'Kementerian Pariwisata',
            'Kementerian Perdagangan',
            'Kementerian ESDM',
            'Kementrian Desa, PDT, dan Transmigrasi',
            'Kementerian LHK',
        ];
        foreach ($u as $g => $row) {
            $count = 1;
            foreach ($row as $r) {
                DB::table('users')->insert([
                    'name' => trim($r),
                    'password' => Hash::make('password'),
                    'username' => $g . $count,
                    'group' => $g,
                ]);
                $count++;
            }

        }

        $apemdas = Apemda::all();
        $dinas = Dinas::all();
        $count = 1;
        foreach ($apemdas as $pemda) {
            foreach ($dinas as $d) {
                DB::table('users')->insert([
                    'name' => $d->nama . ' ' . $pemda->nama,
                    'password' => Hash::make('password'),
                    'username' => 'pemda' . $count,
                    'group' => 'pemda',
                ]);
                $count++;
            }
        }

    }
}
