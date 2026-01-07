<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../database/koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("Location: ../../auth/login.php");
    exit;
}

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

// ambil data
$result = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi=$id");
if(mysqli_num_rows($result) === 0){
    die("Transaksi tidak ditemukan");
}

$data = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $nominal = (float)$_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    $stmt = $conn->prepare("
        UPDATE transaksi SET tanggal=?, jenis=?, nominal=?, keterangan=?
        WHERE id_transaksi=?
    ");
    $stmt->bind_param("ssdsi", $tanggal, $jenis, $nominal, $keterangan, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/sidebar.php'; ?>
<div class="flex-1 flex flex-col">
<?php include '../templates/navbar.php'; ?>

<main class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Transaksi</h1>

    <form method="POST" class="bg-white p-6 rounded shadow max-w-md space-y-4">
        <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>" required class="w-full p-2 border rounded">
        <select name="jenis" required class="w-full p-2 border rounded">
            <option value="pemasukan" <?= $data['jenis']=='pemasukan'?'selected':'' ?>>Pemasukan</option>
            <option value="pengeluaran" <?= $data['jenis']=='pengeluaran'?'selected':'' ?>>Pengeluaran</option>
        </select>
        <input type="number" step="0.01" name="nominal" value="<?= $data['nominal'] ?>" required class="w-full p-2 border rounded">
        <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>" class="w-full p-2 border rounded">
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        <a href="index.php" class="bg-gray-300 px-4 py-2 rounded ml-2">Batal</a>
    </form>
</main>
</div>
<?php include '../templates/footer.php'; ?>
