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

if (isset($_GET['id'])) {
    $id_penyewa = $_GET['id'];

    // Fungsi untuk mengambil data pelanggan berdasarkan ID
    function getDataPelangganByID($id)
    {
        $conn = connectDatabase();

        $id = $conn->real_escape_string($id);
        $sql = "SELECT * FROM penyewa WHERE id_penyewa = '$id'";
        $result = $conn->query($sql);

        $dataPelanggan = $result->fetch_assoc();

        $conn->close();

        return $dataPelanggan;
    }

    // Panggil fungsi untuk mengambil data pelanggan berdasarkan ID
    $data_pelanggan = getDataPelangganByID($id_penyewa);

    // Proses penyimpanan data yang diubah
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data yang diubah dari formulir
        $nama_penyewa = $_POST['nama_penyewa'];
        $email = $_POST['email'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $ktp = $_POST['ktp'];
        $KK = $_POST['KK'];

        // Proses update data ke database
        $conn = connectDatabase();

        $nama_penyewa = $conn->real_escape_string($nama_penyewa);
        $email = $conn->real_escape_string($email);
        $telp = $conn->real_escape_string($telp);
        $alamat = $conn->real_escape_string($alamat);
        $ktp = $conn->real_escape_string($ktp);
        $KK = $conn->real_escape_string($KK);

        $sql = "UPDATE penyewa SET 
                nama_penyewa = '$nama_penyewa', 
                email = '$email', 
                telp = '$telp', 
                alamat = '$alamat', 
                ktp = '$ktp', 
                KK = '$KK' 
                WHERE id_penyewa = '$id_penyewa'";

if ($conn->query($sql) === TRUE) {
    // Redirect kembali ke halaman "Menu Data Pelanggan" setelah berhasil diubah
    header('Location: data_pelanggan.php');
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

        $conn->close();
    }
}
?>

<!-- Buatlah formulir untuk mengedit data pelanggan -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pelanggan</title>
</head>
<body>
    <div class="container mt-4">
<h1 style="text-align: center">Edit Data Pelanggan</h1>
<form method="POST" action="">
    <label for="nama_penyewa">Nama Penyewa:</label>
    <input type="text" class="form-control" name="nama_penyewa" value="<?= $data_pelanggan['nama_penyewa']; ?>"><br>
    <label>Email:</label>
    <input type="email" class="form-control" name="email" value="<?= $data_pelanggan['email']; ?>"><br>
    <label>Telp:</label>
    <input type="telp" class="form-control" name="telp" value="<?= $data_pelanggan['telp']; ?>"><br>
    <label>Alamat:</label>
    <input type="alamat" class="form-control" name="alamat" value="<?= $data_pelanggan['alamat']; ?>"><br>
    <label>KTP:</label>
    <input type="text" class="form-control" name="ktp" value="<?= $data_pelanggan['ktp']; ?>"><br>
    <label>KK:</label>
    <input type="text" class="form-control" name="KK" value="<?= $data_pelanggan['KK']; ?>"><br>

    <!-- Masukkan input lainnya sesuai dengan data pelanggan lainnya -->
    
    <button type="submit">Simpan Perubahan</button>
</form>
</body>
</html>
