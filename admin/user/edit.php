<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ===============================
   SESSION
================================ */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ===============================
   CEK LOGIN ADMIN
================================ */
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}

/* ===============================
   KONEKSI DATABASE
================================ */
require_once(__DIR__ . '/../../database/koneksi.php');

/* ===============================
   VALIDASI ID
================================ */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

/* ===============================
   AMBIL DATA USER
================================ */
$stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    header("Location: index.php");
    exit;
}

/* ===============================
   PROSES UPDATE
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $role  = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare(
            "UPDATE users SET nama=?, email=?, role=?, password=? WHERE id_user=?"
        );
        $stmt->bind_param("ssssi", $nama, $email, $role, $password, $id);
    } else {
        $stmt = $conn->prepare(
            "UPDATE users SET nama=?, email=?, role=? WHERE id_user=?"
        );
        $stmt->bind_param("sssi", $nama, $email, $role, $id);
    }

    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="flex-1 flex flex-col">
    <?php include __DIR__ . '/../templates/navbar.php'; ?>

    <main class="flex-1 p-6 bg-gray-50">
        <h1 class="text-2xl font-bold mb-6">Edit User</h1>

        <form method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md">

            <div class="mb-4">
                <label class="block mb-2 font-medium">Username</label>
                <input type="text"
                       value="<?= htmlspecialchars($user['username']) ?>"
                       disabled
                       class="w-full border px-3 py-2 rounded bg-gray-100">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Password Baru</label>
                <input type="password"
                       name="password"
                       placeholder="Kosongkan jika tidak diubah"
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Nama</label>
                <input type="text"
                       name="nama"
                       value="<?= htmlspecialchars($user['nama']) ?>"
                       required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium">Email</label>
                <input type="email"
                       name="email"
                       value="<?= htmlspecialchars($user['email']) ?>"
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-medium">Role</label>
                <select name="role" class="w-full border px-3 py-2 rounded">
                    <option value="admin" <?= $user['role']==='admin'?'selected':'' ?>>Admin</option>
                    <option value="staff" <?= $user['role']==='staff'?'selected':'' ?>>Staff</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button class="bg-blue-500 text-white px-6 py-2 rounded">
                    Update
                </button>
                <a href="index.php"
                   class="bg-gray-300 px-6 py-2 rounded">
                    Batal
                </a>
            </div>
        </form>
    </main>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
