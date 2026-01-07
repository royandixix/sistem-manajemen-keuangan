<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../../database/koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("Location: ../../auth/login.php");
    exit;
}

$user_id = (int)$_SESSION['id_user'];

// Pastikan user valid
$result = mysqli_query($conn, "SELECT id_user FROM users WHERE id_user = $user_id");
if (!$result || mysqli_num_rows($result) === 0) {
    die("Error: User tidak valid atau tidak ditemukan di database.");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = (float)$_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    $stmt = $conn->prepare("
        INSERT INTO transaksi (tanggal, jenis, nominal, keterangan, id_user)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssdsi", $tanggal, $jenis, $nominal, $keterangan, $user_id);

    if($stmt->execute()){
        header("Location: index.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Transaksi</h1>

    <form method="POST" class="bg-white p-6 rounded shadow max-w-md space-y-4">
        <input type="date" name="tanggal" required class="w-full p-2 border rounded">
        <select name="jenis" required class="w-full p-2 border rounded">
            <option value="">-- Pilih Jenis --</option>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
        </select>
        <input type="number" step="0.01" name="nominal" placeholder="Nominal" required class="w-full p-2 border rounded">
        <input type="text" name="keterangan" placeholder="Keterangan" class="w-full p-2 border rounded">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="index.php" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</main>
</div>
<?php include '../templates/footer.php'; ?>
