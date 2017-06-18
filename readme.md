## Map
- Master Data
    - Pemda
    - Bidang dan Sub
    - Bappenas
    - K/L Teknis
    - Dinas

- Akun User






Kab. Batanghari  => Kab. Batang Hari
Kab. Batubara   => Kab. Batu bara
Kab. Biak-Numfor    => Kab. Biak Numfor
Kab. Kutai Kertanegara => Kab. Kutai Kartanegara
Kab. Labuhan Batu Selatan   => Kab. Labuhanbatu Selatan
Kab. Labuhan Batu Utara => Kab. Labuhanbatu Utara
Kab. Muko-Muko  => Kab. Mukomuko
Kab. Musi Banyu Asin => Kab. Musi Banyuasin
Kab. Pakpak Barat => Kab. Pakpak Bharat
Kab. Pulau Buru => Kab. Buru
Kab. Tanatoraja => Kab. Tana Toraja
Kab. Tojo Una-Una => Kab. Tojo Una Una
Kota Bukittinggi => Kota Bukit Tinggi
Kota Gunung Sitoli => Kota Gunungsitoli
Kota Kotamobago => Kota Kotamobagu
Kota Pangkalpinang => Kota Pangkal Pinang
Kota Pematangsiantar => Kota Pematang Siantar
Kota Tanjungbalai   => Kota Tanjung Balai
Kota Tanjungpinang  => Kota Tanjung Pinang
Kota Tebingtinggi => Kota Tebing Tinggi
Provinsi  Sulawesi Barat => Provinsi Sulawesi Barat
Provinsi Bangka Belitung =? Provinsi  Bangka Belitung

Provinsi Bengkulu   => Provinsi  Bengkulu
Provinsi Lampung => Provinsi  Lampung



SELECT
FROM rawdatas WHERE rawdata.name NOT IN (SELECT nama FROM )

```
php artisan make:view path.to.your.view -e path.to.parent.view
php artisan make:view djpk.bappenas. -e app

$select_stmt = DB::getPdo()->prepare('SELECT id FROM products WHERE sku = ?');
$insert_stmt = DB::getPdo()->prepare('INSERT INTO products(price, old_price) VALUES(?, ?)');
$update_stmt = DB::getPdo()->prepare('UPDATE products SET price = ?, old_price = ? WHERE id = ?');

foreach($products as $key => $product)
{
    $select_stmt->execute([ $product['sku'] ]);
    $id = $select_stmt->fetchColumn();
    if ($id === false)
    {
        $insert_stmt->execute([ $product['productPrice'], $product['productOldPrice'] ]);
    }
    else
    {
        $update_stmt->execute([ $product['productPrice'], $product['productOldPrice'], $id ]);
    }
}

LOAD DATA INFILE 'data.csv' INTO TABLE rawdatas
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 LINES;
```

```
        $raws = Rawdata::groupBy('bidang', 'subbidang', 'kegiatan')
            ->select('bidang', 'subbidang', 'kegiatan')
            ->get();
        $filename = "kegiatan.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('bidang', 'subbidang', 'kegiatan'));
        foreach ($raws as $row) {
            fputcsv($handle, array($row->bidang, $row->subbidang, $row->kegiatan));
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return response()->file($filename, $headers);
```

### Fix the dirty rawdata
```
$fix = [
            'Kab. Kulonprogo' => 'Kab. Kulon Progo',
            'Kab. Gunungkidul' => 'Kab. Gunung Kidul',
            'Kab. DeliSerdang' => 'Kab. Deli Serdang',
            'Kab. Batanghari' => 'Kab. Batang Hari',
            'Kab. Batubara' => 'Kab. Batu bara',
            'Kab. Biak-Numfor' => 'Kab. Biak Numfor',
            'Kab. Kutai Kertanegara' => 'Kab. Kutai Kartanegara',
            'Kab. Labuhan Batu Selatan' => 'Kab. Labuhanbatu Selatan',
            'Kab. Labuhan Batu Utara' => 'Kab. Labuhanbatu Utara',
            'Kab. Muko-Muko' => 'Kab. Mukomuko',
            'Kab. Musi Banyu Asin' => 'Kab. Musi Banyuasin',
            'Kab. Pakpak Barat' => 'Kab. Pakpak Bharat',
            'Kab. Tanatoraja' => 'Kab. Tana Toraja',
            'Kab. Tojo Una-Una' => 'Kab. Tojo Una Una',
            'Kota Bukittinggi' => 'Kota Bukit Tinggi',
            'Kab. Pulau Buru' => 'Kab. Buru',
            'Kota Gunung Sitoli' => 'Kota Gunungsitoli',
            'Kota Kotamobago' => 'Kota Kotamobagu',
            'Kota Pangkalpinang' => 'Kota Pangkal Pinang',
            'Kota Pematangsiantar' => 'Kota Pematang Siantar',
            'Kota Tanjungbalai' => 'Kota Tanjung Balai',
            'Kota Tanjungpinang' => 'Kota Tanjung Pinang',
            'Kota Tebingtinggi' => 'Kota Tebing Tinggi',
            'Provinsi  Sulawesi Barat' => 'Provinsi Sulawesi Barat',
            'Provinsi Bangka Belitung' => 'Provinsi  Bangka Belitung',
            'Provinsi Bengkulu' => 'Provinsi  Bengkulu',
            'Provinsi Lampung' => 'Provinsi  Lampung',
        ];
        foreach ($fix as $k => $v) {
            DB::table('rawdatas')
                ->where('nama', $k)
                ->update(['nama' => $v]);

        }
```