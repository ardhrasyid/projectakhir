# Sistem Informasi Kesiswaan

Sistem Informasi Kesiswaan adalah aplikasi berbasis web yang dirancang untuk membantu pengelolaan di sekolah. Aplikasi ini dibangun menggunakan framework Laravel.

## Fitur Utama

### 1. Pengelolaan Jadwal Pelajaran
- **Staff**: Mengatur dan mengelola jadwal pelajaran.
- **Guru**: Melihat jadwal pelajaran yang telah diatur.
- **Siswa**: Melihat jadwal pelajaran yang telah diatur.

### 2. Pendaftaran Ekstrakurikuler
- **Staff**: Menambahkan ekstrakurikuler baru dan melihat daftar anggota.
- **Guru**: Mengelola ekstrakurikuler, termasuk menerima anggota baru.
- **Siswa**: Mendaftar untuk ekstrakurikuler yang tersedia.

### 3. Pencatatan Prestasi
- **Staff**: Memvalidasi Data Prestasi.
- **Siswa**: Mengajukan dan melihat prestasi pribadi.

### 4. Pencatatan Pelanggaran
- **Staff**: Mengelola data pelanggaran siswa
- **Siswa**: Melihat Pelanggaran pribadi

## Teknologi yang Digunakan

- **Frontend**:
  - [Tailwind CSS](https://tailwindcss.com/)
  - [Alpine.js](https://alpinejs.dev/)
  - [Font Awesome](https://fontawesome.com/)
  
- **Backend**:
  - [Laravel](https://laravel.com/)
  - [MySQL](https://www.mysql.com/)

## Instalasi

### Prasyarat
Pastikan Anda memiliki berikut ini sebelum memulai:
- PHP >= 8.0
- Composer
- Node.js
- MySQL

### Langkah-langkah

1. Clone repositori ini:
   ```bash
   git clone https://github.com/username/repo-siswa.git
   cd repo-siswa
   ```

2. Instal dependensi PHP:
   ```bash
   composer install
   ```

3. Instal dependensi Node.js:
   ```bash
   npm install
   ```

4. Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database:
   ```bash
   cp .env.example .env
   ```

5. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

7. Jalankan server pengembangan:
   ```bash
   php artisan serve
   npm run dev
   ```

Aplikasi akan berjalan di [http://localhost:8000](http://localhost:8000).

## Penggunaan

### Role dan Akses
- **Staff**:

- **Guru**:

- **Siswa**:


### Otentikasi
Pastikan pengguna melakukan login untuk mengakses fitur sesuai dengan peran mereka.

## Kontribusi

Kontribusi sangat diterima! Silakan buat pull request atau buka issue untuk diskusi lebih lanjut.

## Kontak

Jika Anda memiliki pertanyaan atau masukan, silakan hubungi saya di [m.alrasyid3103@gmail.com](m.alrasyid3103@gmail.com).
