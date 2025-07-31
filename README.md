# PT Smart CRM - Customer Relationship Management System

Sistem CRM berbasis Laravel 11 untuk PT Smart, perusahaan ISP yang fokus pada pengelolaan leads, projects, dan customers oleh divisi Sales.

## 🚀 Fitur Utama

- **Autentikasi** menggunakan Laravel Breeze
- **Role Management** (Admin, Manager, Sales) dengan Spatie Permission
- **Lead Management** - Kelola calon customer
- **Product Management** - Master data layanan internet
- **Project Management** - Proses konversi lead ke customer dengan approval workflow
- **Customer Management** - Kelola customer aktif dan layanan mereka
- **Notification System** - Notifikasi real-time untuk approval
- **Activity Logging** - Audit trail semua aktivitas user
- **PDF Reports** - Export laporan dalam format PDF
- **Role-based Access Control** - Akses berdasarkan role user

## 📋 Struktur Database

### Tabel Utama:
- **users** - Data user (admin, manager, sales)
- **leads** - Data calon customer
- **products** - Master produk layanan internet
- **projects** - Proses konversi lead dengan approval workflow
- **customers** - Data customer aktif
- **customer_products** - Relasi customer dengan produk (many-to-many)
- **activity_logs** - Log aktivitas user
- **notifications** - Sistem notifikasi

### Roles & Permissions:
- **Admin**: Full access ke semua fitur
- **Manager**: Approve projects, manage data, view reports
- **Sales**: CRUD leads, create projects, manage customers

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Database**: PostgreSQL 14
- **Frontend**: Blade Templates (tidak menggunakan Inertia.js/Livewire)
- **Authentication**: Laravel Breeze
- **Permissions**: Spatie Laravel Permission
- **PDF Generation**: DomPDF
- **CSS Framework**: Bootstrap (via Laravel Breeze)

## 📦 Instalasi

### Prerequisites
- PHP 8.2+
- PostgreSQL 14
- Composer
- Node.js & NPM

### Langkah Instalasi

#### 🚀 Otomatis Setup (Recommended)

**Untuk Windows:**
```powershell
# Jalankan PowerShell sebagai Administrator
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
.\setup-database.ps1
```

**Untuk Linux/Mac:**
```bash
chmod +x setup-database.sh
./setup-database.sh
```

**Menggunakan Laravel Artisan Command:**
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan db:setup
```

#### 📝 Manual Setup

1. **Clone repository**
```bash
git clone https://github.com/MichaelSetiabudi/MichaelSetiabudi_crm.git
cd MichaelSetiabudi_crm
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Buat database PostgreSQL**
```sql
-- Masuk ke PostgreSQL sebagai superuser
psql -U postgres

-- Buat database
CREATE DATABASE smart_crm;

-- Keluar dari PostgreSQL
\q
```

5. **Konfigurasi database di .env**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=smart_crm
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

6. **Jalankan migration dan seeder**
```bash
php artisan migrate:fresh --seed
```

7. **Build assets**
```bash
npm run build
```

8. **Jalankan aplikasi**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🛠️ Database Setup Commands

### Artisan Command
```bash
# Setup database dengan prompt interaktif
php artisan db:setup

# Setup dengan parameter langsung
php artisan db:setup --host=127.0.0.1 --port=5432 --username=postgres --database=smart_crm
```

### Script Options
```bash
# Windows PowerShell (sebagai Administrator)
.\setup-database.ps1

# Linux/Mac Bash
./setup-database.sh
```

## 👥 Default Users

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### Admin
- **Email**: admin@ptsmart.com
- **Password**: password

### Manager
- **Email**: budi.manager@ptsmart.com
- **Password**: password

### Sales
- **Email**: ahmad.sales@ptsmart.com
- **Password**: password

## 📊 Data Dummy

Seeder akan membuat:
- 8 Users (1 Admin, 2 Manager, 5 Sales)
- 9 Products (paket layanan internet residential, business, enterprise)
- 40 Leads dengan berbagai status
- 25 Projects dengan workflow approval
- Customers dan Customer-Products berdasarkan approved projects
- Activity logs dan notifications

## 🗂️ Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── LeadController.php
│   │   ├── ProductController.php
│   │   ├── ProjectController.php
│   │   ├── CustomerController.php
│   │   ├── ReportController.php
│   │   └── DashboardController.php
│   ├── Middleware/
│   └── Requests/
├── Models/
│   ├── User.php
│   ├── Lead.php
│   ├── Product.php
│   ├── Project.php
│   ├── Customer.php
│   ├── CustomerProduct.php
│   ├── ActivityLog.php
│   └── Notification.php
└── Services/
    ├── ActivityLogService.php
    ├── NotificationService.php
    └── ReportService.php

resources/
├── views/
│   ├── layouts/
│   ├── dashboard/
│   ├── leads/
│   ├── products/
│   ├── projects/
│   ├── customers/
│   └── reports/
└── js/
    └── app.js

database/
├── migrations/
└── seeders/
```

## 🔐 Role-based Access

### Admin
- Manage users, roles & permissions
- Full CRUD pada semua entitas
- View semua reports
- Access activity logs

### Manager  
- Approve/reject projects
- View & manage leads, products, customers
- Generate reports
- Receive approval notifications

### Sales
- CRUD leads yang di-assign
- View products
- Create & update projects
- Manage customers hasil konversi
- Basic reporting

## 📈 Workflow Bisnis

1. **Lead Creation**: Sales input lead baru
2. **Lead Qualification**: Sales follow-up dan qualify lead
3. **Project Creation**: Sales buat project dari qualified lead
4. **Manager Approval**: Manager review dan approve/reject project
5. **Customer Conversion**: Approved project otomatis jadi customer
6. **Service Activation**: Customer mulai berlangganan layanan

## 🔧 Commands

```bash
# Reset database dengan data fresh
php artisan migrate:fresh --seed

# Generate laporan PDF
php artisan tinker
>>> App\Services\ReportService::generateReport('leads')

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Run tests
php artisan test
```

## 📝 API Endpoints (Optional)

Untuk integrasi dengan sistem lain:

```
GET /api/leads - List leads
POST /api/leads - Create lead
GET /api/projects - List projects
PUT /api/projects/{id}/approve - Approve project
GET /api/customers - List customers
```

## 🐛 Troubleshooting

### Database Connection Error
- Pastikan PostgreSQL berjalan
- Cek konfigurasi .env
- Pastikan database `smart_crm` sudah dibuat

### Permission Denied
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Seeder Error
```bash
composer dump-autoload
php artisan migrate:fresh --seed
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📄 License

This project is licensed under the MIT License.

## 📞 Support

Untuk pertanyaan atau support:
- **Email**: michael.setiabudi@example.com
- **GitHub**: @MichaelSetiabudi

---

**PT Smart CRM** - Streamlining ISP Customer Management © 2025

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
