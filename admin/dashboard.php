<?php
session_start();

/* Proteksi Admin */
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

/* Koneksi DB */
require_once __DIR__ . '/../database/koneksi.php';
if (!$conn) {
    die("Koneksi database gagal");
}

/* Helper function */
function getCount($conn, $table) {
    $res = mysqli_query($conn, "SELECT COUNT(*) AS total FROM $table");
    if (!$res) return 0;
    $data = mysqli_fetch_assoc($res);
    return $data['total'];
}

$jumlahUser      = getCount($conn, 'users');
$jumlahTransaksi = getCount($conn, 'transaksi');
$jumlahKategori  = getCount($conn, 'kategori');
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/sidebar.php'; ?>

<div class="flex-1 flex flex-col">
    <?php include 'templates/navbar.php'; ?>

    <main class="flex-1 p-6 bg-gray-50">
        <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
        <p>
            Selamat datang,
            <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Admin') ?></strong>!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold text-gray-700">Jumlah User</h2>
                <p class="text-xl"><?= $jumlahUser ?></p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold text-gray-700">Jumlah Transaksi</h2>
                <p class="text-xl"><?= $jumlahTransaksi ?></p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-bold text-gray-700">Jumlah Kategori</h2>
                <p class="text-xl"><?= $jumlahKategori ?></p>
            </div>
        </div>
    </main>
</div>

<?php include 'templates/footer.php'; ?>

