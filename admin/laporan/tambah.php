<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: ../../auth/login.php");
    exit;
}

require_once '../../database/koneksi.php';

// Ambil id_user dari session
$user = (int) $_SESSION['id_user'];

// Pastikan user valid di database
$result = mysqli_query($conn, "SELECT * FROM users WHERE id_user=$user");
if(!$result || mysqli_num_rows($result) === 0){
    die("Error: User tidak valid atau tidak ditemukan di database.");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $bulan = (int) $_POST['bulan'];
    $tahun = (int) $_POST['tahun'];
    $pemasukan = (float) $_POST['total_pemasukan'];
    $pengeluaran = (float) $_POST['total_pengeluaran'];

    $stmt = $conn->prepare("
        INSERT INTO laporan (bulan, tahun, total_pemasukan, total_pengeluaran, dibuat_oleh)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("iiddi", $bulan, $tahun, $pemasukan, $pengeluaran, $user);
    if($stmt->execute()){
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan laporan: " . $stmt->error;
    }
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Laporan</h1>

    <form method="POST" class="bg-white p-6 rounded shadow max-w-md">
        <input type="number" name="bulan" placeholder="Bulan" required class="input mb-2">
        <input type="number" name="tahun" placeholder="Tahun" required class="input mb-2">
        <input type="number" step="0.01" name="total_pemasukan" placeholder="Total Pemasukan" class="input mb-2">
        <input type="number" step="0.01" name="total_pengeluaran" placeholder="Total Pengeluaran" class="input mb-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Simpan</button>
        <a href="index.php" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</main>
</div>

<?php include '../templates/footer.php'; ?>
