# 🏍️ 28SpeedShop - Inventory Management System

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

**Sistem Manajemen Inventori Modern untuk Toko Aksesoris Motor**

[Demo](#-demo) • [Fitur](#-fitur-utama) • [Instalasi](#-instalasi) • [Dokumentasi](#-dokumentasi)

</div>

---

## 📋 Tentang Proyek

**28SpeedShop** adalah sistem manajemen inventori berbasis web yang dirancang khusus untuk toko aksesoris dan spare part motor. Aplikasi ini membantu Anda mengelola stok barang dengan mudah, mencatat barang masuk dan keluar, serta menyediakan visualisasi data real-time untuk analisis bisnis yang lebih baik.

### ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 📦 **Manajemen Stok** | Kelola data barang dengan sistem CRUD lengkap |
| ⬇️ **Barang Masuk** | Catat dan track barang yang masuk ke gudang |
| ⬆️ **Barang Keluar** | Monitor barang yang keluar/terjual |
| 📊 **Dashboard Interaktif** | Visualisasi data dengan chart dan grafik |
| 🔐 **Sistem Login** | Keamanan dengan autentikasi email dan password |
| 📱 **Responsive Design** | Tampilan optimal di semua perangkat |
| 🎨 **UI Modern** | Interface yang clean dan user-friendly |
| ⚡ **Real-time Update** | Data yang selalu ter-update langsung |

---

## 🎯 Demo

### Screenshot Aplikasi

> _Aplikasi ini memiliki interface modern dengan dashboard interaktif_

**Fitur Utama:**
- Dashboard dengan statistik real-time
- DataTables untuk pencarian dan sorting data
- Form input dengan validasi
- Alert notification menggunakan SweetAlert2
- Chart visualisasi data

---

## 🛠️ Teknologi yang Digunakan

```
Frontend:
├── HTML5 & CSS3
├── Bootstrap 5
├── JavaScript (ES6+)
├── Font Awesome Icons
├── SweetAlert2
└── Chart.js

Backend:
├── PHP 7.4+
├── MySQL/MariaDB
└── Session Management

Tools:
├── Laragon/XAMPP
└── DataTables Plugin
```

---

## 🚀 Instalasi

### Prasyarat

Pastikan Anda sudah menginstall:
- ✅ PHP 7.4 atau lebih tinggi
- ✅ MySQL/MariaDB
- ✅ Web Server (Apache/Nginx)
- ✅ Web Browser modern

### Langkah Instalasi

1️⃣ **Clone atau Download Repository**
```bash
git clone https://github.com/HaikalRiyadh/28speedshop.git
cd 28speedshop
```

2️⃣ **Setup Database**
```bash
# Buka phpMyAdmin atau MySQL client
# Import file database.sql
mysql -u root -p < database.sql
```

Atau secara manual:
- Buat database baru dengan nama `28speedshop`
- Import file `database.sql` ke database tersebut

3️⃣ **Konfigurasi Koneksi Database**

Edit file `function.php` dan sesuaikan dengan konfigurasi Anda:
```php
$conn = mysqli_connect("localhost", "root", "", "28speedshop");
```

4️⃣ **Jalankan Aplikasi**
```bash
# Jika menggunakan Laragon
# Akses: http://localhost/28speedshop

# Jika menggunakan PHP Built-in Server
php -S localhost:8000
```
---
```

### ERD (Entity Relationship Diagram)

```
┌──────────┐       ┌──────────┐       ┌──────────┐
│  STOCK   │ 1   N │  MASUK   │       │  LOGIN   │
│          ├───────┤          │       │          │
│ idbarang │       │ idmasuk  │       │ iduser   │
│ nama     │       │ idbarang │       │ email    │
│ deskripsi│       │ qty      │       │ password │
│ stock    │       │ tanggal  │       └──────────┘
└────┬─────┘       └──────────┘
     │
     │ 1:N
     │
┌────┴─────┐
│  KELUAR  │
│          │
│ idkeluar │
│ idbarang │
│ qty      │
│ tanggal  │
└──────────┘
```

---
<div align="center">

### ⭐ Jika project ini membantu, jangan lupa berikan star!

**Made with HaikalRiyadh**

[⬆ Back to Top](#-28speedshop---inventory-management-system)

</div>
