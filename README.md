# Simple PHP/HTML/CSS/JS Landing Page

Versi sederhana (tanpa React). Arahkan docroot ke /public

## Menyiapkan data
1. Copy `src/data.json.example` menjadi `src/data.json`
2. Sesuaikan isi `data.json` (nama perusahaan, legalitas, kontak, dll.)
3. Nama: `Company.name` (judul halaman/meta), `Company.header_name` (nama di Topbar/Header), dan `Company.hero_name` (nama di Hero). `header_name`/`hero_name` opsional — bila kosong memakai `Company.name`.
4. Logo: isi `Company.logo` (logo topbar) dan `Company.hero_logo` (logo pada Hero) dengan path gambar **relatif terhadap `public/`**, contoh `imgs/LOGO.webp`. Jika `hero_logo` kosong, Hero menampilkan slot placeholder (kotak bergaris putus-putus) sebagai ruang logo.
5. Peta: isi `Contact.map_embed` dengan URL embed Google Maps (diambil dari Google Maps → Share → **Embed a map**, salin bagian `src="..."`). Field ini menjadi sumber peta pada section Kontak.
6. Layanan: setiap item `Offerings.services[]` memiliki `name` dan `details` (array). Tiap poin di `details` mendukung `highlight` (judul tebal), `description` (deskripsi poin), `image` (path gambar relatif terhadap `public/`, opsional — kosongkan bila tidak ada), serta `link` dan `link_label` (opsional — menampilkan tautan yang dapat diklik di bawah deskripsi; `link_label` default ke nilai `link`). URL tanpa skema otomatis diberi `https://`; tautan `http(s)` dibuka di tab baru.
7. Legalitas: setiap item `Legalitas.items[]` mendukung `icon` (kelas Font Awesome, opsional — default `fa fa-file-text-o`), `label`, dan `value`.
