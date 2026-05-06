<?php
checkLogin('siswa');
$user = $conn->query("SELECT * FROM siswa WHERE id = {$_SESSION['user_id']}")->fetch_assoc();
?>
<?php include 'includes/header.php'; ?>
<div class="card" style="text-align: center;">
    <h1>👋 Halo, <?= htmlspecialchars($user['nama_siswa'] ?: $user['username']) ?></h1>
    <p><strong>Username:</strong> <?= $user['username'] ?></p>
    <p><strong>Cita-cita:</strong> <?= htmlspecialchars($user['cita_cita'] ?? '-') ?></p>
    <p><strong>Motto:</strong> <?= htmlspecialchars($user['motto'] ?? '-') ?></p>
</div>
<div class="card">
    <h2>✏️ Edit Profil</h2>
    <form method="POST" action="?page=update_profil">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_siswa" value="<?= htmlspecialchars($user['nama_siswa']) ?>">
        <label>Cita-cita</label>
        <input type="text" name="cita_cita" value="<?= htmlspecialchars($user['cita_cita']) ?>">
        <label>Motto</label>
        <textarea name="motto"><?= htmlspecialchars($user['motto'] ?? '') ?></textarea>
        <label>Warna Tema (hex)</label>
        <input type="color" name="warna_tema" value="<?= $user['warna_tema'] ?? '#000000' ?>">
        <button type="submit" class="btn-primary">Simpan</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>