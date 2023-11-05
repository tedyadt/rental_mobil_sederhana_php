<?php
include 'layout/header.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses penyimpanan data ke database
    $plat_mobil = $_POST['plat_mobil'];
    $nama_mobil = $_POST['nama_mobil'];
    $merk_mobil = $_POST['merk_mobil'];
    $harga_rental = $_POST['harga_rental'];

    // Proses unggah gambar
    $targetDir = "gambar/";
    $fotoMobil = basename($_FILES["foto_mobil"]["name"]);
    $targetFile = $targetDir . $fotoMobil;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file gambar valid
    $check = getimagesize($_FILES["foto_mobil"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan merupakan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file (10MB)
    if ($_FILES["foto_mobil"]["size"] > 10 * 1024 * 1024) {
        echo "Maaf, ukuran file gambar terlalu besar. Maksimum 10MB.";
        $uploadOk = 0;
    }

    // Cek ekstensi file gambar
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya file gambar dengan format JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika semua validasi berhasil, unggah file gambar dan simpan data ke database
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["foto_mobil"]["tmp_name"], $targetFile)) {
            echo "File gambar " . basename($_FILES["foto_mobil"]["name"]) . " berhasil diunggah.";

            // Simpan data ke database, menggunakan koneksi database $conn
            $query = "INSERT INTO mobil (plat_mobil, nama_mobil, merk_mobil, harga_rental, foto_mobil) VALUES ('$plat_mobil', '$nama_mobil', '$merk_mobil', $harga_rental, '$fotoMobil')";
            $result = mysqli_query($conn, $query);

            if ($result) {  
                // Redirect ke halaman data mobil setelah berhasil tambah data
                header('Location: data-mobil.php');
                exit;
            } else {
                // Tampilkan pesan error jika gagal menyimpan data
                echo "Gagal menyimpan data mobil.";
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file gambar.";
        }
    }
}
?>

<div class="container mt-4">
    <h1>Tambah Data Mobil</h1>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="plat_mobil">Plat Nomor</label>
            <input type="text" class="form-control" id="plat_mobil" name="plat_mobil" required>
        </div>
        <div class="form-group">
            <label for="nama_mobil">Nama</label>
            <input type="text" class="form-control" id="nama_mobil" name="nama_mobil" required>
        </div>
        <div class="form-group">
            <label for="merk_mobil">Merk</label>
            <input type="text" class="form-control" id="merk_mobil" name="merk_mobil" required>
        </div>
        <div class="form-group">
            <label for="harga_rental">Harga</label>
            <input type="number" class="form-control" id="harga_rental" name="harga_rental" required>
        </div>
        <div class="form-group">
            <label for="foto_mobil">Foto Mobil</label>
            <input type="file" class="form-control-file" id="foto_mobil" name="foto_mobil">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<?php 
include 'layout/footer.php';
?>
