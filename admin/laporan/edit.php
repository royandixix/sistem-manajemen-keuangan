<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../templates/header.php';
require_once '../../database/koneksi.php';

$id = (int)$_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM laporan WHERE id_laporan=$id")
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $pemasukan = $_POST['total_pemasukan'];
    $pengeluaran = $_POST['total_pengeluaran'];

    $stmt = $conn->prepare("
        UPDATE laporan SET bulan=?, tahun=?, total_pemasukan=?, total_pengeluaran=?
        WHERE id_laporan=?
    ");
    $stmt->bind_param("iiddi", $bulan, $tahun, $pemasukan, $pengeluaran, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
