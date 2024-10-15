<?php
// Detail koneksi database
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'gudangdb';

// Membuat koneksi
$conn = mysqli_connect($server, $user, $password, $dbname);

// Mengecek koneksi
if (!$conn) {
    die("Gagal terhubung ke database: " . mysqli_connect_error());
} else {
}
?>
