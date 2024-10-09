<?php

include 'koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

// Query untuk insert data
$sql = "INSERT INTO informasi (nama, email, pesan) VALUES (?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("sss", $nama, $email, $pesan);

// Eksekusi query
if ($stmt->execute()) {
    echo "<script>
            alert('Berhasil menambah data');
            document.location.href = 'index.html';
          </script>";

} else {
    echo "<script>
            alert('Gagal menambah data');
            document.location.href = 'index.html';
          </script>";
}

// Menutup koneksi
$stmt->close();
$conn->close();

?>