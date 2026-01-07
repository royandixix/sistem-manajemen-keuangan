<?php
require_once '../templates/header.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

require_once '../../database/koneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = $id");
    header("Location: index.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM kategori ORDER BY created_at DESC");
?>

<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Kategori</h1>
        <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah</a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Nama</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th class="w-32">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($k = mysqli_fetch_assoc($data)) : ?>
            <tr class="border-t">
                <td class="p-2"><?= htmlspecialchars($k['nama_kategori']) ?></td>
                <td><?= ucfirst($k['jenis']) ?></td>
                <td><?= htmlspecialchars($k['deskripsi']) ?></td>
                <td class="text-center">
                    <a href="edit.php?id=<?= $k['id_kategori'] ?>" class="text-blue-600">Edit</a> |
                    <a href="?hapus=<?= $k['id_kategori'] ?>"
                       onclick="return confirm('Hapus data?')"
                       class="text-red-600">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
</div>

<?php include '../templates/footer.php'; ?>
