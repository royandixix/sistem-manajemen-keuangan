<?php
require_once '../templates/header.php';
require_once '../../database/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

$id = (int)$_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori=$id");
$k = mysqli_fetch_assoc($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_kategori'];
    $jenis = $_POST['jenis'];
    $desk = $_POST['deskripsi'];

    $stmt = mysqli_prepare(
        $conn,
        "UPDATE kategori SET nama_kategori=?, jenis=?, deskripsi=? WHERE id_kategori=?"
    );
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $jenis, $desk, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>

<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    <form method="post" class="space-y-4">
        <input type="text" name="nama_kategori" required
               value="<?= $k['nama_kategori'] ?>"
               class="w-full border p-2 rounded">

        <select name="jenis" class="w-full border p-2 rounded">
            <option value="pemasukan" <?= $k['jenis']=='pemasukan'?'selected':'' ?>>Pemasukan</option>
            <option value="pengeluaran" <?= $k['jenis']=='pengeluaran'?'selected':'' ?>>Pengeluaran</option>
        </select>

        <textarea name="deskripsi"
                  class="w-full border p-2 rounded"><?= $k['deskripsi'] ?></textarea>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</main>
</div>

<?php include '../templates/footer.php'; ?>
