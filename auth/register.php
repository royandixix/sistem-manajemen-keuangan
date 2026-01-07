<?php
session_start();
include '../database/koneksi.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // Cek username/email sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Username atau email sudah terdaftar!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (username, password, nama, email, role) 
                                       VALUES ('$username', '$password', '$nama', '$email', '$role')");
        if ($insert) {
            $message = "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
        } else {
            $message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

    <?php if($message != ""): ?>
        <div class="mb-4 text-red-600"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded">
        <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full p-2 border rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full p-2 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded">
        <select name="role" required class="w-full p-2 border rounded">
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Register
        </button>
    </form>

    <p class="mt-4 text-center">Sudah punya akun? <a href="login.php" class="text-blue-600">Login</a></p>
</div>
</body>
</html>
