<?php
include 'koneksi.php';

if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];

    // Query untuk menghapus data
    $sql = "DELETE FROM informasi WHERE nama = ?";
    $stmt = $conn->prepare($sql);
    
    // Menggunakan 's' untuk string
    $stmt->bind_param("s", $nama);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus'); document.location.href='kelola_data.php';</script>";
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
