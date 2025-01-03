<?php
session_start();
require '../auth/koneksi.php';

// Tambah produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $table = $_POST['table'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok_barang = $_POST['stok_barang'];

    $sql = "INSERT INTO $table (nama_produk, harga, stok_barang) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $nama_produk, $harga, $stok_barang);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Produk berhasil ditambahkan ke tabel $table.";
        header("Location: ../admin/kelola_produk.php?table=" . $table);
        exit();
    } else {
        $message = "Gagal menambahkan produk: " . $conn->error;
    }
}

// Hapus produk
if (isset($_GET['delete']) && isset($_GET['table'])) {
    $id = $_GET['delete'];
    $table = $_GET['table'];

    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Produk berhasil dihapus.";
        header("Location: ../admin/kelola_produk.php?table=" . $table);
        exit();
    } else {
        $message = "Gagal menghapus produk: " . $conn->error;
    }
}

// Edit produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok_barang = $_POST['stok_barang'];

    $sql = "UPDATE $table SET nama_produk = ?, harga = ?, stok_barang = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nama_produk, $harga, $stok_barang, $id);

    if ($stmt->execute()) {
        $message = "Produk berhasil diperbarui.";
    } else {
        $message = "Gagal memperbarui produk: " . $conn->error;
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Ambil data produk dari tabel tertentu
$selected_table = isset($_GET['table']) ? $_GET['table'] : 'tb_yt';
$products = $conn->query("SELECT * FROM $selected_table");
$angka = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200 font-sans">

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

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-center text-blue-400 mb-8">Manajemen Produk</h1>

        <!-- Message -->
        <?php if (isset($message)): ?>
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Pilih Tabel -->
        <div class="mb-6">
            <form method="GET" action="">
                <label for="table" class="text-gray-300">Pilih Tabel Produk:</label>
                <select name="table" id="table" class="bg-gray-800 text-gray-200 p-2 rounded">
                    <option value="tb_yt" <?php if ($selected_table == 'tb_yt') echo 'selected'; ?>>YouTube</option>
                    <option value="tb_netflix" <?php if ($selected_table == 'tb_netflix') echo 'selected'; ?>>Netflix</option>
                    <option value="tb_iqiyi" <?php if ($selected_table == 'tb_iqiyi') echo 'selected'; ?>>iQIYI</option>
                    <option value="tb_vidio" <?php if ($selected_table == 'tb_vidio') echo 'selected'; ?>>Vidio</option>
                    <option value="tb_viu" <?php if ($selected_table == 'tb_viu') echo 'selected'; ?>>Viu</option>
                    <option value="tb_spotify" <?php if ($selected_table == 'tb_spotify') echo 'selected'; ?>>Spotify</option>
                    <option value="tb_disney" <?php if ($selected_table == 'tb_disney') echo 'selected'; ?>>Disney+</option>
                </select>
                <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white hover:bg-blue-600 transition">Lihat</button>
            </form>
        </div>

        <!-- Tambah Produk -->
        <div class="mb-6 bg-gray-800 p-6 rounded-lg">
            <h2 class="text-2xl font-bold text-blue-400 mb-4">Tambah Produk</h2>
            <form method="POST" action="">
                <input type="hidden" name="table" value="<?php echo $selected_table; ?>">
                <div class="mb-4">
                    <label for="nama_produk" class="block text-gray-300">Nama Produk:</label>
                    <input type="text" name="nama_produk" id="nama_produk" required class="bg-gray-700 text-gray-200 p-2 w-full rounded">
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-gray-300">Harga:</label>
                    <input type="number" name="harga" id="harga" step="0.01" required class="bg-gray-700 text-gray-200 p-2 w-full rounded">
                </div>
                <div class="mb-4">
                    <label for="stok_barang" class="block text-gray-300">Stok Barang:</label>
                    <input type="number" name="stok_barang" id="stok_barang" required class="bg-gray-700 text-gray-200 p-2 w-full rounded">
                </div>
                <button type="submit" name="add_product" class="bg-blue-500 px-4 py-2 rounded text-white hover:bg-blue-600 transition">Tambah Produk</button>
            </form>
        </div>

        <!-- Tabel Produk -->
        <div class="overflow-auto bg-gray-800 p-6 rounded-lg">
            <h2 class="text-2xl font-bold text-blue-400 mb-4">Daftar Produk di Tabel: <?php echo ucfirst(str_replace('tb_', '', $selected_table)); ?></h2>
            <table class="table-auto w-full text-left text-gray-300">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-2">NO</th>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama Produk</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Stok</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $products->fetch_assoc()): ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $angka++; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['id']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['nama_produk']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['harga']; ?></td>
                            <td class="border px-4 py-2"><?php echo $row['stok_barang']; ?></td>
                            <td class="border px-4 py-2 flex space-x-2">
                                <a href="?delete=<?php echo $row['id']; ?>&table=<?php echo $selected_table; ?>" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Hapus</a>
                                <button 
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition"
                                    onclick="showEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>, '<?php echo $selected_table; ?>')">Edit</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
        <div class="bg-gray-800 p-6 rounded-lg w-96">
            <h2 class="text-xl font-bold text-blue-400 mb-4">Edit Produk</h2>
            <form method="POST" action="">
                <input type="hidden" name="table" id="editTable">
                <input type="hidden" name="id" id="editId">
                <div class="mb-4">
                    <label for="editNama" class="block text-gray-300">Nama Produk:</label>
                    <input type="text" name="nama_produk" id="editNama" class="bg-gray-700 text-gray-200 p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editHarga" class="block text-gray-300">Harga:</label>
                    <input type="number" name="harga" id="editHarga" step="0.01" class="bg-gray-700 text-gray-200 p-2 w-full rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editStok" class="block text-gray-300">Stok Barang:</label>
                    <input type="number" name="stok_barang" id="editStok" class="bg-gray-700 text-gray-200 p-2 w-full rounded" required>
                </div>
                <button type="submit" name="edit_product" class="bg-blue-500 px-4 py-2 rounded text-white hover:bg-blue-600 transition">Simpan</button>
                <button type="button" onclick="hideEditModal()" class="bg-gray-500 px-4 py-2 rounded text-white hover:bg-gray-600 transition">Batal</button>
            </form>
        </div>
    </div>

    <script>
        function showEditModal(data, table) {
            document.getElementById('editTable').value = table;
            document.getElementById('editId').value = data.id;
            document.getElementById('editNama').value = data.nama_produk;
            document.getElementById('editHarga').value = data.harga;
            document.getElementById('editStok').value = data.stok_barang;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function hideEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>

