-- =============================================
-- DATABASE: web_kelas_db
-- UNTUK WEB KELAS XI TJKT 2 - NEUBRUTALISM
-- =============================================

CREATE DATABASE IF NOT EXISTS web_kelas_db;
USE web_kelas_db;

-- 1. Tabel profil_kelas
CREATE TABLE profil_kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(100) DEFAULT 'XI TJKT 2',
    wali_kelas VARCHAR(100) DEFAULT 'Ariib Faturohman, S.Pd.',
    tahun_ajaran VARCHAR(20) DEFAULT '2026/2027',
    deskripsi TEXT,
    foto_kelas VARCHAR(255),
    bg_image VARCHAR(255)
);

-- 2. Tabel siswa
CREATE TABLE siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_siswa VARCHAR(100),
    cita_cita VARCHAR(255),
    motto TEXT,
    warna_tema VARCHAR(7) DEFAULT '#2c3e66',
    foto_profil VARCHAR(255),
    role ENUM('siswa', 'admin') DEFAULT 'siswa',
    jabatan VARCHAR(50) DEFAULT '',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel jadwal_piket
CREATE TABLE jadwal_piket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hari ENUM('Senin','Selasa','Rabu','Kamis','Jumat') NOT NULL,
    siswa_id INT NOT NULL,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE
);

-- 4. Tabel jadwal_pelajaran
CREATE TABLE jadwal_pelajaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hari ENUM('Senin','Selasa','Rabu','Kamis','Jumat') NOT NULL,
    jam_ke INT NOT NULL,
    mulai TIME,
    selesai TIME,
    mata_pelajaran VARCHAR(100),
    guru VARCHAR(100),
    ruang VARCHAR(50),
    warna VARCHAR(7) DEFAULT '#2c3e66'
);

-- 5. Tabel pengumuman
CREATE TABLE pengumuman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 6. Tabel tugas_siswa
CREATE TABLE tugas_siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT NOT NULL,
    judul_tugas VARCHAR(255) NOT NULL,
    deadline DATE,
    prioritas ENUM('Tinggi','Sedang','Rendah') DEFAULT 'Sedang',
    status ENUM('Belum','Selesai') DEFAULT 'Belum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE
);

-- 7. Tabel galeri
CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255),
    deskripsi TEXT,
    url_foto VARCHAR(255) NOT NULL,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 8. Tabel quote
CREATE TABLE quote (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teks_quote TEXT NOT NULL,
    penulis VARCHAR(100)
);

-- 9. Tabel lagu
CREATE TABLE lagu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    file_url VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- DATA AWAL
-- =============================================

-- Profil kelas
INSERT INTO profil_kelas (nama_kelas, wali_kelas, tahun_ajaran, deskripsi) VALUES
('XI TJKT 2', 'Ariib Faturohman, S.Pd.', '2026/2027', 'Kelas Teknik Komputer dan Jaringan yang kreatif, inovatif, dan berprestasi.');

-- 35 siswa default (password = username)
INSERT INTO siswa (username, password, nama_siswa, role, jabatan) VALUES
('SISWA1', 'SISWA1', 'Siswa 1', 'siswa', ''),
('SISWA2', 'SISWA2', 'Siswa 2', 'siswa', ''),
('SISWA3', 'SISWA3', 'Siswa 3', 'siswa', ''),
('SISWA4', 'SISWA4', 'Siswa 4', 'siswa', ''),
('SISWA5', 'SISWA5', 'Siswa 5', 'siswa', ''),
('SISWA6', 'SISWA6', 'Siswa 6', 'siswa', ''),
('SISWA7', 'SISWA7', 'Siswa 7', 'siswa', ''),
('SISWA8', 'SISWA8', 'Siswa 8', 'siswa', ''),
('SISWA9', 'SISWA9', 'Siswa 9', 'siswa', ''),
('SISWA10', 'SISWA10', 'Siswa 10', 'siswa', ''),
('SISWA11', 'SISWA11', 'Siswa 11', 'siswa', ''),
('SISWA12', 'SISWA12', 'Siswa 12', 'siswa', ''),
('SISWA13', 'SISWA13', 'Siswa 13', 'siswa', ''),
('SISWA14', 'SISWA14', 'Siswa 14', 'siswa', ''),
('SISWA15', 'SISWA15', 'Siswa 15', 'siswa', ''),
('SISWA16', 'SISWA16', 'Siswa 16', 'siswa', ''),
('SISWA17', 'SISWA17', 'Siswa 17', 'siswa', ''),
('SISWA18', 'SISWA18', 'Siswa 18', 'siswa', ''),
('SISWA19', 'SISWA19', 'Siswa 19', 'siswa', ''),
('SISWA20', 'SISWA20', 'Siswa 20', 'siswa', ''),
('SISWA21', 'SISWA21', 'Siswa 21', 'siswa', ''),
('SISWA22', 'SISWA22', 'Siswa 22', 'siswa', ''),
('SISWA23', 'SISWA23', 'Siswa 23', 'siswa', ''),
('SISWA24', 'SISWA24', 'Siswa 24', 'siswa', ''),
('SISWA25', 'SISWA25', 'Siswa 25', 'siswa', ''),
('SISWA26', 'SISWA26', 'Siswa 26', 'siswa', ''),
('SISWA27', 'SISWA27', 'Siswa 27', 'siswa', ''),
('SISWA28', 'SISWA28', 'Siswa 28', 'siswa', ''),
('SISWA29', 'SISWA29', 'Siswa 29', 'siswa', ''),
('SISWA30', 'SISWA30', 'Siswa 30', 'siswa', ''),
('SISWA31', 'SISWA31', 'Siswa 31', 'siswa', ''),
('SISWA32', 'SISWA32', 'Siswa 32', 'siswa', ''),
('SISWA33', 'SISWA33', 'Siswa 33', 'siswa', ''),
('SISWA34', 'SISWA34', 'Siswa 34', 'siswa', ''),
('SISWA35', 'SISWA35', 'Siswa 35', 'siswa', '');

