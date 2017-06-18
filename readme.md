## Map
- Master Data
    - Pemda
    - Bidang dan Sub
    - Bappenas
    - K/L Teknis
    - Dinas

- Akun User


    







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
