<?php
// proses_tambah_pelanggan.php

function connectDatabase()
{

    $conn = mysqli_connect('localhost', 'root', '', 'rental_mobil');

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_penyewa = $_POST["id_penyewa"];
    $nama_penyewa = $_POST["nama_penyewa"];
    $email = $_POST["email"];
    $telp = $_POST["telp"];
    $alamat = $_POST["alamat"];
    $ktp = $_POST["ktp"];
    $KK = $_POST["KK"];
    
    // Lakukan koneksi ke database
    $conn = connectDatabase();

    // Lakukan query untuk menyimpan data ke dalam tabel pelanggan
    $sql = "INSERT INTO penyewa (id_penyewa, nama_penyewa, email, telp, alamat, ktp, KK) VALUES ('$id_penyewa', '$nama_penyewa', '$email', '$telp', '$alamat', '$ktp', '$KK' )";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil ditambahkan.";
        header("Location:data_pelanggan.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
