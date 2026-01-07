<?php
session_start();
include '../database/koneksi.php';

// Redirect jika sudah login
if(isset($_SESSION['id_user'])){
    if($_SESSION['role'] === 'admin'){
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../index.php");
    }
    exit;
}

$message = "";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if(mysqli_num_rows($query) === 1){
        $user = mysqli_fetch_assoc($query);
        if(password_verify($password, $user['password'])){
            // Login sukses
            $_SESSION['id_user']  = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            // Redirect sesuai role
            if($user['role'] === 'admin'){
                header("Location: ../admin/dashboard.php");
            } else {
                header("Location: ../index.php");
            }
            exit;
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
<div class="bg-white p-8 rounded shadow w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

    <?php if($message != ""): ?>
        <div class="mb-4 text-red-600"><?= $message ?></div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="text" name="username" placeholder="Username" required class="w-full p-2 border rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 border rounded">
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Login
        </button>
    </form>

    <p class="mt-4 text-center">Belum punya akun? <a href="register.php" class="text-blue-600">Register</a></p>
</div>
</body>
</html>
