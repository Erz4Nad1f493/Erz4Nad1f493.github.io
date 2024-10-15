<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data yang Dikirim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        header {
            background-color: #4a90e2;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        main {
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h2 {
            color: #333;
        }

        p {
            margin: 10px 0;
        }

        button {
            padding: 10px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3c78b9;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Data yang Dikirim</h1>
</header>

<main>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $pesan = htmlspecialchars($_POST['message']);

        echo "<h2>Informasi Pengguna:</h2>";
        echo "<p><strong>Nama:</strong> $nama</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Pesan:</strong> $pesan</p>";
        echo "<button onclick='window.history.back()'>Kembali</button>";

    } else {
        echo "<h2>Tidak Ada Data</h2>";
        echo "<p>Silakan kembali dan isi formulir.</p>";
        echo "<button onclick='window.history.back()'>Kembali</button>";
    }
    ?>
</main>

<footer>
    <p>© 2024 by ersa.</p>
</footer>

</body>
</html>
