<?php
include 'layout/header.php';

// Periksa apakah ada permintaan POST dari form edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $platMobil = $_POST['plat_mobil'];
    $namaMobil = $_POST['nama_mobil'];
    $merkMobil = $_POST['merk_mobil'];
    $hargaRental = $_POST['harga_rental'];

    // Lakukan validasi data jika diperlukan

    // Lakukan proses penyimpanan ke database
    $query = "UPDATE mobil SET nama_mobil = '$namaMobil', merk_mobil = '$merkMobil', harga_rental = '$hargaRental' WHERE plat_mobil = '$platMobil'";

    // Eksekusi query ke database
    $result = mysqli_query($conn, $query);

    // Setelah berhasil mengubah data, arahkan pengguna kembali ke halaman "index.php" atau tampilkan pesan berhasil
    if ($result && mysqli_affected_rows($conn) > 0) {
        header("Location: index.php"); // Arahkan kembali ke halaman index.php
        exit();
    } else {
        echo "Gagal mengubah data mobil.";
    }
} else {
    // Jika tidak ada permintaan POST, tampilkan form edit dengan data yang ada

    if (isset($_GET['id'])) {
        $platMobil = $_GET['id'];

        // Ambil data mobil berdasarkan plat mobil dari database
        $data_mobil = select("SELECT * FROM mobil WHERE plat_mobil = '$platMobil'");

        // Periksa apakah data mobil ditemukan
        if ($data_mobil) {
            $mobil = $data_mobil[0]; // Ambil data mobil pertama

            // Tampilkan form edit dengan nilai yang ada
            ?>
            <div class="container mt-4">
                <h1>Edit Mobil</h1>

                <form action="edit.php" method="POST">
                    <div class="form-group">
                        <label for="plat_mobil">Plat</label>
                        <input type="text" class="form-control" name="plat_mobil" value="<?= $mobil['plat_mobil'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_mobil">Nama</label>
                        <input type="text" class="form-control" name="nama_mobil" value="<?= $mobil['nama_mobil'] ?>">  
                    </div>
                    <div class="form-group">
                        <label for="merk_mobil">Merk</label>
                        <input type="text" class="form-control" name="merk_mobil" value="<?= $mobil['merk_mobil'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga_rental">Harga</label>
                        <input type="text" class="form-control" name="harga_rental" value="<?= $mobil['harga_rental'] ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <?php
        } else {
            echo "Data mobil tidak ditemukan.";
        }
    } else {
        echo "Plat mobil tidak ditemukan.";
    }
}

include 'layout/footer.php';
?>
    
