# Titian — landing page toko kue (Laravel)

Folder ini berisi file yang ditambahkan ke project Laravel. Tidak ada database.

## Cara pasang

1. Buat project Laravel baru (atau pakai yang sudah ada):

   ```bash
   composer create-project laravel/laravel titian
   ```

2. Salin isi folder ini ke dalam project (timpa `routes/web.php`):

   ```
   app/Http/Controllers/PageController.php
   config/titian.php
   resources/views/...
   routes/web.php
   public/css, public/js, public/images
   ```

3. Jalankan:

   ```bash
   php artisan serve
   ```

   Buka http://127.0.0.1:8000 dengan **Chrome atau Edge** (transisi foto memakai View Transitions API).

## Yang perlu kamu ganti

Semua data ada di `config/titian.php`:

- `whatsapp` — nomor WhatsApp toko, format `62812...` tanpa `+` (sekarang masih contoh).
- `address`, `hours`, `instagram` — data footer.
- `products` — nama, rasa, bahan, harga, gambar. Produk dengan `featured => true` tampil di hero (isi 5).
- `image` — ganti path ke foto hasil AI kamu, misalnya `images/cakes/tiramisu.jpg`.

### Slider hero (menu andalan)

Hero adalah slider layar penuh berisi produk dengan `featured => true`. Tiap produk andalan punya:

- `hero_image` — gambar kue **tanpa latar** (PNG/WebP transparan, sebaiknya rasio sekitar 6:5), karena dipasang di atas warna latar hero. Kalau kosong, dipakai `image`.
- `hero.bg` — warna latar hero saat kue itu aktif. Pilih warna terang supaya teks cokelat tetap terbaca.
- `hero.decor` — hiasan yang melayang di sekitar kue. Gambarnya ada di `public/images/decor/` (blueberry, stroberi, biji kopi, dll). Untuk menambah hiasan sendiri, taruh gambar transparan di folder itu lalu tulis namanya di `img`. `x`/`y` = posisi (%), `w` = lebar (%), `r` = rotasi, `k` = jarak gerak saat berganti.

Pengaturan lama slide ada di `public/js/titian.js` (`DURATION`, default 5,5 detik). Slider berhenti saat kursor di atasnya, bisa dijeda dengan tombol, bisa dengan panah kiri/kanan keyboard, dan tidak berganti sendiri kalau perangkat memakai mode "kurangi gerakan".

Foto kue yang aktif memakai `view-transition-name`, jadi saat "Lihat detail" diklik, fotonya berpindah ke halaman detail (Chrome/Edge).

Logo ada di `resources/views/components/logo.blade.php` (SVG jembatan sementara).

## Halaman

| URL | Isi |
| --- | --- |
| `/` | Landing page |
| `/menu` | Semua kue + filter rasa |
| `/menu/{slug}` | Detail kue |
| `/kue-custom` | Form pesanan custom |
| `/keranjang` | Keranjang + checkout ke WhatsApp |

Keranjang disimpan di browser (localStorage), jadi tidak perlu server atau pembayaran asli.
