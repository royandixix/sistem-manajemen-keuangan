<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../database/koneksi.php';

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM laporan WHERE id_laporan=$id");

header("Location: index.php");
exit;
