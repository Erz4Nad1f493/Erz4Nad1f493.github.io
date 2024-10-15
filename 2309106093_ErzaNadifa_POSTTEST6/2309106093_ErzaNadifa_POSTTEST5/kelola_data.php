<?php
include 'koneksi.php';  // Menghubungkan ke database

// Query untuk mendapatkan semua data
$sql = "SELECT * FROM informasi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan - Barang Gudang Sembako</title>
    <link rel="stylesheet" href="styles.css"> <!-- Menggunakan gaya global -->
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f39c12;
            --text-color: #333;
            --bg-color: #fff;
            --footer-bg: #2c3e50;
        }
        .container {
            max-width: 900px;
            margin: 5rem auto;
            padding: 2rem;
            background-color: var(--bg-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .button-container {
            text-align: center;
        }

        .btn {
            background-color: var(--secondary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: #e67e22;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <main>
        <div class="container fade-in">
            <h1>Pendataan Barang Gudang Sembako</h1>

            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['nama']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['pesan']}</td>
                                    <td><img src='files/{$row['file']}' alt='{$row['file']}' width='100' height='100'></td>
                                    <td>
                                        <a href='update.php?nama={$row['nama']}'>Edit</a> |
                                        <a href='delete.php?nama={$row['nama']}'>Hapus</a>
                                    </td>
                                  </tr>";
                        }
                        
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="button-container">
                <a href="index.html" class="btn">Kembali ke Beranda</a>
            </div>
        </div>
    </main>

</body>
</html>

<?php
$conn->close();  // Menutup koneksi
?>
