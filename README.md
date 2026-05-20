# Avenoir Kitchen

Avenoir Kitchen adalah aplikasi restoran berbasis Laravel untuk pemesanan menu melalui QR/table, pengelolaan pesanan, dapur, dan admin operasional. Project ini dibuat untuk alur kerja restoran yang cepat, rapi, dan mudah dipantau dari pelanggan hingga dapur.

## Fitur Utama

- Pemesanan menu melalui nomor meja atau QR.
- Tracking status pesanan oleh pelanggan.
- Dashboard admin untuk mengelola menu, meja, dan pesanan.
- Workflow dapur untuk memproses pesanan masuk, mulai masak, dan menyelesaikan pesanan.
- Dukungan QR code untuk kebutuhan operasional meja.

## Teknologi

- Laravel 12
- PHP 8.2+
- MySQL / MariaDB
- Vite
- simple-qrcode

## Struktur Alur Aplikasi

- Landing page untuk pengunjung.
- Halaman menu pelanggan berdasarkan meja.
- Proses pemesanan dan tracking pesanan.
- Panel admin untuk menu, meja, dan pembayaran.
- Panel koki untuk antrean dan status masak.

## Instalasi Lokal

1. Clone repository.
2. Jalankan install dependency:

```bash
composer install
npm install
```

3. Salin file environment:

```bash
copy .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Atur koneksi database di file `.env`.
6. Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

7. Jalankan aplikasi:

```bash
php artisan serve
npm run dev
```

## Catatan Deploy

- Pastikan folder `storage` dan `bootstrap/cache` memiliki permission yang sesuai.
- Jangan commit file `.env`.
- Pastikan `vendor` dan `node_modules` tetap tidak masuk ke repository.

## License

Project ini menggunakan lisensi MIT.