<?php
session_start();
require 'auth/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location: /bagaspati-store/auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bagaspati Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <!-- Header -->
    <nav class="bg-gray-800 shadow-g">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white">Bagaspati Store</a>
            <div class="hidden md:flex space-x-6">
                <a href="index.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">Home</a>
                <a href="contact.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">Contact</a>
                <a href="about.php" class="px-4 py-2 text-gray-200 hover:text-gray-400 transition rounded-lg">About</a>
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
    <main class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Contact Us</h2>
        <p class="text-center mb-8 text-gray-300">
            Hubungi kami untuk pertanyaan, saran, atau bantuan. Kami akan dengan senang hati membantu Anda.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Email -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fas fa-envelope text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Email</h3>
                <p class="text-gray-400">bagaspati.store@gmail.com</p>
            </div>

            <!-- Phone -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fas fa-phone text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Phone</h3>
                <p class="text-gray-400">+62 812-3456-7890</p>
            </div>

            <!-- Address -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fas fa-map-marker-alt text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Address</h3>
                <p class="text-gray-400">Jl. Raya Web Developer No. 21, Purwkarta</p>
            </div>

            <!-- Instagram -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fab fa-instagram text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Instagram</h3>
                <a href="https://instagram.com/bagaspati.store" class="text-blue-400">instagram.com/bagaspati.store</a>
            </div>

            <!-- Facebook -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fab fa-facebook text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Facebook</h3>
                <a href="https://facebook.com/bagaspati.store" class="text-blue-400">facebook.com/bagaspati.store</a>
            </div>

            <!-- Tiktok -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center">
                <i class="fab fa-tiktok text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Tiktok</h3>
                <a href="https://tiktok.com/@bagaspati.store" class="text-blue-400">tiktok.com/@bagaspati.store</a>
            </div>
        </div>
    </main>

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