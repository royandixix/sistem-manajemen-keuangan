<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    // Jika belum login, arahkan ke login
    header("Location: auth/login.php");
    exit;
}

// Bisa juga cek role untuk pastikan hanya staff/user bisa akses
if ($_SESSION['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Halo, <?= $username ?></h1>
        <p>Ini adalah dashboard staff/user biasa.</p>

        <a href="auth/logout.php" class="bg-red-500 text-white px-4 py-2 rounded mt-4 inline-block">
            Logout
        </a>
    </div>
</body>
</html>
