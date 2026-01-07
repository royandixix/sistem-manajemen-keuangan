<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../database/koneksi.php';

// cek login
if(!isset($_SESSION['id_user'])){
    header("Location: ../../auth/login.php");
    exit;
}

// ambil semua transaksi
$transaksi = mysqli_query($conn, "
    SELECT t.*, u.username 
    FROM transaksi t
    LEFT JOIN users u ON t.id_user = u.id_user
    ORDER BY t.tanggal DESC
");
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Transaksi</h1>

    <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        + Tambah Transaksi
    </a>

    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Tanggal</th>
                <th>Jenis</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($transaksi)): ?>
            <tr class="border-t">
                <td class="p-2"><?= htmlspecialchars($row['tanggal']) ?></td>
                <td><?= htmlspecialchars($row['jenis']) ?></td>
                <td><?= number_format($row['nominal'], 2) ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_transaksi'] ?>" class="text-blue-600">Edit</a> |
                    <a href="hapus.php?id=<?= $row['id_transaksi'] ?>" 
                       onclick="return confirm('Hapus transaksi ini?')" 
                       class="text-red-600">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
</div>
<?php include '../templates/footer.php'; ?>
