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
    <title>Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">
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

    <!--- About Us--->
    <section class="container mx-auto px-4 py-12">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-4">About Bagaspati Store</h1>
            <p class="text-lg text-gray-400">Aplikasi web ini adalah proyek tugas akhir/UAS untuk mata kuliah pemrograman web dasar</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Tentang Website</h2>
                <p class="text-gray-400 leading-relaxed">
                    Bagaspati Store adalah sebuah platform untuk menjual berbagai aplikasi streaming premium seperti Netflix, Disney+, Spotify, dan lainnya.
                    Website ini dirancang untu memberikan pengalaman pengguna yang modern dan interaktif. Dengan desain yang sederhana, pengguna dapat dengan mudah menemukan dan membeli aplikasi yang mereka inginkan.
                </p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Fitur Utama</h2>
                <ul class="list-disc list-inside text-gray-400 space-y-2">
                    <li>Menampilkan berbagai produk aplikasi premium dengan harga dan stok terkini.</li>
                    <li>Fitur login dan manajemen akun untuk memastikan keamanan akses pengguna.</li>
                    <li>Menu admin khusus untuk mengelola pengguna, dan daftar produk.</li>
                    <li>Halaman kontak untuk menghubungi pengelola web melalui email dan media sosial.</li>
                    <li>Halaman dinamis yang dirancang menggunakan Tailwind CSS untuk pengalaman pengguna yang optimal.</li>
                </ul>
            </div>
        </div>
        <div class="bg-gray-800 p-6 mt-12 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-bold mb-4">Tujuan Proyek</h2>
            <p class="text-gray-400 leading-relaxed">
                Website ini dibuat sebagai bagian dari tugas akhir/UAS mata kuliah pemrograman web dasar. Tujuan nya adalah untuk mengimplementasikan teknologi HTML, CSS, JavaScript, PHP, 
                dan MySQL dalam membangun aplikasi web yang fungsional dan profesional. Web ini juga menjadi media untuk meningkatkan pemahaman dan kemampuan mahasiswa dalam mengelola data dan antarmuka pengguna.
            </p>
        </div>
    </section>
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