<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: ../../auth/login.php");
    exit;
}

require_once '../../database/koneksi.php';

// Hitung total pemasukan dan pengeluaran
$total_pemasukan = 0;
$total_pengeluaran = 0;
$result = mysqli_query($conn, "SELECT l.*, u.username FROM laporan l JOIN users u ON l.dibuat_oleh = u.id_user");
while ($lap = mysqli_fetch_assoc($result)) {
    $total_pemasukan += $lap['total_pemasukan'];
    $total_pengeluaran += $lap['total_pengeluaran'];
    $laporan[] = $lap;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bulanan</title>
    <style>
        /* Reset & Font */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; color: #333; }

        /* Header */
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { font-size: 28px; color: #2c3e50; }
        .header p { font-size: 14px; color: #7f8c8d; }

        /* Table */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #bdc3c7; padding: 10px; text-align: center; }
        th { background-color: #3498db; color: white; font-weight: bold; }
        tr:nth-child(even) { background-color: #ecf0f1; }

        /* Footer / Total */
        .totals { margin-top: 20px; width: 50%; float: right; }
        .totals table { border: none; }
        .totals td { border: none; padding: 5px 10px; text-align: right; }

        /* Print */
        @media print {
            body { padding: 0; }
            .totals { float: none; width: 100%; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Keuangan Bulanan</h1>
        <p>Dicetak pada: <?= date('d-m-Y H:i') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Total Pemasukan (Rp)</th>
                <th>Total Pengeluaran (Rp)</th>
                <th>Dibuat Oleh</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $lap) : ?>
            <tr>
                <td><?= htmlspecialchars($lap['bulan']) ?></td>
                <td><?= htmlspecialchars($lap['tahun']) ?></td>
                <td><?= number_format($lap['total_pemasukan'], 0, ',', '.') ?></td>
                <td><?= number_format($lap['total_pengeluaran'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($lap['username']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="totals">
        <table>
            <tr>
                <td><strong>Total Pemasukan:</strong></td>
                <td>Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><strong>Total Pengeluaran:</strong></td>
                <td>Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td><strong>Saldo Bersih:</strong></td>
                <td>Rp <?= number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>

    <script>
        window.print(); // otomatis membuka dialog print
    </script>
</body>
</html>
