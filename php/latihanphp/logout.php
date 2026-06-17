<?php
session_start();
session_destroy(); // Menghapus semua session penanda login
header("Location: login.php"); // Lempar balik ke halaman login
exit;
?>