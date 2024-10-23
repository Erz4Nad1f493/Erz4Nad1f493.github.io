<?php
session_start();
require_once 'koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Cek apakah username sudah ada
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Username sudah digunakan.";
    } else {
        // Masukkan data pengguna baru ke database
        $insert = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param('ss', $username, $password);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Daftar Berhasil!');
                    window.location.href = 'login.php';
                  </script>";
            exit;
        } else {
            $error = "Pendaftaran gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi - Gudang Sembako</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
    <section class="order">
        <h2>Registrasi</h2>
        <?php if (isset($error)) echo "<div style='color: red;'>$error</div>"; ?>

        <?php if (isset($error)): ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label>Username</label><br>
                <i data-feather="user"></i>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label>Password</label><br>
                <i data-feather="key"></i>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Daftar</button>
        </form>
    </section>
</body>
</html>