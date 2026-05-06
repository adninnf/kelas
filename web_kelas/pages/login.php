<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT id, username, password, role FROM siswa WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if ($password === $row['password']) { // plain text sesuai default
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = $row['role'];
            setToast("Login berhasil! Selamat datang, $username.");
            if ($row['role'] === 'admin') header('Location: index.php?page=dashboard_admin');
            else header('Location: index.php?page=dashboard_siswa');
            exit();
        }
    }
    setToast("Username atau password salah.", "error");
}
?>
<?php include 'includes/header.php'; ?>
<div class="card" style="max-width: 400px; margin: 40px auto;">
    <h2 style="text-align: center;">🔐 Login</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required placeholder="SISWA1 / admin_kelas">
        <label>Password</label>
        <input type="password" name="password" required placeholder="*****">
        <button type="submit" style="width:100%;">Login</button>
    </form>
    <p style="margin-top: 16px; text-align: center;">Siswa: SISWA1..SISWA35 (pw=username)<br>Admin: admin_kelas / admin123</p>
</div>
<?php include 'includes/footer.php'; ?>