# 💄 CMS Makeup — Kelompok PPLL

Sebuah Content Management System (CMS) bertema produk makeup yang berfungsi sebagai katalog informasi, edukasi, dan rekomendasi. Semua transaksi diarahkan ke platform eksternal seperti Shopee.

---

## 📖 Ringkasan Proyek

CMS ini dibuat untuk menampilkan dan mengelola data produk makeup secara informatif. Website ini berfungsi sebagai pusat katalog, panduan pemilihan produk, serta rekomendasi bagi pengguna. Untuk pembelian, pengguna akan diarahkan ke platform pihak ketiga (mis. Shopee) melalui tautan eksternal.

---

## ✨ Fitur Utama

- 🧭 **Dashboard Admin**
- 🗂️ **Manajemen Produk**
- 📝 **Editor Konten (Artikel, Tips, Panduan)**
- 🔗 **Integrasi Tautan Marketplace (Shopee, dsb.)**
- 🎯 **Sistem Rekomendasi**
- 🖼️ **Manajemen Gambar dan Galeri**
- 🔍 **SEO Optimized + Metadata**
- 🧠 **Pencarian & Filter Produk**
- 📊 **Tracking Klik ke Marketplace**
- 💬 **Review & Rating (opsional)**

---

## 📄 Struktur Halaman (Public)

### 🏡 Beranda

- Highlight produk unggulan
- Konten edukasi singkat
- Rekomendasi berdasarkan kategori populer

### 👥 Tentang Kami

Berisi:

- Profil brand
- Visi & misi
- Link akun marketplace resmi

### 📞 Kontak

Informasi komunikasi:

- WhatsApp
- Email
- Media sosial
- Peta lokasi (jika ada fisik store/office)

### 🎯 Rekomendasi Produk

Pengguna dapat memilih berdasarkan:

- Jenis kulit
- Warna kulit
- Hasil akhir makeup
- Kebutuhan dan preferensi

### 🖼️ Galeri Visual

- Foto close-up produk
- Before/after dan lookbook

### 🛍️ Katalog Produk

Berisi seluruh daftar produk dengan:

- Filter kategori
- Pencarian
- Sort harga/rating/popularitas
- Status ketersediaan (tampilan, bukan real-time)

### 🔍 Detail Produk

Informasi lengkap termasuk:

- Foto multi-angle
- Deskripsi
- Ingredients & spesifikasi
- Cara penggunaan
- Review & rating
- Tombol **"Beli via Shopee"** (tautan eksternal)

### 🛠️ Panduan & Artikel

Berisi:

- Tips memilih makeup
- FAQ
- Tutorial
- Artikel edukasi

---

Field inti untuk produk:

- Title / slug
- Brand
- Gambar
- Ingredients
- Deskripsi
- Varian
- Tags & kategori
- External link marketplace
- Spesifikasi (tone, coverage, finish, dll.)

---

## 🚀 Teknologi

- Headless CMS (Strapi / Directus / Sanity)
- Front-end (Next.js / Nuxt)
- Database (PostgreSQL)
- Storage (S3 compatible)
- Search (Meilisearch / Elastic)
- Tracking & Analytics

---

## 🔗 Integrasi Marketplace

- Tombol "Beli Sekarang" mengarah ke link eksternal (Shopee)
- Tracking klik
- Opsi parameter UTM

---

## 🎯 Target Pengguna

- Pengguna yang membutuhkan rekomendasi dan referensi makeup
- Beauty enthusiast
- Calon pembeli marketplace eksternal

---

## 📱 Responsivitas & UX

- Mobile-first
- Tampilan minimalis & estetik
- Navigasi jelas
- Optimasi gambar

---

## 📑 Roadmap Pengembangan

| Tahap | Fokus                                        |
| ----- | -------------------------------------------- |
| MVP   | Katalog produk + link eksternal              |
| v1    | Rekomendasi + galeri + artikel               |
| v2    | Sistem quiz rekomendasi + analytics lanjutan |
| v3    | Affiliate integration (opsional)             |

---

## 👥 Pengembang

Dikembangkan oleh **Kelompok PPLL — Universitas Trunojoyo Madura**

---

_Dibuat dengan ❤️ sebagai bagian dari Proyek Perangkat Lunak Lanjut_
