<?php
// koneksi.php
$host = "localhost";   // nama host server
$user = "root";        // username default XAMPP
$pass = "";            // password kosong (default XAMPP)
$db   = "mahasiswa_db"; // nama database kamu

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
