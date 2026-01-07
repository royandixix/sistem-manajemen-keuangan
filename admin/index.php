<?php
session_start();

// =======================
// Proteksi Halaman Admin
// =======================
if (!isset($_SESSION['id_user'])) {
    // Belum login → arahkan ke login
    header("Location: ../auth/login.php");
    exit;
}

// Cek role
if ($_SESSION['role'] !== 'admin') {
    // Jika bukan admin → arahkan ke dashboard staff/user
    header("Location: ../index.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <?php include 'templates/sidebar.php'; ?>

    <!-- Konten utama -->
    <div class="flex-1 flex flex-col min-h-screen">

        <!-- Navbar -->
        <?php include 'templates/navbar.php'; ?>

        <!-- Main content -->
        <main class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-4">Selamat Datang, <?= $username ?>!</h1>
            <p>Ini adalah panel admin. Gunakan menu sidebar untuk mengelola sistem keuangan.</p>

            <!-- Contoh tombol logout -->
            <a href="../auth/logout.php"
               class="mt-4 inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Logout
            </a>
        </main>

        <!-- Footer -->
        <?php include 'templates/footer.php'; ?>

    </div>

</body>
</html>
