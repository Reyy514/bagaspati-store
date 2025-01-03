<?php
session_start();
require '../auth/koneksi.php';

$notification = ""; // Variabel untuk menyimpan pesan notifikasi

// Jika tombol beli ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['beli'])) {
    $id_produk = $_POST['id_produk'];
    $quantity = $_POST['quantity'];

    // Ambil data produk
    $query = "SELECT * FROM tb_iqiyi WHERE id = $id_produk";
    $result = $conn->query($query);
    $produk = $result->fetch_assoc();

    if ($produk && $produk['stok_barang'] >= $quantity) {
        // Kurangi stok
        $stok_baru = $produk['stok_barang'] - $quantity;
        $update_query = "UPDATE tb_iqiyi SET stok_barang = $stok_baru WHERE id = $id_produk";
        $conn->query($update_query);

        // Format pesan WhatsApp
        $nama_produk = $produk['nama_produk'];
        $harga = $produk['harga'];
        $message = urlencode("Pesanan Baru:\nProduk: $nama_produk\nHarga: Rp" . number_format($harga, 0, ',', '.') . "\nQuantity: $quantity\nSisa Stok: $stok_baru");

        // Kirim ke WhatsApp
        $wa_number = "62895618288884"; // Ganti dengan nomor WhatsApp Anda
        $wa_url = "https://api.whatsapp.com/send?phone=$wa_number&text=$message";

        // Redirect ke WhatsApp
        header("Location: $wa_url");
        exit;
    } else {
        $notification = "Stok tidak mencukupi untuk produk: " . htmlspecialchars($produk['nama_produk']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bagaspati Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">
    <!-- Notifikasi -->
    <?php if (!empty($notification)) { ?>
        <div class="bg-red-500 text-white p-4 mb-4 text-center">
            <?php echo $notification; ?>
        </div>
    <?php } ?>
    <!---- navbar --->
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
    <!---- menu utama --->
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-left mb-8 text-blue-400">iQIYI</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php
            // Ambil data produk
            $query = "SELECT * FROM tb_iqiyi";
            $result = $conn->query($query);

            // Tampilkan produk
            while ($row = $result->fetch_assoc()) {
                // Path gambar berdasarkan folder dan ID produk
                $image_path = "../img/iqiyi.png"; // Ubah ekstensi jika berbeda (misalnya .png)
                if (!file_exists($image_path)) {
                    $image_path = "img/default-placeholder.png"; // Placeholder jika gambar tidak ada
                }
            ?>
                <form method="POST" class="bg-gray-800 rounded-lg shadow-md p-4 flex flex-col justify-between">
                    <!-- Gambar Produk -->
                    <div class="relative w-full pb-[100%] mb-4">
                        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="absolute top-0 left-0 w-full h-full object-cover rounded-md">
                    </div>

                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($row['nama_produk']); ?></h2>
                    <p class="text-gray-400">Harga: Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                    <p class="text-gray-400">Stok: <?php echo $row['stok_barang']; ?></p>

                    <div class="flex items-center mt-4 space-x-2">
                        <input type="number" name="quantity" value="1" min="1" max="<?php echo $row['stok_barang']; ?>" class="w-16 text-center p-2 bg-gray-700 border border-gray-600 rounded focus:outline-none" />
                    </div>

                    <input type="hidden" name="id_produk" value="<?php echo $row['id']; ?>" />
                    <button type="submit" name="beli" class="mt-4 px-4 py-2 rounded font-bold text-white <?php echo $row['stok_barang'] > 0 ? 'bg-blue-500 hover:bg-blue-600' : 'bg-red-500 cursor-not-allowed'; ?>"
                            <?php echo $row['stok_barang'] > 0 ? '' : 'disabled'; ?>>
                        <?php echo $row['stok_barang'] > 0 ? 'Beli' : 'Stok Habis'; ?>
                    </button>
                </form>

            <?php } ?>
        </div>
    </div>

    <footer class="bg-gray-800 py-6 mt-8">
        <div class="container mx-auto px-6 text-center">
            <!-- Teks Footer -->
            <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; <?= date('Y') ?> Bagaspati Store. Semua hak dilindungi.</p>

            <!-- Ikon Media Sosial -->
            <div class="flex justify-center space-x-6">
                <!-- Instagram -->
                <a href="https://instagram.com/r514._" target="_blank" class="text-gray-400 hover:text-pink-500 transition">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>

                <!-- Facebook -->
                <a href="https://facebook.com/profile.php?id=100010812880114" target="_blank" class="text-gray-400 hover:text-blue-500 transition">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>

                <!-- Telegram -->
                <a href="https://tiktok.com/@r514._" target="_blank" class="text-gray-400 hover:text-black transition">
                    <i class="fab fa-tiktok fa-lg"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js" defer></script>
</body>
</html>