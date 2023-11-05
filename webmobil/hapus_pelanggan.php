<?php
include 'layout/header.php';
function connectDatabase() {
    $host = '';
    $username = 'root';
    $password = '';
    $database = 'rental_mobil';

    // Buat koneksi
    $conn = new mysqli($host, $username, $password, $database);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

// hapus_pelanggan.php
if (isset($_GET['id'])) {
    $id_penyewa = $_GET['id'];

    // Fungsi untuk menghapus data pelanggan berdasarkan ID
    function deleteDataPelangganByID($id)
    {
        $conn = connectDatabase();
        

        $id = $conn->real_escape_string($id);
        $sql = "DELETE FROM penyewa WHERE id_penyewa = '$id'";

        if ($conn->query($sql) === TRUE) {
            // Redirect kembali ke halaman "Menu Data Pelanggan" setelah berhasil dihapus
            header('Location: data_pelanggan.php');
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    // Proses penghapusan data jika dikonfirmasi
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (deleteDataPelangganByID($id_penyewa)) {
            // Jika penghapusan berhasil, refresh halaman
            header("Location:data_pelanggan.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Hapus Data Pelanggan</title>
</head>
<body>
<h1 style="text-align: center">Konfirmasi Hapus Data Pelanggan</h1>
<p>Apakah Anda yakin ingin menghapus data pelanggan ini?</p>
<form method="POST" action="">
    <button type="submit">Ya, Hapus</button>
    <a href="data_pelanggan.php">Batalkan</a>
</form>
</body>
</html>
