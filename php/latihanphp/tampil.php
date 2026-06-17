<?php 

session_start(); // 1. Aktifkan session di baris paling pertama

// 2. Satpam Proteksi: Jika tidak ada session 'login', tendang ke login.php
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php"); // Pastikan nama file loginmu sesuai (misal: login.php)
    exit;
}

// Hubungkan ke file data array milikmu
include 'dataarray.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-3xl mx-auto mt-10 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Daftar Produk</h1>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-red-600 transition-colors">
                Logout
            </a>
        </div>
        
        <table class="w-full border-collapse bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left w-12">No</th>
                    <th class="px-4 py-3 text-left w-24">Foto</th> <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-right">Harga</th>
                    <th class="px-4 py-3 text-right">Link</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $i => $item): ?>
                <tr class="border-b even:bg-gray-50 items-center">
                    <td class="px-4 py-3"><?= $i + 1 ?></td>
                    
                    <td class="px-4 py-3">
                        <img src="<?= $item['foto'] ?>" 
                             alt="<?= htmlspecialchars($item['nama']) ?>" 
                             class="w-12 h-12 object-cover rounded-md shadow-sm">
                    </td>
                    
                    <td class="px-4 py-3 font-medium"><?= htmlspecialchars($item["nama"]) ?></td>
                    <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($item["kategori"]) ?></td>
                    <td class="px-4 py-3 text-right font-mono">Rp <?= number_format($item["harga"], 0, ',', '.') ?></td>
                    <td class="px-4 py-3 font-medium"><?= htmlspecialchars($item["link"]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
