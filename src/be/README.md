# Backend Apps

Aplikasi *backend* ini dibangun menggunakan *framework* Laravel versi 11. Untuk dapat menjalankan aplikasi ini dengan baik, perangkat Anda harus memenuhi persyaratan sistem minimum berikut:

#### Persyaratan Server
- PHP >= 8.2
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- Filter PHP Extension
- Hash PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Session PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Composer >= 2.7.6

Setelah memastikan perangkat Anda memenuhi semua persyaratan, Anda perlu mengkonfigurasi aplikasi dengan cara:
- Duplikat file ```.env.example``` dan ganti namanya menjadi ```.env```.
- Edit file ```.env``` yang baru saja dibuat. Isi nilai setiap variabel sesuai dengan pengaturan perangkat Anda (misalnya, nama database, username database, dan password database).

Jika telah selesai, langkah selanjutnya adalah menginstal aplikasi *backend* dengan mengikuti petunjuk di bawah ini.

## Install Aplikasi

Install Packages

```sh 
composer install 
```

Generate APP_KEY in .env

```sh 
php artisan key:generate
```

Generate link (symlink) storage 

```sh
php artisan storage:link
```

Migrating Database

```sh
php artisan migrate
```

Seeding Default Data

```sh
php artisan db:seed
```

Running Application

```sh
php artisan serve
```
