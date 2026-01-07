<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

require_once '../../database/koneksi.php';
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>

<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Laporan</h1>

    <!-- Tombol Tambah -->
    <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        + Tambah Laporan
    </a>
    <a href="cetak.php" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
    🖨️ Cetak Laporan
</a>

    <!-- Tabel laporan -->
    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total Pemasukan</th>
                <th>Total Pengeluaran</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = mysqli_query($conn, "SELECT l.*, u.username FROM laporan l JOIN users u ON l.dibuat_oleh = u.id_user");
        while ($lap = mysqli_fetch_assoc($result)) :
        ?>
            <tr class="border-t">
                <td><?= $lap['bulan'] ?></td>
                <td><?= $lap['tahun'] ?></td>
                <td><?= $lap['total_pemasukan'] ?></td>
                <td><?= $lap['total_pengeluaran'] ?></td>
                <td><?= htmlspecialchars($lap['username']) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
</div>

<?php include '../templates/footer.php'; ?>
