# UAS WEB 2 ShowPro

Proyek ini adalah implementasi dari Ujian Akhir Semester (UAS) untuk mata kuliah Web 2. Proyek ini mencakup pengembangan aplikasi web sederhana menggunakan framework CodeIgniter 4, dengan tujuan untuk menunjukkan pemahaman dan kemampuan dalam pengembangan web.

## Fitur Utama

- **Manajemen Pengguna**: Fitur untuk menambah, mengedit, dan menghapus pengguna.
- **Autentikasi**: Sistem login dan logout untuk pengguna terdaftar.
- **Tampilan Produk**: Halaman untuk menampilkan daftar produk dengan informasi detail.
- **CRUD Produk**: Fitur untuk membuat, membaca, memperbarui, dan menghapus produk.
- **Dashboard Admin**: Panel administrasi untuk mengelola konten situs web.

## Teknologi yang Digunakan

- **Framework**: CodeIgniter 4
- **Bahasa Pemrograman**: PHP, HTML, CSS, JavaScript
- **Database**: MySQL
- **Libraries**: jQuery, Bootstrap

## Cara Menggunakan

1. **Kloning Repository**:
    ```bash
    git clone https://github.com/username/UAS_WEB_2_ShowPro.git
    ```
2. **Instalasi Dependensi**:
    Pindah ke direktori proyek dan jalankan perintah berikut untuk menginstal dependensi:
    ```bash
    cd UAS_WEB_2_ShowPro
    composer install
    ```
3. **Konfigurasi Database**:
    Sesuaikan konfigurasi database di file `.env`:
    ```
    database.default.hostname = localhost
    database.default.database = nama_database_anda
    database.default.username = nama_pengguna_anda
    database.default.password = kata_sandi_anda
    database.default.DBDriver = MySQLi
    ```
4. **Migrasi Database**:
    Jalankan migrasi database untuk membuat tabel yang diperlukan:
    ```bash
    php spark migrate
    ```
5. **Menjalankan Aplikasi**:
    Jalankan server lokal untuk melihat aplikasi:
    ```bash
    php spark serve
    ```

## Kontribusi

Kontribusi sangat terbuka untuk proyek ini. Jika Anda ingin berkontribusi, silakan fork repository ini, buat branch baru, lakukan perubahan yang diperlukan, dan kirim pull request.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

