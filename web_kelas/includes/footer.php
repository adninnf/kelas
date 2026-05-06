    </main>

    <!-- Floating Music Button Neo -->
    <button id="musicToggle" class="fixed bottom-6 right-6 z-50 btn-neo w-14 h-14 rounded-full flex items-center justify-center text-xl">
        <i class="fas fa-music"></i>
    </button>
    <audio id="bgMusic" loop style="display: none;"></audio>

    <footer class="bg-black text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm">© 2026 - Kelas XI TJKT 2 SMKN 1 Kandanghaur</p>
            <div class="flex space-x-6">
                <a href="https://instagram.com/tejekate2_nesaka" target="_blank" class="hover:text-yellow"><i class="fab fa-instagram text-xl"></i></a>
                <a href="https://tiktok.com/@11tjkt2nesaka" target="_blank" class="hover:text-yellow"><i class="fab fa-tiktok text-xl"></i></a>
            </div>
        </div>
        <div class="text-center text-xs mt-4 text-gray-400">border: 3px solid #000; box-shadow: 5px 5px 0 0 #000;</div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (menuBtn) {
            menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        }
        // Music player sederhana (sama seperti sebelumnya)
        let musicPlaying = false;
        const audio = document.getElementById('bgMusic');
        const toggleBtn = document.getElementById('musicToggle');
        fetch('api/get_active_song.php')
            .then(res => res.json())
            .then(data => { if(data.url) { audio.src = data.url; audio.load(); } });
        if(toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if(musicPlaying) { audio.pause(); toggleBtn.innerHTML = '<i class="fas fa-music"></i>'; }
                else { audio.play(); toggleBtn.innerHTML = '<i class="fas fa-pause"></i>'; }
                musicPlaying = !musicPlaying;
            });
        }
    </script>
</body>
</html>