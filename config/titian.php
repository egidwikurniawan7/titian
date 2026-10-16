<?php

/*
 * Semua data toko ada di sini. Ganti sesuai kebutuhan.
 * - price  : harga per slice
 * - whole  : harga kue utuh (8 potong)
 * - image  : path di folder public/ (ganti .svg dengan foto hasil AI kamu, mis. .jpg / .webp)
 * - featured: true = tampil di slider hero landing page (isi 5 produk)
 *
 * Khusus produk featured (slider hero):
 * - hero_image : gambar kue TANPA latar (PNG/WebP transparan), karena dipasang di atas warna latar hero
 * - hero.bg    : warna latar hero saat kue ini aktif (pilih yang terang, supaya teks cokelat tetap terbaca)
 * - hero.decor : hiasan yang melayang di sekitar kue. Gambar ada di public/images/decor/{img}.svg
 *      x, y : posisi (% dari panggung kue)   w : lebar (%)   r : rotasi (derajat)
 *      k    : seberapa jauh hiasan bergerak saat berganti (makin besar makin jauh)
 */

return [
    'brand' => 'Titian',
    'tagline' => 'Jembatan ke rasa manis',

    // Format internasional tanpa tanda +, contoh: 6281234567890
    'whatsapp' => '6281234567890',
    'whatsapp_display' => '0812-3456-7890',
    'address' => 'Jl. Contoh No. 28, Pontianak',
    'hours' => 'Setiap hari, 08.00–20.00',
    'instagram' => 'titian.cake',

    'flavors' => [
        'manis' => ['label' => 'Manis', 'icon' => '🍓', 'desc' => 'Lembut & legit'],
        'segar' => ['label' => 'Segar', 'icon' => '🍋', 'desc' => 'Ringan & cerah'],
        'cokelat' => ['label' => 'Cokelat', 'icon' => '🍫', 'desc' => 'Pekat & hangat'],
        'wangi' => ['label' => 'Wangi', 'icon' => '🌿', 'desc' => 'Harum & lembut'],
    ],

    'products' => [
        [
            'slug' => 'strawberry-shortcake',
            'name' => 'Strawberry Shortcake',
            'rasa' => 'Segar, lembut, manis',
            'flavors' => ['manis', 'segar'],
            'tags' => ['Stroberi', 'Krim segar', 'Vanila'],
            'price' => 38000,
            'whole' => 190000,
            'image' => 'images/cakes/strawberry-shortcake.svg',
            'hero_image' => 'images/hero/strawberry-shortcake.svg',
            'hero' => [
                'bg' => '#F8C9B4',
                'decor' => [
                    ['img' => 'strawberry', 'x' => 2, 'y' => 12, 'w' => 20, 'r' => -16, 'k' => 1.4],
                    ['img' => 'mint', 'x' => 76, 'y' => 4, 'w' => 18, 'r' => 24, 'k' => 1.0],
                    ['img' => 'strawberry', 'x' => 82, 'y' => 60, 'w' => 14, 'r' => 20, 'k' => 1.7],
                    ['img' => 'cream', 'x' => 4, 'y' => 68, 'w' => 15, 'r' => -6, 'k' => 1.2],
                ],
            ],
            'featured' => true,
        ],
        [
            'slug' => 'chocolate-ganache',
            'name' => 'Chocolate Ganache',
            'rasa' => 'Pekat, legit, mewah',
            'flavors' => ['cokelat'],
            'tags' => ['Cokelat hitam', 'Ganache', 'Kopi'],
            'price' => 42000,
            'whole' => 210000,
            'image' => 'images/cakes/chocolate-ganache.svg',
            'hero_image' => 'images/hero/chocolate-ganache.svg',
            'hero' => [
                'bg' => '#F1BE92',
                'decor' => [
                    ['img' => 'choco', 'x' => 3, 'y' => 12, 'w' => 19, 'r' => -20, 'k' => 1.4],
                    ['img' => 'bean', 'x' => 78, 'y' => 6, 'w' => 12, 'r' => 30, 'k' => 1.0],
                    ['img' => 'choco', 'x' => 82, 'y' => 62, 'w' => 15, 'r' => 15, 'k' => 1.7],
                    ['img' => 'bean', 'x' => 8, 'y' => 70, 'w' => 11, 'r' => -35, 'k' => 1.2],
                ],
            ],
            'featured' => true,
        ],
        [
            'slug' => 'tiramisu',
            'name' => 'Tiramisu',
            'rasa' => 'Creamy, pahit manis',
            'flavors' => ['cokelat'],
            'tags' => ['Espresso', 'Mascarpone', 'Kakao'],
            'price' => 40000,
            'whole' => 200000,
            'image' => 'images/cakes/tiramisu.svg',
            'hero_image' => 'images/hero/tiramisu.svg',
            'hero' => [
                'bg' => '#F0D1A6',
                'decor' => [
                    ['img' => 'bean', 'x' => 4, 'y' => 12, 'w' => 12, 'r' => -25, 'k' => 1.4],
                    ['img' => 'ladyfinger', 'x' => 72, 'y' => 6, 'w' => 23, 'r' => 28, 'k' => 1.0],
                    ['img' => 'cocoa', 'x' => 84, 'y' => 62, 'w' => 11, 'r' => 10, 'k' => 1.7],
                    ['img' => 'bean', 'x' => 7, 'y' => 70, 'w' => 11, 'r' => 40, 'k' => 1.2],
                ],
            ],
            'featured' => true,
        ],
        [
            'slug' => 'pandan-berry',
            'name' => 'Pandan Berry',
            'rasa' => 'Segar, lembut, wangi',
            'flavors' => ['segar', 'wangi'],
            'tags' => ['Daun pandan', 'Berry', 'Santan'],
            'price' => 36000,
            'whole' => 180000,
            'image' => 'images/cakes/pandan-berry.svg',
            'hero_image' => 'images/hero/pandan-berry.svg',
            'hero' => [
                'bg' => '#E8D9AE',
                'decor' => [
                    ['img' => 'blueberry', 'x' => 3, 'y' => 12, 'w' => 15, 'r' => -10, 'k' => 1.4],
                    ['img' => 'pandan', 'x' => 74, 'y' => 3, 'w' => 22, 'r' => 20, 'k' => 1.0],
                    ['img' => 'blueberry', 'x' => 84, 'y' => 62, 'w' => 12, 'r' => 0, 'k' => 1.7],
                    ['img' => 'blueberry', 'x' => 8, 'y' => 70, 'w' => 13, 'r' => 10, 'k' => 1.2],
                ],
            ],
            'featured' => true,
        ],
        [
            'slug' => 'kayu-manis-apel',
            'name' => 'Kayu Manis Apel',
            'rasa' => 'Hangat, manis, wangi',
            'flavors' => ['manis', 'wangi'],
            'tags' => ['Kayu manis', 'Apel', 'Karamel'],
            'price' => 35000,
            'whole' => 175000,
            'image' => 'images/cakes/kayu-manis-apel.svg',
            'hero_image' => 'images/hero/kayu-manis-apel.svg',
            'hero' => [
                'bg' => '#F4C48A',
                'decor' => [
                    ['img' => 'cinnamon', 'x' => 1, 'y' => 12, 'w' => 24, 'r' => -30, 'k' => 1.4],
                    ['img' => 'apple', 'x' => 77, 'y' => 6, 'w' => 17, 'r' => 25, 'k' => 1.0],
                    ['img' => 'cinnamon', 'x' => 78, 'y' => 64, 'w' => 20, 'r' => 60, 'k' => 1.7],
                    ['img' => 'apple', 'x' => 6, 'y' => 70, 'w' => 14, 'r' => -12, 'k' => 1.2],
                ],
            ],
            'featured' => true,
        ],
        [
            'slug' => 'red-velvet',
            'name' => 'Red Velvet',
            'rasa' => 'Lembut, creamy, manis',
            'flavors' => ['manis'],
            'tags' => ['Krim keju', 'Cokelat putih', 'Vanila'],
            'price' => 38000,
            'whole' => 190000,
            'image' => 'images/cakes/red-velvet.svg',
            'featured' => false,
        ],
        [
            'slug' => 'lemon-cheesecake',
            'name' => 'Lemon Cheesecake',
            'rasa' => 'Asam segar, creamy',
            'flavors' => ['segar'],
            'tags' => ['Lemon', 'Keju krim', 'Biskuit'],
            'price' => 40000,
            'whole' => 200000,
            'image' => 'images/cakes/lemon-cheesecake.svg',
            'featured' => false,
        ],
        [
            'slug' => 'matcha-kacang-merah',
            'name' => 'Matcha Kacang Merah',
            'rasa' => 'Pahit lembut, wangi',
            'flavors' => ['wangi'],
            'tags' => ['Matcha', 'Susu', 'Kacang merah'],
            'price' => 42000,
            'whole' => 210000,
            'image' => 'images/cakes/matcha-kacang-merah.svg',
            'featured' => false,
        ],
    ],
];
