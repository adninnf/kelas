<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>XI TJKT 2 - Web Kelas Neubrutalism</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Neubrutalism CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FFF9E6',
                        yellow: '#FFE66D',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream font-['Space_Grotesk']">

    <!-- Navbar Sticky Neubrutalism -->
    <nav class="bg-cream border-b-3 border-black sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-yellow border-2 border-black rounded-full flex items-center justify-center">
                            <i class="fas fa-school text-black text-sm"></i>
                        </div>
                        <span class="text-xl font-bold">XI TJKT 2</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php?page=home" class="text-black font-medium hover:text-gray-700">Home</a>
                    <a href="index.php?page=struktur" class="text-black font-medium hover:text-gray-700">Struktur</a>
                    <a href="index.php?page=jadwal" class="text-black font-medium hover:text-gray-700">Jadwal</a>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="index.php?page=dashboard_siswa" class="text-black font-medium hover:text-gray-700">Dashboard</a>
                        <a href="index.php?page=logout" class="text-black font-medium hover:text-gray-700">Logout</a>
                    <?php else: ?>
                        <a href="index.php?page=login" class="btn-neo px-5 py-2 rounded-lg">Login</a>
                    <?php endif; ?>
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-black">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t-2 border-black bg-cream">
            <div class="px-4 py-4 space-y-3">
                <a href="index.php?page=home" class="block text-black font-medium">Home</a>
                <a href="index.php?page=struktur" class="block text-black font-medium">Struktur</a>
                <a href="index.php?page=jadwal" class="block text-black font-medium">Jadwal</a>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="index.php?page=dashboard_siswa" class="block text-black font-medium">Dashboard</a>
                    <a href="index.php?page=logout" class="block text-black font-medium">Logout</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="block text-black font-medium">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if($toast = getToast()): ?>
            <div class="bg-yellow border-3 border-black p-4 mb-6 neo-shadow-sm text-center font-bold">
                <?= htmlspecialchars($toast['message']) ?>
            </div>
        <?php endif; ?>