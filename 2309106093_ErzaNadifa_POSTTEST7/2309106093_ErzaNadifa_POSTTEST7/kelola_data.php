<?php
include 'koneksi.php'; 

// Inisialisasi variabel pencarian
$search = "";

// Jika ada input pencarian dari form
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Query pencarian data berdasarkan nama, email, atau pesan
    $sql = "SELECT * FROM informasi WHERE nama LIKE '%$search%' OR email LIKE '%$search%' OR pesan LIKE '%$search%' ";
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $sql = "SELECT * FROM informasi";
}

// Eksekusi query
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
        
        .search-container {
            display: flex;
            justify-content: center;
            margin: 20px auto;
            width: 100%;
        }

        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid var(--primary-color);
            border-radius: 5px 0 0 5px;
            background-color: #333;
            color: #fff;
            outline: none;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-container input[type="text"]::placeholder {
            color: #aaa;
        }

        .search-container input[type="text"]:focus {
            border-color: var(--primary-color);
        }

        .search-container button {
            padding: 10px 20px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 0 5px 5px 0;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .search-container button:hover {
            background-color: #a97e52;
        }
    </style>
</head>
<body>

    <main>
        <div class="container fade-in">
            <h1>Pendataan Barang Gudang Sembako</h1>
            <!-- Formulir Pencarian -->
            <form action="" method="GET" class="search-container">
                <input type="text" name="search" placeholder="Cari berdasarkan nama, email, atau pesan" value="<?php echo $search; ?>">
                <button type="submit">Cari</button>
            </form>

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
                        echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="button-container">
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
    </main>

</body>
</html>

<?php
$conn->close();  // Menutup koneksi
?>
