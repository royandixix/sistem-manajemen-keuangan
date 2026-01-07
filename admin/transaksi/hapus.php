<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../database/koneksi.php';

if(!isset($_SESSION['id_user'])){
    header("Location: ../../auth/login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi=$id");
}

header("Location: index.php");
exit;
?>
