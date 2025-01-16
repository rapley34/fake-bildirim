<?php
header('Content-Type: application/json');

$cities = [
    'Samsun', 'İstanbul', 'Ankara', 'İzmir', 'Bursa', 'Tekirdağ', 'Adana', 'Gaziantep', 'Manisa', 'Balıkesir', 'Bursa', 
    'Antalya', 'Trabzon', 'Eskişehir', 'Konya', 'Adana'
];

$products = [
    ['name' => '50 Adet Taklacı Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Posta Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Kelebek Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png'],
    ['name' => '50 Adet Krom Kesilmez', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/big_photo/product_krom-guvercin-bilezikleri500x50022940432509851.jpg'],
    ['name' => '50 Adet Dönek Bilezikleri', 'image' => 'https://www.guvercinmalzemeleri.com/images/product/54463-570-1.png']
];

$times = ['1 dakika önce', '5 dakika önce', '15 dakika önce', '1 saat önce', '3 saat önce'];

$notification = [
    'city' => $cities[array_rand($cities)],
    'product' => $products[array_rand($products)],
    'time' => $times[array_rand($times)]
];

echo json_encode($notification);
?>
