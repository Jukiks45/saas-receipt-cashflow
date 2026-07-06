# AI Smart Finance 🧠💰

**AI Smart Finance** adalah aplikasi manajemen keuangan pintar berbasis web yang menggunakan **Laravel** untuk backend dan **Tailwind CSS + Chart.js** untuk frontend. Aplikasi ini dirancang untuk membantu pengguna mencatat, menganalisis, dan mengelola keuangan pribadi dengan bantuan **kecerdasan buatan (AI)** — termasuk fitur **OCR untuk upload struk** dan **klasifikasi transaksi otomatis**.

---

## ✨ Fitur Unggulan

| Fitur | Keterangan |
|-------|------------|
| 📊 **Dashboard** | Ringkasan keuangan, grafik arus kas, transaksi terbaru, dan **AI Health Score** |
| 💳 **Transaksi** | Kelola transaksi dengan **search & filter**, tambah manual, upload struk |
| 📷 **Upload Struk (OCR)** | Drag & drop struk → Preview → OCR → AI Classification → Simpan |
| 🤖 **AI Insight** | Analisis pintar pada dashboard dan halaman analisis |
| 📈 **Analisis** | Pie chart, bar chart, budget tracker, dan AI recommendation |
| ⚙️ **Pengaturan** | Profile, Telegram, Notifikasi, Password |

---

## 🖥️ Tampilan Halaman

| Halaman | Status |
|---------|--------|
| Dashboard | ✅ Selesai |
| Transaksi | ✅ Selesai (Table, Search, Filter, Upload Struk, Modal Manual) |
| Analisis | ✅ Selesai |
| Pengaturan | ✅ Selesai |
| Login | ✅ Selesai |
| Register | ✅ Selesai |
| Responsive | ✅ Selesai |

---

## 🚀 Cara Menjalankan (Local Development)

### Prasyarat

Pastikan komputer Anda sudah terinstall:

- **PHP** >= 8.1
- **Composer** (dependency manager PHP)
- **Node.js** & **NPM** (untuk asset bundling)
- **Database** (MySQL / PostgreSQL / SQLite)

### Langkah-langkah

#### 1. Clone Repository

```bash
git clone https://github.com/username/ai-smart-finance.git
cd ai-smart-finance
```

#### 2. Install Dependencies

```bash
composer install
npm install
```

#### 3. Copy File Environment

```bash
cp .env.example .env
```

> **Catatan:** Di Windows gunakan `copy .env.example .env`

#### 4. Generate Application Key

```bash
php artisan key:generate
```

#### 5. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ai_smart_finance
DB_USERNAME=root
DB_PASSWORD=
```

Atau jika ingin menggunakan SQLite (lebih sederhana):

```env
DB_CONNECTION=sqlite
DB_DATABASE=
```

Lalu buat file database:
```bash
# Untuk SQLite
touch database/database.sqlite
```

#### 6. Migrasi Database (Opsional untuk saat ini)

```bash
php artisan migrate
```

#### 7. Jalankan Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

#### 8. Build Assets (Jika ada perubahan CSS/JS)

```bash
npm run dev
```

---

## 📂 Struktur Folder (Frontend)

```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout utama (sidebar, navbar)
├── partials/
│   ├── navbar.blade.php       # Navigasi atas
│   └── sidebar.blade.php      # Sidebar menu
├── dashboard.blade.php        # Halaman Dashboard
├── transaksi.blade.php        # Halaman Transaksi + Upload Struk
├── analisis.blade.php         # Halaman Analisis
├── pengaturan.blade.php       # Halaman Pengaturan
├── login.blade.php            # Halaman Login
└── register.blade.php         # Halaman Register
```

### Routing

File: `routes/web.php`

```php
Route::get('/',             fn() => view('dashboard'))->name('dashboard');
Route::get('/transaksi',    fn() => view('transaksi'))->name('transaksi');
Route::get('/analisis',     fn() => view('analisis'))->name('analisis');
Route::get('/pengaturan',   fn() => view('pengaturan'))->name('pengaturan');
Route::get('/login',        fn() => view('login'))->name('login');
Route::get('/register',     fn() => view('register'))->name('register');
```

---

## 🧪 Demo Mode

Tekan tombol **`E`** pada keyboard di halaman Transaksi untuk toggle **Empty State** (simulasi ketika belum ada transaksi).

---

## 🛠️ Tech Stack

| Teknologi | Kegunaan |
|-----------|----------|
| **Laravel 11** | Framework PHP backend |
| **Tailwind CSS** | Utility-first CSS framework |
| **Chart.js** | Library grafik interaktif |
| **Font Awesome** | Icon library |
| **Google Poppins** | Font utama aplikasi |

---

## 🎯 Roadmap

- [x] Frontend Dashboard
- [x] Frontend Transaksi + Upload Struk (OCR dummy)
- [x] Frontend Analisis
- [x] Frontend Pengaturan
- [x] Frontend Auth (Login/Register)
- [ ] Backend Laravel (API & Database)
- [ ] Integrasi OCR (Tesseract / Google Vision)
- [ ] Integrasi AI Classification
- [ ] Autentikasi & Manajemen User
- [ ] Deployment

---

## 📝 Lisensi

**AI Smart Finance** dikembangkan untuk keperluan tugas **Rekayasa Perangkat Lunak (RPL)**.

---

Dibuat dengan ❤️ oleh Tim Pengembang
