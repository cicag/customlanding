# Simple PHP/HTML/CSS/JS Landing Page

Versi sederhana (tanpa React). Bisa dijalankan di XAMPP/LAMPP dengan meletakkan folder ini di htdocs.

## Cara menjalankan
1. Pindahkan/copy folder ini ke `xampp/htdocs/` (atau `lampp/htdocs/`)
2. Buka browser: `http://localhost/mylandingpage/index.php` atau `http://localhost/mylandingpage/`
3. Data bisa diedit di `src/data/data.json`

## Struktur
- `index.php` - Halaman utama (PHP)
- `index.html` - Versi HTML statis lengkap
- `public/` - CSS, JS, fonts, img
- `src/data/data.json` - Konten landing page
- `imgs/` - Gambar tambahan

## Perubahan dari React
- React components dikonversi ke HTML/PHP
- `particles-bg` diganti dengan `particles.js`
- `react-simple-image-viewer` diganti dengan `nivo-lightbox`
- Smooth scroll pakai jQuery (sudah ada)
