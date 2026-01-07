<?php
require_once '../templates/header.php';
require_once '../../database/koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_kategori'];
    $jenis = $_POST['jenis'];
    $desk = $_POST['deskripsi'];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO kategori (nama_kategori, jenis, deskripsi) VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, "sss", $nama, $jenis, $desk);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>

<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Tambah Kategori</h1>

    <form method="post" class="space-y-4">
        <input type="text" name="nama_kategori" required
               placeholder="Nama Kategori"
               class="w-full border p-2 rounded">

        <select name="jenis" required class="w-full border p-2 rounded">
            <option value="">-- Pilih Jenis --</option>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
        </select>

        <textarea name="deskripsi"
                  placeholder="Deskripsi"
                  class="w-full border p-2 rounded"></textarea>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</main>
</div>

<?php include '../templates/footer.php'; ?>
