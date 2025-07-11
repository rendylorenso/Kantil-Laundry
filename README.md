<p align="center"><img src="https://i.imgur.com/g3v2FCI.png" width="500"></p>

# Aplikasi Laundry Sederhana

Aplikasi ini merupakan aplikasi laundry sederhana yang dirancang untuk memberikan kemudahan dalam proses pencucian pakaian Anda. Dengan antarmuka pengguna yang intuitif dan proses pemesanan yang cepat, CleanLaundry menyediakan solusi praktis untuk kebutuhan laundry Anda.

Beberapa fitur diantaranya:

-   Daftar / Register
-   Masuk / Login
-   Dashboard
-   Daftar Harga
-   Tambah Pesanan
-   Riwayat Transaksi
-   Daftar Member
-   Voucher
-   Saran / Komplain
-   Laporan Keuangan
-   Edit Profile
-   Cetak PDF Laporan Keuangan
-   Cetak Transaksi

Khusus Admin Daftar / Register dengan url `/register-admin`. Secret key dapat diubah di env atau default "admin123".

Login admin:  
Email : admin@laundryxyz.com  
Password : admin123

Login admin:  
Email : member@gmail.com  
Password : member123

Dalam perancangan Aplikasi ini, kami menggunakan PHP versi 8.1 dan Framework Laravel 9.

## Screenshot

### Landing Page

<img src="https://i.imgur.com/JCmeLQt.png" style="width:100%;" />

### Dashboard Admin

<img src="https://i.imgur.com/FrNOQiu.png" style="width:100%;" />

### Dashboard Member

<img src="https://i.imgur.com/QgKYdGp.png" style="width:100%;" />

### Fitur Cetak Bukti Transaksi [ Admin ]

<img src="https://i.imgur.com/5Aj0yNv.png" style="width:100%;" />

### Fitur Cetak Laporan Keuangan [ Admin ]

<img src="https://i.imgur.com/t69mpps.png" style="width:100%;" />

## Cara Instalasi

1. Setelah di download dan di Extract langkah selanjutnya Buka terminal dan jalankan perintah berikut untuk menginstall composer

-   `$ > cd CleanLaundry-aplikasi-laundry-sederhana-berbasis-laravel`

```
composer install
```

2. Copy dan rename .env.example menjadi .env
3. Konfigurasi .env sesuai kebutuhan
4. Buat app key:
```
php artisan key:generate
```

5. Jalankan storage link
```
php artisan storage:link
```

6. cek link route
```
php artisan route:list
```

7. Jalankan migrasi dan seed:
```
php artisan migrate:fresh --seed
```

## Cara Menjalakan Aplikasi Laundry

-   Buka terminal dan jalankan perintah berikut untuk memulai

-   `$ > cd cleanlaundry-laravel`

```
php artisan serve
```

Silahkan buka browser dan ketikkan : http://localhost:8000

## Cara Menggunakan

1. **Pendaftaran:** Daftar dan buat akun pelanggan/member untuk mengakses layanan kami.

2. **Pesanan:** Pilih layanan yang diinginkan, tentukan detail pesanan, dan selesaikan proses pemesanan dengan cepat. Ikuti langkah-langkah mudah untuk menyelesaikan proses pemesanan Anda. Pantau status pesanan Anda melalui dashboard pengguna/member.

3. **Riwayat Transaksi:** Pantau dan kelola riwayat transaksi Anda untuk melacak semua pesanan sebelumnya.

CleanLaundry bertujuan untuk memberikan layanan pencucian pakaian yang berkualitas dan mudah diakses. Kami berkomitmen untuk membuat pengalaman laundry Anda menjadi lebih efisien dan menyenangkan. Selamat mencuci bersih dengan CleanLaundry!

## Informasi Tambahan

Aplikasi ini juga menerapkan queue database untuk menghapus foto profil ketika diganti, kalian bisa mengganti environment variable `QUEUE_CONNECTION` menjadi database.
