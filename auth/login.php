<?php
session_start();
require 'koneksi.php';

// Variabel pesan
$error_message = "";

// Proses form jika ada data POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validasi server-side
    if (empty($username) || empty($password)) {
        $error_message = "Username dan Password wajib diisi.";
    } else {
        // Ambil data user dari database
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header("Location: /bagaspati-store/index.php"); // Redirect ke dashboard
                exit;
            } else {
                $error_message = "Password salah.";
            }
        } else {
            $error_message = "Username tidak ditemukan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/font-awesome.min.css">
</head>
<body class="bg-gray-900 text-gray-200 font-sans">

    <!-- Container Form -->
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-8">
            <!-- Header -->
            <h2 class="text-3xl font-bold text-center mb-6 text-blue-400">Login</h2>

            <!-- Pesan Error -->
            <?php if (!empty($error_message)): ?>
                <div class="mb-4 p-4 bg-red-600 text-white text-sm rounded-md">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="login.php">
                <!-- Input Username -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-2">Username</label>
                    <div class="flex items-center bg-gray-700 rounded-md">
                        <i class="fa fa-user p-3 text-gray-400"></i>
                        <input type="text" id="username" name="username" 
                               class="w-full py-2 px-4 rounded-l-md bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                               placeholder="Masukkan username" required>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <div class="flex items-center bg-gray-700 rounded-md relative">
                        <i class="fa fa-key p-3 text-gray-400"></i>
                        <input type="password" id="password" name="password"
                               class="w-full py-2 px-4 rounded-l-md bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                               placeholder="Masukkan password" required>
                        <button type="button" onclick="togglePassword('password', 'togglePasswordIcon')" 
                                class="absolute right-3 text-gray-400 hover:text-gray-300">
                            <svg id="togglePasswordIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 2a5 5 0 015 5 5 5 0 11-5-5z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Login -->
                <button type="submit" 
                        class="w-full py-2 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-md transition duration-300">
                    Login
                </button>
            </form>

            <!-- Link ke Register -->
            <p class="mt-6 text-center text-sm">
                Belum punya akun? 
                <a href="register.php" class="text-blue-400 hover:text-blue-300 transition duration-300">Daftar di sini</a>
            </p>
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

    <!-- Script Show/Hide Password -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.innerHTML = '<path d="M10 3c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 2a5 5 0 015 5 5 5 0 11-5-5z"/>';
            } else {
                input.type = "password";
                icon.innerHTML = '<path d="M10 3c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 2a5 5 0 015 5 5 5 0 11-5-5zm0 2a3 3 0 100 6 3 3 0 000-6z"/>';
            }
        }
    </script>

</body>
</html>