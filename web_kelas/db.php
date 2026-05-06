<?php
// ========== KONFIGURASI DATABASE ==========
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_kelas_db';

// Koneksi
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ========== FUNGSI HELPER ==========

function getInitials($nama) {
    if (empty($nama)) return '?';
    $words = explode(' ', trim($nama));
    if (count($words) == 1) return strtoupper(substr($words[0], 0, 1));
    return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
}

function getColorFromUsername($username) {
    $hash = 0;
    for ($i = 0; $i < strlen($username); $i++) {
        $hash = ord($username[$i]) + (($hash << 5) - $hash);
    }
    $hue = abs($hash % 360);
    return "hsl($hue, 70%, 55%)";
}

function setToast($message, $type = 'success') {
    $_SESSION['toast'] = ['message' => $message, 'type' => $type];
}

function getToast() {
    if (isset($_SESSION['toast'])) {
        $toast = $_SESSION['toast'];
        unset($_SESSION['toast']);
        return $toast;
    }
    return null;
}

function checkLogin($role = null) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login');
        exit();
    }
    if ($role && $_SESSION['user_role'] !== $role) {
        header('Location: index.php?page=home');
        exit();
    }
}

function getActiveSong() {
    global $conn;
    $result = $conn->query("SELECT file_url FROM lagu WHERE is_active = 1 ORDER BY created_at DESC LIMIT 1");
    if ($result && $row = $result->fetch_assoc()) {
        return $row['file_url'];
    }
    return null;
}
?>