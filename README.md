# 🏍️ 28SpeedShop - Inventory Management System

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

![GitHub repo size](https://img.shields.io/github/repo-size/HaikalRiyadh/28speedshop?style=flat-square)
![GitHub stars](https://img.shields.io/github/stars/HaikalRiyadh/28speedshop?style=flat-square)
![GitHub forks](https://img.shields.io/github/forks/HaikalRiyadh/28speedshop?style=flat-square)
![GitHub issues](https://img.shields.io/github/issues/HaikalRiyadh/28speedshop?style=flat-square)

**Sistem Manajemen Inventori Modern untuk Toko Aksesoris Motor**

[Demo](#-demo) • [Fitur](#-fitur-utama) • [Instalasi](#-instalasi) • [Cara Penggunaan](#-cara-penggunaan) • [Kontribusi](#-kontribusi)

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



---

## 🛠️ Teknologi yang Digunakan

### Tech Stack

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

### Libraries & Dependencies

| Library | Version | Purpose |
|---------|---------|---------|
| Bootstrap | 5.x | UI Framework |
| DataTables | 7.1.2+ | Table Management |
| SweetAlert2 | 11.x | Alert Notifications |
| Font Awesome | 6.3.0 | Icons |
| Chart.js | Latest | Data Visualization |

---

## 🚀 Instalasi

### ⚙️ System Requirements

| Component | Minimum | Recommended |
|-----------|---------|-------------|
| PHP | 7.4+ | 8.0+ |
| MySQL | 5.7+ | 8.0+ |
| RAM | 512MB | 1GB+ |
| Disk Space | 50MB | 100MB+ |
| Web Server | Apache 2.4+ | Apache/Nginx |

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

## 📁 Struktur Proyek

```
28speedshop/
├── 📄 index.php          # Halaman Stock Barang
├── 📄 login.php          # Halaman Login
├── 📄 logout.php         # Proses Logout
├── 📄 masuk.php          # Halaman Barang Masuk
├── 📄 keluar.php         # Halaman Barang Keluar
├── 📄 function.php       # Fungsi & Koneksi Database
├── 📄 cek.php            # Middleware Authentication
├── 📄 database.sql       # SQL Database Schema
├── 📁 assets/
│   ├── 📁 demo/          # Demo files (charts, datatables)
│   └── 📁 img/           # Images & icons
├── 📁 css/
│   ├── styles.css        # Main styles
│   └── custom.css        # Custom styling
└── 📁 js/
    ├── scripts.js        # Main JavaScript
    └── datatables-simple-demo.js
```

---


---

## �📊 Struktur Database

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

## ❓ FAQ & Troubleshooting

<details>
<summary><b>💡 Tidak bisa login?</b></summary>

- Pastikan database sudah di-import dengan benar
- Cek koneksi database di `function.php`
- Gunakan kredensial default: `admin@28speedshop.com` / `admin123`
</details>

<details>
<summary><b>💡 Error "Table doesn't exist"?</b></summary>

- Pastikan file `database.sql` sudah di-import ke database
- Cek nama database sudah sesuai: `28speedshop`
- Restart Apache/MySQL service
</details>

<details>
<summary><b>💡 Stok tidak update otomatis?</b></summary>

- Cek trigger di database sudah berjalan
- Update manual melalui phpMyAdmin jika perlu
- Pastikan qty yang diinput valid (angka positif)
</details>

<details>
<summary><b>💡 Cara menambah user baru?</b></summary>

```sql
INSERT INTO login (email, password) VALUES ('email@example.com', 'password123');
```
*Catatan: Sebaiknya implementasikan password hashing untuk keamanan*
</details>

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Jika ingin berkontribusi:

1. Fork repository ini
2. Buat branch baru (`git checkout -b feature/NamaFitur`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin feature/NamaFitur`)
5. Buat Pull Request

---

---



---



---

## 📞 Kontak & Support

Jika ada pertanyaan atau butuh bantuan:

- 📧 Email: haikalriyadhr@gmail.com
- 💬 Issues: [GitHub Issues](https://github.com/HaikalRiyadh/28speedshop/issues)
- 🌟 Star project ini jika bermanfaat!

---

## 🎉 Show Your Support

Berikan ⭐️ jika project ini membantu Anda!

[![GitHub followers](https://img.shields.io/github/followers/HaikalRiyadh?style=social)](https://github.com/HaikalRiyadh)
[![GitHub stars](https://img.shields.io/github/stars/HaikalRiyadh/28speedshop?style=social)](https://github.com/HaikalRiyadh/28speedshop/stargazers)

---

## 👨‍💻 Author

**HaikalRiyadh**

🌐 GitHub: [@HaikalRiyadh](https://github.com/HaikalRiyadh)

---

<div align="center">

### ⭐ Jika project ini membantu, jangan lupa berikan star!

**Made with ❤️ by HaikalRiyadh**

[⬆ Back to Top](#-28speedshop---inventory-management-system)

</div>
