<?php

use App\Kegiatan;
use App\Pemda;
use App\Rawdata;
use Illuminate\Database\Seeder;

class UsulansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // siapin pemda
        $ddPemda = [];
        $pemdas = Pemda::all();
        foreach ($pemdas as $p) {
            $k = str_slug($p->nama);
            $ddPemda[$k] = $p->id;
        }

        //siapin data kegiatan
        $ddKegiatan = [];
        $kegiatans = Kegiatan::with('subbidang.bidang')->get();
        foreach ($kegiatans as $p) {
            $k = str_slug($p->kegiatan . '-' . $p->subbidang->nama . '-' . $p->subbidang->bidang->nama);
            $ddKegiatan[$k] = $p->id;
        }
        $loop = true;
        while ($loop) {
            $raws = DB::table('raws')
                ->limit(1000)
                ->where('is_proses', 0)
                ->get();
            if ($raws->count()) {
                $ce = [];
                $counter = 1;
                foreach ($raws as $r) {
                    $pemdaKey = str_slug($r->nama);
                    $kegiatanKey = str_slug($r->kegiatan . '-' . $r->subbidang . '-' . $r->bidang);

                    $pemda_id = array_get($ddPemda, $pemdaKey, false);
                    $kegiatan_id = array_get($ddKegiatan, $kegiatanKey, false);
                    $i = [];
                    $i['pemda_id'] = $pemda_id;
                    $i['kegiatan_id'] = $kegiatan_id;
                    // $ce[] = $i;

                    DB::table('raws')
                        ->where('id', $r->id)
                        ->update($i);

                }
            } else {
                $loop = false;
                die('kelarrr');
            }
            // if()
        }
    }

    public function run2()
    {
        DB::table('usulans')->truncate();
        $dbhost = "localhost";
        $dbname = "personal_syncdac";
        $dbusername = "personal";
        $dbpassword = "password";
        $link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

        // dd('de');
        DB::connection()->disableQueryLog();
        $this->call('ambil kopi.. ini bakalan lama... banget');

        $loop = true;
        // siapin pemda
        $ddPemda = [];
        $pemdas = Pemda::all();
        foreach ($pemdas as $p) {
            $k = str_slug($p->nama);
            $ddPemda[$k] = $p->id;
        }

        //siapin data kegiatan
        $ddKegiatan = [];
        $kegiatans = Kegiatan::with('subbidang.bidang')->get();
        foreach ($kegiatans as $p) {
            $k = str_slug($p->kegiatan . '-' . $p->subbidang->nama . '-' . $p->subbidang->bidang->nama);
            $ddKegiatan[$k] = $p->id;
        }
        $counter = 1;
        while ($loop) {
            $raws = Rawdata::limit(10)
                ->where('is_proses', true)
                ->get();

            if ($raws->count()) {
                foreach ($raws as $r) {
                    $pemdaKey = str_slug($r->nama);
                    $kegiatanKey = str_slug($r->kegiatan . '-' . $r->subbidang . '-' . $r->bidang);

                    $pemda_id = array_get($ddPemda, $pemdaKey, false);
                    $kegiatan_id = array_get($ddKegiatan, $kegiatanKey, false);

                    if (strpos(strtolower($r->jenis), 'penugasan')) {
                        $jenis = 'penugasan';
                    } elseif (strpos(strtolower($r->jenis), 'afirmasi')) {
                        $jenis = 'afirmasi';
                    } elseif (strpos(strtolower($r->jenis), 'reguler')) {
                        $jenis = 'reguler';
                    } else {
                        $jenis = false;
                    }

                    $error = false;
                    if (!$pemda_id) {
                        $this->call($r->nama . 'tidak ada di database daerah');
                        $error = true;
                    }

                    if (!$kegiatan_id) {
                        $this->call("kegiatan ini belum ada. -> " . $kegiatanKey);
                        $error = true;
                    }
                    if (!$jenis) {
                        $this->call($r->jenis . ' tidak dikenali');
                        $error = true;
                    }

                    if (!$error) {
                        $ins = [
                            'pemda_id' => $pemda_id,
                            'kegiatan_id' => $kegiatan_id,
                            'jenis' => $jenis,
                            'kegiatan' => $r->proyek,
                            'volume' => (int) $r->output,
                            'satuan' => $r->satuan,
                            'lokasi' => $r->lokasi,
                            'dana' => $r->dana,
                        ];
                        $statement = $link->prepare("
                        INSERT INTO usulans(
                            pemda_id, kegiatan_id, jenis,
                            kegiatan, volume, satuan,lokasi,dana
                        )
                        VALUES(
                            ?,?,?,?,
                            ?,?,?,?
                        )");

                        $statement->execute([
                            $pemda_id,
                            $kegiatan_id,
                            $jenis,
                            $r->proyek,
                            $r->output,
                            $r->satuan,
                            $r->lokasi,
                            $r->dana,
                        ]);
                        $r->is_proses = false;
                        $r->save();
                        sleep(1);

                    }
                }
            } else {
                echo 'abis';
                $loop = false;
            }
            $this->call($counter);
            $counter++;
        }

    }

    public function call($text)
    {
        if (isset($this->command)) {
            $this->command->getOutput()->writeln($text);
        }
    }
}
