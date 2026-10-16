# Simple PHP/HTML/CSS/JS Landing Page

Versi sederhana (tanpa React). Bisa dijalankan di XAMPP/LAMPP dengan meletakkan folder ini di htdocs.

## Cara menjalankan
1. Pindahkan/copy folder ini ke `xampp/htdocs/` (atau `lampp/htdocs/`)
2. Buka browser: `http://localhost/mylandingpage/index.php` atau `http://localhost/mylandingpage/`
3. Data bisa diedit di `src/data.json`

## Struktur Landing Page
1. Topbar: logo + nama perusahaan, navigasi Layanan, Legalitas, tombol Kontak Kami
2. Hero: tagline, nama perusahaan, motto, deskripsi, tombol Lihat Layanan Kami
3. Empat ikon circle (keunggulan)
4. Apa yang Kami Tawarkan: 4 jasa dengan dropdown keterangan
5. Legalitas: 10 data legal perusahaan
6. Kontak Kami: email, telepon/WhatsApp, lokasi, tombol Kirim Pesan
7. Footer

## Struktur File
- `index.php` - Halaman utama (PHP), seluruh teks diambil dari `src/data.json`
- `index.html` - Redirect ke `index.php`
- `public/` - CSS, JS, fonts, img
- `src/data.json` - Konten landing page (tidak di-commit)
- `src/data.json.example` - Contoh/template konten (di-commit)
- `imgs/` - Gambar tambahan

## Menyiapkan data
1. Copy `src/data.json.example` menjadi `src/data.json`
2. Sesuaikan isi `data.json` (nama perusahaan, legalitas, kontak, dll.)
3. Nama: `Company.name` (judul halaman/meta), `Company.header_name` (nama di Topbar/Header), dan `Company.hero_name` (nama di Hero). `header_name`/`hero_name` opsional — bila kosong memakai `Company.name`.
4. Logo: isi `Company.logo` (logo topbar) dan `Company.hero_logo` (logo pada Hero) dengan path gambar, contoh `public/img/logo.png`. Jika `hero_logo` kosong, Hero menampilkan slot placeholder (kotak bergaris putus-putus) sebagai ruang logo.
5. Peta: isi `Contact.map_embed` dengan URL embed Google Maps (diambil dari Google Maps → Share → **Embed a map**, salin bagian `src="..."`). Field ini menjadi sumber peta pada section Kontak.
6. Layanan: setiap item `Offerings.services[]` memiliki `name` dan `details` (array). Tiap poin di `details` mendukung `highlight` (judul tebal), `description` (deskripsi poin), dan `image` (path gambar, opsional — kosongkan bila tidak ada).
7. Legalitas: setiap item `Legalitas.items[]` mendukung `icon` (kelas Font Awesome, opsional — default `fa fa-file-text-o`), `label`, dan `value`.

## Bahasa Desain (Flat)
Mengikuti `DESIGN.md` dan `SKILL.md`:
- **Warna:** hijau daun `#2E7D32`, aksen emas `#C9A227`, cokelat jamu `#6D4C41`, krem `#F6F1E7`, latar gelap `#4E352D`; semantik success `#16A34A`, warning `#D97706`, danger `#DC2626`
- **Tipografi:** Inter (utama) + JetBrains Mono (label/eyebrow), skala 12/14/16/20/24/32
- **Spasi:** 4/8/12/16/24/32; **radius:** 4px / 8px
- Dua dimensi, minim: **tanpa gradient, shadow, dan tekstur**
- Aksesibilitas WCAG 2.2 AA, keyboard-first, `:focus-visible` jelas, struktur semantik (skip-link, `details/summary`, `dl`)

## Teknologi Front-end
- CSS murni dengan design token (custom properties) di `public/css/style.css`
- JavaScript vanilla di `public/js/main.js` (toggle menu mobile + penanda section aktif)
- Smooth scroll via CSS `scroll-behavior` + `scroll-margin-top`
- Ikon: Font Awesome; font: Google Fonts (Inter, JetBrains Mono)

> Catatan: Bootstrap, jQuery, particles.js, dan nivo-lightbox dari versi sebelumnya tidak lagi dipakai.
