<?php
$profil = $conn->query("SELECT * FROM profil_kelas LIMIT 1")->fetch_assoc();
$siswa = $conn->query("SELECT id, username, nama_siswa, foto_profil, jabatan FROM siswa WHERE role = 'siswa' ORDER BY nama_siswa");
$allSiswa = [];
while($row = $siswa->fetch_assoc()) {
    if(empty($row['jabatan'])) {
        $jabatanDefault = ['Keamanan', 'Pendidikan', 'Kebersihan', 'Olahraga'];
        $row['jabatan'] = $jabatanDefault[array_rand($jabatanDefault)];
    }
    $allSiswa[] = $row;
}
// Jadwal pelajaran
$jadwal = $conn->query("SELECT * FROM jadwal_pelajaran ORDER BY FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat'), jam_ke");
$jadwalByJam = [];
while($row = $jadwal->fetch_assoc()) {
    $jadwalByJam[$row['jam_ke']][$row['hari']] = $row;
}
$maxJam = !empty($jadwalByJam) ? max(array_keys($jadwalByJam)) : 1;
$hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
// Jadwal piket
$hariIndo = ['Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat'];
$hariIni = $hariIndo[date('l')] ?? 'Senin';
$piketHariIni = $conn->query("SELECT s.nama_siswa FROM jadwal_piket jp JOIN siswa s ON jp.siswa_id = s.id WHERE jp.hari = '$hariIni'");
$piketToday = [];
while($row = $piketHariIni->fetch_assoc()) $piketToday[] = $row['nama_siswa'];
$piketAll = $conn->query("SELECT jp.hari, s.nama_siswa FROM jadwal_piket jp JOIN siswa s ON jp.siswa_id = s.id ORDER BY FIELD(jp.hari, 'Senin','Selasa','Rabu','Kamis','Jumat')");
$piketByHari = [];
while($row = $piketAll->fetch_assoc()) $piketByHari[$row['hari']][] = $row['nama_siswa'];
// Quote
$quote = $conn->query("SELECT * FROM quote ORDER BY RAND() LIMIT 1")->fetch_assoc();
?>
<?php include 'includes/header.php'; ?>

<!-- Hero section seperti contoh portfolio -->
<section class="py-8 lg:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-2xl font-medium mb-2">📢 Selamat Datang di</p>
            <h1 class="text-5xl lg:text-7xl font-bold mb-2">
                <?= htmlspecialchars($profil['nama_kelas'] ?? 'XI TJKT 2') ?>
            </h1>
            <div class="flex items-center mb-6">
                <div class="h-0.5 w-24 bg-black mr-4"></div>
                <p class="text-lg font-medium">Wali Kelas: <?= htmlspecialchars($profil['wali_kelas'] ?? 'Ariib Faturohman, S.Pd.') ?></p>
            </div>
            <p class="text-gray-700 leading-relaxed mb-6"><?= nl2br(htmlspecialchars($profil['deskripsi'] ?? 'Kelas Teknik Komputer dan Jaringan yang kreatif, inovatif, dan berprestasi.')) ?></p>
            <div class="flex flex-wrap gap-4">
                <a href="index.php?page=login" class="btn-neo px-6 py-3 rounded-lg inline-flex items-center">Login Siswa <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
        </div>
        <div class="flex justify-center lg:justify-end">
            <div class="relative">
                <div class="w-80 h-80 rounded-full neo-border bg-white overflow-hidden">
                    <img src="https://placehold.co/400x400/FFE66D/000?text=XI+TJKT+2" alt="Kelas" class="w-full h-full object-cover">
                </div>
                <div class="absolute -top-4 -right-4 w-16 h-16 bg-yellow rounded-full border-2 border-black flex items-center justify-center">
                    <i class="fas fa-star text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quote -->
<div class="bg-yellow border-3 border-black p-6 text-center mb-12 neo-shadow-sm">
    <i class="fas fa-quote-right text-3xl mb-2 block"></i>
    <p class="text-xl font-bold">"<?= htmlspecialchars($quote['teks_quote'] ?? 'Belajarlah dengan giat!') ?>"</p>
    <?php if(!empty($quote['penulis'])) echo "<p class='mt-2 font-medium'>- {$quote['penulis']} -</p>"; ?>
</div>

<!-- Struktur Organisasi Kelas -->
<section class="mb-16">
    <h2 class="text-4xl lg:text-5xl font-bold text-center mb-4 underline-yellow">Struktur Organisasi</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-12">
        <?php foreach($allSiswa as $s): 
            $inisial = getInitials($s['nama_siswa'] ?: $s['username']);
        ?>
        <div class="card-neo rounded-lg p-6 text-center bg-white">
            <div class="w-24 h-24 mx-auto rounded-full bg-yellow border-2 border-black flex items-center justify-center text-3xl font-bold mb-4">
                <?php if(!empty($s['foto_profil'])): ?>
                    <img src="<?= htmlspecialchars($s['foto_profil']) ?>" class="w-full h-full rounded-full object-cover">
                <?php else: echo $inisial; endif; ?>
            </div>
            <h3 class="text-xl font-bold"><?= htmlspecialchars($s['nama_siswa'] ?: $s['username']) ?></h3>
            <div class="inline-block bg-yellow border-2 border-black px-3 py-1 text-sm font-bold mt-2"><?= htmlspecialchars($s['jabatan']) ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Jadwal Pelajaran -->
<section class="mb-16">
    <h2 class="text-4xl lg:text-5xl font-bold text-center mb-4 underline-yellow">Jadwal Pelajaran</h2>
    <div class="overflow-x-auto mt-8">
        <table class="table-neo w-full border-collapse">
            <thead>
                <tr><th class="p-3">Jam</th><th class="p-3">Senin</th><th class="p-3">Selasa</th><th class="p-3">Rabu</th><th class="p-3">Kamis</th><th class="p-3">Jumat</th></tr>
            </thead>
            <tbody>
                <?php for($jam=1; $jam<=$maxJam; $jam++): ?>
                <tr class="border-b border-black">
                    <td class="p-3 font-bold"><?= $jam ?></td>
                    <?php foreach($hariList as $hari): $mapel = $jadwalByJam[$jam][$hari] ?? null; ?>
                    <td class="p-3"><?= $mapel ? "<span class='font-bold'>{$mapel['mata_pelajaran']}</span><br><span class='text-sm'>{$mapel['guru']}</span><br><span class='text-xs'>{$mapel['ruang']}</span>" : '-' ?></td>
                    <?php endforeach; ?>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Jadwal Piket -->
<section class="mb-16">
    <h2 class="text-4xl lg:text-5xl font-bold text-center mb-4 underline-yellow">Jadwal Piket</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <div class="card-neo p-6 bg-white rounded-lg">
            <h3 class="text-2xl font-bold mb-4">Hari Ini (<?= $hariIni ?>)</h3>
            <div class="flex flex-wrap gap-2">
                <?php foreach($piketToday as $nama): ?>
                    <span class="badge-neo bg-yellow px-4 py-2 rounded-full font-bold"><?= htmlspecialchars($nama) ?></span>
                <?php endforeach; ?>
                <?php if(empty($piketToday)) echo '<p>Tidak ada jadwal piket hari ini.</p>'; ?>
            </div>
        </div>
        <div class="card-neo p-6 bg-white rounded-lg">
            <h3 class="text-2xl font-bold mb-4">Mingguan</h3>
            <div class="space-y-2">
                <?php foreach($hariList as $hari): ?>
                    <div><span class="font-bold"><?= $hari ?>:</span> <?= implode(', ', array_map('htmlspecialchars', $piketByHari[$hari] ?? ['-'])) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>