</div> <!-- Penutup dari navbar wrapper -->
    
    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <p>&copy; <?= date("Y") ?> Sistem Informasi Keuangan</p>
    </footer>

    <!-- JavaScript untuk Toggle Sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarClose = document.getElementById('sidebarClose');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            console.log('Sidebar:', sidebar);
            console.log('Toggle Button:', sidebarToggle);
            console.log('Overlay:', sidebarOverlay);

            // Fungsi toggle sidebar
            function toggleSidebar() {
                console.log('Toggle clicked!');
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('hidden');
                
                // Prevent body scroll when sidebar is open
                if (!sidebar.classList.contains('-translate-x-full')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }

            // Fungsi close sidebar
            function closeSidebar() {
                console.log('Close clicked!');
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('active');
                sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Event listener untuk toggle button
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            // Event listener untuk close button
            if (sidebarClose) {
                sidebarClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeSidebar();
                });
            }

            // Event listener untuk overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }

            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    closeSidebar();
                }
            });

            // Close sidebar when clicking on menu links (mobile only)
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>
</html>