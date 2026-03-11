# Laravel Project

Project ini dibuat menggunakan **Laravel Framework**. README ini berisi panduan instalasi dan cara menjalankan project di environment lokal.

---

# Requirements

Pastikan sistem sudah terinstall:

- PHP >= 8.2
- Composer
- Pgsql/mysql 
- Node.js & NPM 


## 1. Clone Repository

Clone repository dari GitHub:

```bash
git clone https://github.com/tiyok9/api.git
```

## 2. Install Dependency Laravel

Install dependency menggunakan Composer:

```bash
composer install
```

---

## 3. Setup Environment File

Copy file `.env.example` menjadi `.env`


## 4. Generate Application Key

Generate key aplikasi Laravel:

```bash
php artisan key:generate
```

---

# Environment Configuration (.env)

Edit file `.env` sesuai dengan konfigurasi lokal.

Contoh konfigurasi:

```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

# Database Setup

1. Buat database baru di Pgsql/Mysql
2. Sesuaikan konfigurasi database pada `.env`

Contoh:

```env
DB_DATABASE=api
DB_USERNAME=root
DB_PASSWORD=
```

---

# Run Migration

Jalankan migration untuk membuat tabel database:

```bash
php artisan migrate
```
Setup Token Passport

```bash
php artisan passport:client --password
```
Copy hasil generate client id dan secret id ke env
Contoh konfigurasi:
```env
PASSPORT_PASSWORD_CLIENT_ID=019cdde2-1f76-****-a500-*******
PASSPORT_PASSWORD_CLIENT_SECRET=B5413rxY****a00y9mEg8FOZGC9uEh6a8OtifZ
```

Input key reverb di env
Contoh konfigurasi:
```env
REVERB_APP_KEY=
REVERB_APP_SECRET=
```

Jalankan Seeder:

```bash
php artisan db:seed
```

---

# Install Dependencies

Install dependency:

```bash
npm install
```

# Run Server

Jalankan server Laravel,Reverb,Queue,Vite:

```bash
composer run dev
```

Akses EndPoint API melalui:

```
http://127.0.0.1:8000
```
Detail Doc Enpoint ada di folder doc project menggunakan open api:


