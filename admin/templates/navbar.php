<?php
// Mulai session kalau belum
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Base URL proyek (sesuaikan dengan nama folder proyek di localhost)
$base_url = "/sistem_manajemen_keuagan";

// Ambil username dari session, kalau tidak ada pakai default "Admin"
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Admin";
?>
<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-30">
    <div class="px-4 lg:px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <!-- Hamburger Button (Mobile) -->
            <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <span class="text-lg font-bold text-gray-800">Sistem Keuangan</span>
        </div>

        <div class="flex items-center space-x-4">
            <span class="hidden sm:inline text-gray-700">
                Halo, <strong><?php echo $username; ?></strong>
            </span>
            <a href="<?php echo $base_url; ?>/auth/logout.php"
               class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="hidden sm:inline">Logout</span>
            </a>
        </div>
    </div>
</nav>
