<?php
include 'koneksi.php';

if (isset($_GET['nama'])) {
    $nama = $_GET['nama'];

    $sql = "SELECT * FROM informasi WHERE nama = '$nama'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    $nama_lama = $_GET['nama'];

    $tmp_name = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];

    $validExtension = ['jpg', 'jpeg', 'png'];
    $fileExtension = explode('.', $file_name);
    $fileExtension = strtolower(end($fileExtension));

    if (!in_array($fileExtension, $validExtension)) {
        echo "<script>
                alert('File Yang Diupload Bukan Gambar!');
                document.location.href = 'index.html';
              </script>";
    } else {
        $newFileName = date('d-m-y') . '-' . $file_name;
      
        if (move_uploaded_file($tmp_name, 'files/' . $newFileName)) {
            $sql = "UPDATE informasi SET nama = ?, email = ?, pesan = ?, file = ? WHERE nama = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $nama, $email, $pesan, $newFileName, $nama_lama);

            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil diperbarui'); document.location.href='kelola_data.php';</script>";
            } else {
                echo "Gagal memperbarui data: " . $conn->error;
            }
        } else {
            echo "<script>
                    alert('Gagal menambah data');
                    document.location.href = 'index.html';
                  </script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Form Edit -->
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data</title>
        <link rel="stylesheet" href="styles.css"> <!-- Gaya Global -->
        <style>
            :root {
                --primary-color: #4a90e2;
                --secondary-color: #f39c12;
                --text-color: #333;
                --bg-color: #fff;
                --footer-bg: #2c3e50;
            }
            .form-container {
                max-width: 600px;
                margin: 5rem auto;
                background-color: var(--bg-color);
                padding: 2rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
            }

            .form-container h2 {
                text-align: center;
                color: var(--primary-color);
                margin-bottom: 1.5rem;
            }

            .form-container label {
                font-weight: bold;
                color: var(--text-color);
                display: block;
                margin-bottom: 0.5rem;
            }

            .form-container input, 
            .form-container textarea {
                width: 100%;
                padding: 10px;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 1rem;
            }

            .form-container button {
                background-color: var(--secondary-color);
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
                font-size: 1rem;
            }

            .form-container button:hover {
                background-color: #e67e22;
            }
        </style>
    </head>
    <body>

        <main>
            <div class="form-container fade-in">
                <form action="update.php?nama=<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" method="POST" enctype='multipart/form-data'>
                    <h2>Edit Data</h2>
                    <div>
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
                    </div>
                    <div>
                        <label for="pesan">Pesan:</label>
                        <textarea name="pesan" id="pesan" required><?php echo isset($row['pesan']) ? $row['pesan'] : ''; ?></textarea>
                    </div>
                    <div>
                        <label for="file">File :</label>
                        <input type="file" name="file" id="file">
                    </div>
                    <button type="submit">Update Data</button>
                </form>
            </div>
        </main>

    </body>
</html>