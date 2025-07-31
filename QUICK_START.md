# Quick Start - PT Smart CRM

Untuk testing aplikasi dengan cepat tanpa setup database kompleks, ikuti langkah berikut:

## 🚀 Menggunakan Setup Otomatis

### Windows (PowerShell)
```powershell
# 1. Buka PowerShell sebagai Administrator
# 2. Jalankan command berikut:
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
.\setup-database.ps1
```

### Linux/Mac (Bash)
```bash
# 1. Beri permission pada script:
chmod +x setup-database.sh

# 2. Jalankan script:
./setup-database.sh
```

### Menggunakan Laravel Artisan
```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate app key
php artisan key:generate

# 4. Setup database (akan prompt untuk input)
php artisan db:setup

# 5. Jalankan aplikasi
php artisan serve
```

## 📋 Informasi Setup

Script akan melakukan:
1. ✅ Test koneksi PostgreSQL
2. ✅ Buat database `smart_crm`
3. ✅ Update file `.env`
4. ✅ Test koneksi Laravel
5. ✅ Jalankan migration dan seeder
6. ✅ Siap digunakan!

## 🔑 Login Default

Setelah setup selesai:

**Admin:**
- Email: admin@ptsmart.com
- Password: password

**Manager:**
- Email: budi.manager@ptsmart.com  
- Password: password

**Sales:**
- Email: ahmad.sales@ptsmart.com
- Password: password

## 🌐 Akses Aplikasi

Setelah menjalankan `php artisan serve`, buka:
http://localhost:8000

## ⚠️ Troubleshooting

### PostgreSQL tidak ditemukan
```bash
# Windows: Install PostgreSQL dari https://www.postgresql.org/download/windows/
# Mac: brew install postgresql
# Ubuntu: sudo apt install postgresql postgresql-contrib
```

### Permission denied di Windows
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

### Database sudah ada
Script akan skip pembuatan database jika sudah ada dan melanjutkan setup.

---

**Selamat menggunakan PT Smart CRM! 🎉**
