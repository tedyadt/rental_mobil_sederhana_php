<?php
include 'layout/header.php';
?>

<!DOCTYPE html>

<html>
<head>
    <title>Form Tambah Data Pelanggan</title>
</head>
<body>
<div class="container mt-4">
    <h1>Form Tambah Data Pelanggan</h1>
    <form method="post" enctype="multipart/form-data" action="proses_tambah_pelanggan.php">
        
        <label>ID Penyewa:</label>
        <input type="text" class="form-control" name="id_penyewa" required><br>

        <label>Nama Penyewa:</label>
        <input type="text" class="form-control" name="nama_penyewa" required><br>

        <label>Email:</label>
        <input type="email" class="form-control" name="email" required><br>

        <label>Telepon:</label>
        <input type="tel" class="form-control" name="telp" required><br>

        <label>Alamat:</label>
        <textarea name="alamat" class="form-control" required></textarea><br>

        <label>No. KTP:</label>
        <input type="text" class="form-control" name="ktp" required><br>

        <label>No. KK:</label>
        <input type="text" class="form-control" name="KK" required><br>

        <input type="submit" class="btn btn-primary" value="Tambahkan">
    </form>
    </div>
</body>
</html>
<?php 
include 'layout/footer.php';
?>
