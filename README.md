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

5️⃣ **Login ke Sistem**

Gunakan kredensial default:
```
Email    : admin@28speedshop.com
Password : admin123
```

> ⚠️ **PENTING:** Segera ubah password default setelah login pertama kali!

---

## 📊 Struktur Database

```sql
28speedshop/
├── stock       → Tabel master barang
├── masuk       → Log barang masuk
├── keluar      → Log barang keluar
└── login       → Data user & autentikasi
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

## 📖 Dokumentasi

### Fitur Detail

#### 1. Stock Barang
- Tambah barang baru
- Edit informasi barang
- Hapus barang
- Lihat detail stok tersedia

#### 2. Barang Masuk
- Catat barang masuk dengan qty
- Otomatis update stok
- Histori barang masuk
- Filter berdasarkan tanggal

#### 3. Barang Keluar
- Catat barang keluar/terjual
- Validasi stok tersedia
- Otomatis kurangi stok
- Laporan barang keluar

---

## 🔒 Keamanan

- ✔️ Session-based authentication
- ✔️ SQL Injection prevention
- ✔️ Password protection
- ✔️ Input validation & sanitization
- ⚠️ Recommended: Implementasi password hashing (bcrypt/password_hash)

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Untuk berkontribusi:

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📝 To-Do List

- [ ] Implementasi password hashing
- [ ] Export data ke PDF/Excel
- [ ] Multi-user role management
- [ ] Fitur backup otomatis
- [ ] Email notification
- [ ] Barcode scanner integration
- [ ] Mobile app version
- [ ] Dashboard analytics advanced

---

## 🐛 Bug Report

Menemukan bug? Silakan laporkan melalui [Issues](https://github.com/HaikalRiyadh/28speedshop/issues) dengan detail:
- Deskripsi bug
- Langkah reproduksi
- Screenshot (jika ada)
- Environment (PHP version, OS, Browser)

---

## 📄 Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

---

## 👨‍💻 Author

**28SpeedShop Development Team**

💌 Email: admin@28speedshop.com  
🌐 Website: [28speedshop.com](https://28speedshop.com)  
📱 Support: [Contact Us](mailto:admin@28speedshop.com)

---

<div align="center">

### ⭐ Jika project ini membantu, jangan lupa berikan star!

**Made with ❤️ for the motorcycle community**

[⬆ Back to Top](#-28speedshop---inventory-management-system)

</div>
