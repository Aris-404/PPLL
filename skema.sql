-- ==========================================
-- CREATE DATABASE (opsional)
-- ==========================================
CREATE DATABASE IF NOT EXISTS webdata;
USE webdata;

-- ==========================================
-- TABLE: users (untuk login)
-- ==========================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(150)
);

-- ==========================================
-- TABLE: service
-- ==========================================
CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL
    deskripsi TEXT,
    gambar VARCHAR(255) NOT NULL,
);

-- ==========================================
-- TABLE: kategori
-- ==========================================
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

-- ==========================================
-- TABLE: produk
-- ==========================================
CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    kategori_id INT,
    harga DECIMAL(15,2) NOT NULL,
    link VARCHAR(255) NOT NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL
);

-- ==========================================
-- TABLE: tim
-- ==========================================
CREATE TABLE tim (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    nim VARCHAR(30) NOT NULL,
    foto VARCHAR(255),
    sosmed VARCHAR(255)
);

-- ==========================================
-- TABLE: testimoni
-- ==========================================
CREATE TABLE testimoni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    jabatan VARCHAR(150),
    deskripsi TEXT
);

-- ==========================================
-- TABLE: gallery
-- ==========================================
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gambar VARCHAR(255) NOT NULL,
    kategori_id INT,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL
);

-- ==========================================
-- TABLE: setting (1 baris saja)
-- ==========================================
CREATE TABLE setting (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alamat TEXT,
    email VARCHAR(150),
    jam_operasional VARCHAR(150),
    wa VARCHAR(50),
    telp VARCHAR(50),
    ig VARCHAR(150),
    fb VARCHAR(150)
);
