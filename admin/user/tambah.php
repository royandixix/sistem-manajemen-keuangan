<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ===============================
   SESSION
================================ */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===============================
   CEK LOGIN ADMIN
================================ */
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

/* ===============================
   KONEKSI DATABASE
================================ */
require_once(__DIR__ . '/../../database/koneksi.php');

/* ===============================
   SIMPAN DATA
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $role     = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "
        INSERT INTO users (username, password, nama, email, role)
        VALUES ('$username', '$password', '$nama', '$email', '$role')
    ");

    header("Location: index.php");
    exit;
}
?>

<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-1 flex flex-col">
<?php include __DIR__ . '/../templates/navbar.php'; ?>

<main class="p-6 w-full">
    <h1 class="text-2xl font-bold mb-6">Tambah User</h1>

    <div class="bg-white p-6 rounded shadow max-w-4xl mx-auto">
        <form method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block mb-1 font-medium">Username</label>
                <input type="text" name="username" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="nama" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email"
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Role</label>
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>

            <div class="md:col-span-2 flex gap-3 mt-4">
                <button class="bg-blue-600 text-white px-6 py-2 rounded">
                    Simpan
                </button>
                <a href="index.php"
                   class="px-6 py-2 border rounded hover:bg-gray-100">
                    Batal
                </a>
            </div>

        </form>
    </div>
</main>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
