<?php
session_start();
require '../auth/koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

$alert = '';
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['alert'] = 'Pengguna berhasil dihapus';
        header("Location: ../admin/manage_pengguna.php");
        exit();
    } else {
        $alert = 'Error: ' . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['role'])) {
    $id = intval($_POST['id']);
    $role = $_POST['role'];

    if ($role !== 'admin' && $role !== 'user') {
        $alert = 'Role tidak valid!';
    } else {
        $query = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $role, $id);

        if ($stmt->execute()) {
            $_SESSION['alert'] = "Role berhasil diubah";
            header("Location: ../admin/manage_pengguna.php");
            exit();
        } else {
            $alert = 'Error: ' . $stmt->error;
        }
    }
}

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

$query = "SELECT id, username, role FROM users WHERE username != ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

$angka = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-100">

    <nav class="bg-gray-800 shadow-g">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white">Bagaspati Store</a>
            <div class="hidden md:flex space-x-6">
                <a href="../index.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">Home</a>
                <a href="../contact.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">Contact</a>
                <a href="../about.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">About</a>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <div class="relative group">
                        <button class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">
                            Admin Panel
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 hidden group-hover:block bg-grey-700 rounded-lg mt-2 shadow-lg">
                            <a href="/bagaspati-store/admin/manage_pengguna.php" class="block px-4 py-2 text-gray-200 hover:bg-gray-600 transition">Manajemen Pengguna</a>
                            <a href="/bagaspati-store/admin/kelola_produk.php" class="block px-4 py-2 text-gray-200 hover:bg-gray-600 transition">Kelola Produk</a>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['username'])): ?>
                    <a href="/bagaspati-store/auth/logout.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-400">Manajemen Pengguna</h1>

        <?php if ($alert): ?>
            <div class="bg-green-600 text-white p-4 rounded-md mb-6 text-center">
                <?php echo htmlspecialchars($alert); ?>
            </div>
        <?php endif; ?>

        <table class="w-full table-auto border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700 text-left">
                    <th class="p-3 border border-gray-600">No</th>
                    <th class="p-3 border border-gray-600">ID</th>
                    <th class="p-3 border border-gray-600">Username</th>
                    <th class="p-3 border border-gray-600">Role</th>
                    <th class="p-3 border border-gray-600">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="hover:bg-gray-800">
                        <td class="p-3 border border-gray-600"><?php echo $angka++; ?></td>
                        <td class="p-3 border border-gray-600"><?php echo $row['id']; ?></td>
                        <td class="p-3 border border-gray-600"><?php echo htmlspecialchars($row['username']); ?></td>
                        <td class="p-3 border border-gray-600">
                            <form action="manage_pengguna.php" method="POST" class="flex items-center">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <select name="role" class="px-2 py-1 bg-gray-700 text-gray-100 rounded-md">
                                    <option value="user" <?php echo $row['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <button class="ml-2 px-4 py-1 bg-blue-600 hover:bg-blue-500 text-white rounded-md" type="submit">Ubah</button>
                            </form>
                        </td>
                        <td class="p-3 border border-gray-600">
                            <button onclick="openModal(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['username']); ?>')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Hapus</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 w-96">
            <p id="modalMessage" class="text-lg font-medium text-gray-100 mb-6"></p>
            <div class="flex justify-end space-x-4">
                <button onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">Batal</button>
                <a id="confirmButton" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-500">Hapus</a>
            </div>
        </div>
    </div>

    <script>
        function openModal(userId, username) {
            const modal = document.getElementById('confirmModal');
            const message = document.getElementById('modalMessage');
            const confirmButton = document.getElementById('confirmButton');

            message.innerText = `Apakah Anda yakin ingin menghapus pengguna "${username}"?`;
            confirmButton.href = `/bagaspati-store/admin/manage_pengguna.php?delete=${userId}`;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('confirmModal');
            modal.classList.add('hidden');
        }
    </script>
</body>
</html>