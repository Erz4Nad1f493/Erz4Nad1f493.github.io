<?php
session_start();
require_once 'koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nama'];
    $password = $_POST['password'];

    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Jika password benar, simpan sesi
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo "<script>
                    alert('Login Berhasil!');
                    window.location.href = 'kelola_data.php';
                  </script>";
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gudang Sembako</title>
    <link rel="stylesheet" href="stylelogin.css"> <!-- Menghubungkan ke CSS eksternal -->
</head>
<body>
    <section class="order">
        <h2><span>Login</span></h2>
        <p>Silakan Isi Nama dan Passwordnya</p>

        <!-- Pesan error jika username atau password salah -->
        <?php if (isset($error)): ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-group">
                <label>Username</label><br>
                <i data-feather="user"></i>
                <input type="text" name="nama" placeholder="Nama" required>
            </div>
            <div class="input-group">
                <label>Password</label><br>
                <i data-feather="key"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button class="btn" type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php" style="color: var(--primary-color); text-decoration: none;">Daftar di sini</a></p>
    </section>

    <!-- Menghubungkan script.js jika diperlukan -->
    <script src="script.js"></script>
</body>
</html>