-- Admin
INSERT INTO siswa (username, password, nama_siswa, role) VALUES
('admin_kelas', 'admin123', 'Admin Kelas', 'admin');

-- =============================================
-- JADWAL PELAJARAN (SENIN - JUMAT) 
-- Data sesuai input Anda, dengan guru Sejarah Indonesia = Laelatul Mufadilah, S.Pd.
-- =============================================

-- Senin
INSERT INTO jadwal_pelajaran (hari, jam_ke, mulai, selesai, mata_pelajaran, guru, ruang) VALUES
('Senin', 1, '06:30', '07:10', 'Upacara', '-', 'Lapangan'),
('Senin', 2, '07:10', '07:50', 'PAIBP', 'Nurazizah Mauliddiyah', ''),
('Senin', 3, '07:50', '08:30', 'PAIBP', 'Nurazizah Mauliddiyah', ''),
('Senin', 4, '08:30', '09:10', 'PAIBP', 'Nurazizah Mauliddiyah', ''),
('Senin', 5, '09:10', '09:50', 'KJ39', 'Nurul Safaat Aulia', ''),
('Senin', 6, '10:10', '10:50', 'KJ39', 'Nurul Safaat Aulia', ''),
('Senin', 7, '10:50', '11:30', 'KJ39', 'Nurul Safaat Aulia', ''),
('Senin', 8, '12:20', '13:00', 'PPJ35', 'Nuryati Safitri, S.Pd', ''),
('Senin', 9, '13:00', '13:40', 'TJKN21', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah'),
('Senin', 10, '13:40', '14:20', 'TJKN21', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah'),
('Senin', 11, '14:20', '15:00', 'TJKN21', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah');

-- Selasa
INSERT INTO jadwal_pelajaran (hari, jam_ke, mulai, selesai, mata_pelajaran, guru, ruang) VALUES
('Selasa', 1, '06:30', '07:10', 'MTK', 'Nurul Budiyanti, S.Pd', ''),
('Selasa', 2, '07:10', '07:50', 'MTK', 'Nurul Budiyanti, S.Pd', ''),
('Selasa', 3, '07:50', '08:30', 'MTK', 'Nurul Budiyanti, S.Pd', ''),
('Selasa', 4, '08:30', '09:10', 'KIK', 'Nurazizah Mauliddiyah', ''),
('Selasa', 5, '09:10', '09:50', 'KIK', 'Nurazizah Mauliddiyah', ''),
('Selasa', 6, '10:10', '10:50', 'KIK', 'Nurazizah Mauliddiyah', ''),
('Selasa', 7, '10:50', '11:30', 'PPJ35', 'Nuryati Safitri, S.Pd', 'Lab TJKT 1'),
('Selasa', 8, '12:20', '13:00', 'PPJ35', 'Nuryati Safitri, S.Pd', ''),
('Selasa', 9, '13:00', '13:40', 'PPJ35', 'Nuryati Safitri, S.Pd', ''),
('Selasa', 10, '13:40', '14:20', 'BING', 'Elinda Oktaviani, S.Pd', ''),
('Selasa', 11, '14:20', '15:00', 'BING', 'Elinda Oktaviani, S.Pd', '');

-- Rabu
INSERT INTO jadwal_pelajaran (hari, jam_ke, mulai, selesai, mata_pelajaran, guru, ruang) VALUES
('Rabu', 1, '06:30', '07:10', 'BIND', 'Taufiq Hidayat, S.Pd', ''),
('Rabu', 2, '07:10', '07:50', 'BIND', 'Taufiq Hidayat, S.Pd', ''),
('Rabu', 3, '07:50', '08:30', 'BIND', 'Taufiq Hidayat, S.Pd', ''),
('Rabu', 4, '08:30', '09:10', 'PKPJ', 'Ariib Faturohman, S.Pd', 'Lab TJKT 1'),
('Rabu', 5, '09:10', '09:50', 'PKPJ', 'Ariib Faturohman, S.Pd', 'Lab TJKT 1'),
('Rabu', 6, '10:10', '10:50', 'PKPJ', 'Ariib Faturohman, S.Pd', 'Lab TJKT 1'),
('Rabu', 7, '10:50', '11:30', 'ASJ', 'Tarwin, S.Kom', 'Lab TJKT 1'),
('Rabu', 8, '12:20', '13:00', 'ASJ', 'Tarwin, S.Kom', 'Lab TJKT 1'),
('Rabu', 9, '13:00', '13:40', 'ASJ', 'Tarwin, S.Kom', 'Lab TJKT 1'),
('Rabu', 10, '13:40', '14:20', 'ASJ', 'Tarwin, S.Kom', 'Lab TJKT 1'),
('Rabu', 11, '14:20', '15:00', 'BK', 'Mambas Riananda, S.F', '');

-- Kamis
INSERT INTO jadwal_pelajaran (hari, jam_ke, mulai, selesai, mata_pelajaran, guru, ruang) VALUES
('Kamis', 1, '06:30', '07:10', 'SEJARIND', 'Laelatul Mufadilah, S.Pd', ''),
('Kamis', 2, '07:10', '07:50', 'SEJARIND', 'Laelatul Mufadilah, S.Pd', ''),
('Kamis', 3, '07:50', '08:30', 'KJ39', 'Nurul Safaat Aulia', ''),
('Kamis', 4, '08:30', '09:10', 'KIK', 'Nurazizah Mauliddiyah', ''),
('Kamis', 5, '09:10', '09:50', 'KIK', 'Nurazizah Mauliddiyah', ''),
('Kamis', 6, '10:10', '10:50', 'BING', 'Elinda Oktaviani, S.Pd', ''),
('Kamis', 7, '10:50', '11:30', 'BING', 'Elinda Oktaviani, S.Pd', ''),
('Kamis', 8, '12:20', '13:00', 'MP-TKJ', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah'),
('Kamis', 9, '13:00', '13:40', 'MP-TKJ', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah'),
('Kamis', 10, '13:40', '14:20', 'MP-TKJ', 'Darto Idhan Ramadhan', 'Lab TJKT Bawah'),
('Kamis', 11, '14:20', '15:00', 'PPAN', 'Wawan Gunawan, S.A', '');

-- Jumat
INSERT INTO jadwal_pelajaran (hari, jam_ke, mulai, selesai, mata_pelajaran, guru, ruang) VALUES
('Jumat', 1, '06:30', '08:30', 'Shalat Duha/Olahraga/Kebersihan', '-', ''),
('Jumat', 2, '08:30', '08:50', 'Istirahat', '-', ''),
('Jumat', 4, '08:50', '09:30', 'PENJAS', 'Arfian Habibi, S.Pd', ''),
('Jumat', 5, '09:30', '10:10', 'PENJAS', 'Arfian Habibi, S.Pd', ''),
('Jumat', 6, '10:10', '10:50', 'MP-TKJ', 'Darto Idhan Ramadhan', 'Lab TJKT 2'),
('Jumat', 7, '10:50', '11:30', 'MP-TKJ', 'Darto Idhan Ramadhan', 'Lab TJKT 2');

-- =============================================
-- JADWAL PIKET (ACAK SEMENTARA)
-- =============================================
-- Setiap hari diisi 5 siswa (id 1-5 Senin, 6-10 Selasa, 11-15 Rabu, 16-20 Kamis, 21-25 Jumat)
INSERT INTO jadwal_piket (hari, siswa_id) VALUES
('Senin',1),('Senin',2),('Senin',3),('Senin',4),('Senin',5),
('Selasa',6),('Selasa',7),('Selasa',8),('Selasa',9),('Selasa',10),
('Rabu',11),('Rabu',12),('Rabu',13),('Rabu',14),('Rabu',15),
('Kamis',16),('Kamis',17),('Kamis',18),('Kamis',19),('Kamis',20),
('Jumat',21),('Jumat',22),('Jumat',23),('Jumat',24),('Jumat',25);

-- =============================================
-- QUOTE MOTIVASI
-- =============================================
INSERT INTO quote (teks_quote, penulis) VALUES
('Belajarlah seolah engkau akan hidup selamanya.', 'Mahatma Gandhi'),
('Pendidikan adalah senjata paling ampuh untuk mengubah dunia.', 'Nelson Mandela'),
('Jangan pernah menyerah, karena kau tidak tahu seberapa dekat kau dengan tujuan.', ''),
('Masa depan tergantung pada apa yang kita lakukan sekarang.', 'Albert Einstein'),
('Kesuksesan dimulai dari kemauan yang kuat.', 'B.J. Habibie');

-- =============================================
-- PENGUMUMAN AWAL
-- =============================================
INSERT INTO pengumuman (judul, isi) VALUES
('Selamat Datang di Web Kelas!', 'Silakan lengkapi profil kamu dan jangan lupa cek jadwal pelajaran setiap hari.');

-- =============================================
-- LAGU (KOSONG, ADMIN NANTI TAMBAH)
-- =============================================
-- Tabel lagu dibiarkan kosong.

-- SELESAI