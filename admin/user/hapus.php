<?php
session_start();
if ($_SESSION['role'] !== 'admin') exit;

require_once '../../../database/koneksi.php';

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id_user=$id");

header("Location: index.php");
exit;
