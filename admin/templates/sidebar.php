<!-- Sidebar -->
<aside id="sidebar"
    class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white
           transform -translate-x-full lg:translate-x-0
           transition-transform duration-300 ease-in-out shadow-lg">

    <!-- Logo / Header -->
    <div class="p-6 flex items-center justify-center border-b border-gray-700">
        <h2 class="text-2xl font-bold">Admin Panel</h2>
    </div>

    <!-- Navigation -->
    <nav class="mt-6">
        <ul class="space-y-2 px-3">

            <!-- Dashboard -->
            <li>
                <a href="/sistem_manajemen_keuagan/admin/dashboard.php"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- User -->
            <li>
                <a href="/sistem_manajemen_keuagan/admin/user/index.php"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M12 7a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <span>User</span>
                </a>
            </li>

            <!-- Kategori -->
            <li>
                <a href="/sistem_manajemen_keuagan/admin/kategori/index.php"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span>Kategori</span>
                </a>
            </li>

            <!-- Transaksi -->
            <li>
                <a href="/sistem_manajemen_keuagan/admin/transaksi/index.php"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10h18M3 6h18M3 14h18M3 18h18" />
                    </svg>
                    <span>Transaksi</span>
                </a>
            </li>

            <!-- Laporan -->
            <li>
                <a href="/sistem_manajemen_keuagan/admin/laporan/index.php"
                   class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 17v-6h13M5 12h4v6H5z" />
                    </svg>
                    <span>Laporan</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>

<!-- Overlay mobile -->
<div id="sidebarOverlay"
     class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
