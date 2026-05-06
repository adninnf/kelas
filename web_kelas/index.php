<?php
require_once 'db.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$allowed_pages = [
    'home', 'login', 'logout',
    'dashboard_siswa', 'dashboard_admin',
    'dashboard_siswa_beranda', 'dashboard_siswa_profilku', 'dashboard_siswa_akunku',
    'dashboard_siswa_jadwal', 'dashboard_siswa_tugas', 'dashboard_siswa_teman',
    'dashboard_siswa_galeri', 'dashboard_siswa_pengumuman',
    'admin_profil', 'admin_siswa', 'admin_piket', 'admin_pelajaran',
    'admin_pengumuman', 'admin_galeri', 'admin_quote', 'admin_lagu'
];

if (in_array($page, $allowed_pages)) {
    $file = "pages/{$page}.php";
    if (file_exists($file)) {
        include $file;
    } else {
        include 'pages/home.php';
    }
} else {
    include 'pages/home.php';
}
?>