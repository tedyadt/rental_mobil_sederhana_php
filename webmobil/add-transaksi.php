<?php
include 'layout/header.php';

// Retrieve data from the "mobil" table
$data_mobil = select("SELECT * FROM mobil");

// Retrieve data from the "penyewa" table
$data_penyewa = select("SELECT * FROM penyewa");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the input data from the form
    $nama_penyewa = $_POST['nama_penyewa'];
    $nama_mobil = $_POST['nama_mobil'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    // Get the car price based on the selected car name from the "mobil" table
    $query = "SELECT harga_rental FROM mobil WHERE nama_mobil = '$nama_mobil'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $mobilData = mysqli_fetch_assoc($result);
        $harga_mobil = $mobilData['harga_rental'];

        // Calculate the total price based on the car price and the rental duration
        $tgl_pinjam_unix = strtotime($tgl_pinjam);
        $tgl_kembali_unix = strtotime($tgl_kembali);
        $lama_hari = abs(($tgl_kembali_unix - $tgl_pinjam_unix) / (60 * 60 * 24));
        $total_harga = $harga_mobil * $lama_hari;

        
        $query = "INSERT INTO transaksi (nama_penyewa, nama_mobil, tgl_pinjam, tgl_kembali, harga_rental, timestamp) 
          VALUES ('$nama_penyewa', '$nama_mobil', '$tgl_pinjam', '$tgl_kembali', $total_harga, NOW())";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: transaksi.php');
            exit;
        } else {
            echo "Gagal menyimpan data transaksi.";
        }
    } else {
        echo "Mobil dengan nama tersebut tidak ditemukan.";
    }
}
?>


<div class="container mt-4">
    <h1>Tambah Data Transaksi</h1>
    <form action="" method="POST" class="mt-3">
        <div class="form-group">
            <label for="nama_penyewa">Nama Penyewa</label>
            <select class="form-control" id="nama_penyewa" name="nama_penyewa" required>
              <?php foreach ($data_penyewa as $penyewa) : ?>
                 <option value="<?= $penyewa['nama_penyewa'] ?>"><?= $penyewa['nama_penyewa'] ?></option>
                 <?php endforeach; ?>
            </select>

        </div>

        <div class="form-group">
            <label for="nama_mobil">Nama Mobil</label>
            <select class="form-control" id="nama_mobil" name="nama_mobil" required>
                 <?php foreach ($data_mobil as $mobil) : ?>
                      <option value="<?= $mobil['nama_mobil'] ?>"><?= $mobil['nama_mobil'] ?></option>
                     <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tgl_pinjam">Tanggal Pinjam</label>
            <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
        </div>

        <div class="form-group">
            <label for="tgl_kembali">Tanggal Kembali</label>
            <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
