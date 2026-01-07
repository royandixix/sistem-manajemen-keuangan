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
   CEK LOGIN & ROLE (ADMIN)
================================ */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

/* ===============================
   KONEKSI DATABASE
================================ */
require_once(__DIR__ . '/../../database/koneksi.php');

/* ===============================
   HAPUS USER
================================ */
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    // Cegah admin menghapus dirinya sendiri
    if (isset($_SESSION['id_user']) && $id !== $_SESSION['id_user']) {
        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id_user = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    header("Location: index.php");
    exit;
}

/* ===============================
   AMBIL DATA USER
================================ */
$users = mysqli_query(
    $conn,
    "SELECT id_user, username, nama, email, role FROM users"
);
?>

<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-1 flex flex-col">
    <?php include __DIR__ . '/../templates/navbar.php'; ?>

    <main class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Manajemen User</h1>
            <a href="tambah.php"
               class="bg-blue-500 text-white px-4 py-2 rounded">
                + Tambah User
            </a>
        </div>

        <table class="w-full bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($u = mysqli_fetch_assoc($users)) : ?>
                <tr class="border-t">
                    <td class="p-2"><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['nama']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['role']) ?></td>
                    <td class="text-center">
                        <a href="edit.php?id=<?= $u['id_user'] ?>"
                           class="text-blue-600">Edit</a>
                        |
                        <a href="?hapus=<?= $u['id_user'] ?>"
                           onclick="return confirm('Hapus user ini?')"
                           class="text-red-600">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
