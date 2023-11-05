<?php
include 'layout/header.php';

// Fungsi update untuk mengubah data dalam database
function updateTransaksi($id_transaksi, $data)
{
    // Ganti bagian ini dengan informasi koneksi database Anda
    $host = "";
    $username = "root";
    $password = "";
    $dbname = "rental_mobil";

    // Buat koneksi ke database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check koneksi berhasil atau tidak
    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }

    // Buat string query untuk update data
    $set_values = "";
    foreach ($data as $key => $value) {
        $set_values .= "$key = '$value', ";
    }
    $set_values = rtrim($set_values, ', '); // Hilangkan koma terakhir

    // Escaping ID untuk menghindari SQL injection
    $id_transaksi = mysqli_real_escape_string($conn, $id_transaksi);

    // Buat query update
    $query = "UPDATE transaksi SET $set_values WHERE id_transaksi = '$id_transaksi'";

    // Eksekusi query ke database
    $result = mysqli_query($conn, $query);

    // Tutup koneksi ke database
    mysqli_close($conn);

    return $result;
}

// Jika form disubmit, proses perubahan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $nama_penyewa = $_POST['nama_penyewa'];
    $nama_mobil = $_POST['nama_mobil'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $harga_rental = $_POST['harga_rental'];

    // Lakukan validasi data jika diperlukan

    // Panggil fungsi updateTransaksi untuk mengubah data di database
    updateTransaksi($id_transaksi, [
        'nama_penyewa' => $nama_penyewa,
        'nama_mobil' => $nama_mobil,
        'tgl_pinjam' => $tgl_pinjam,
        'tgl_kembali' => $tgl_kembali,
        'harga_rental' => $harga_rental,
    ]);

    // Setelah mengupdate data, arahkan kembali ke halaman data transaksi
    header("Location: transaksi.php");
    exit();
} else {
    // Jika tidak ada permintaan POST, tampilkan form edit dengan data yang ada

    if (isset($_GET['id'])) {
        $id_transaksi = $_GET['id'];

        // Ganti 'transaksi' dengan nama tabel yang sesuai pada database Anda
        $data_transaksi = select("SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'");

        // Periksa apakah data transaksi ditemukan
        if ($data_transaksi) {
            $trs = $data_transaksi[0]; // Ambil data transaksi pertama

            // Tampilkan form edit dengan nilai yang ada
            ?>
            <div class="container mt-4">
                <h1>Edit Data Transaksi</h1>

                <form action="" method="POST" class="mt-2">
                    <input type="hidden" name="id_transaksi" value="<?= $trs['id_transaksi'] ?>">
                    <div class="form-group">
                        <label for="nama_penyewa">Nama Penyewa</label>
                        <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control" value="<?= $trs['nama_penyewa'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_mobil">Nama Mobil</label>
                        <input type="text" id="nama_mobil" name="nama_mobil" class="form-control" value="<?= $trs['nama_mobil'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                        <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="form-control" value="<?= $trs['tgl_pinjam'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tgl_kembali">Tanggal Kembali</label>
                        <input type="date" id="tgl_kembali" name="tgl_kembali" class="form-control" value="<?= $trs['tgl_kembali'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga_rental">Harga Rental</label>
                        <input type="number" id="harga_rental" name="harga_rental" class="form-control" value="<?= $trs['harga_rental'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="data-transaksi.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
            <?php
        } else {
            // Redirect ke halaman data transaksi jika data tidak ditemukan
            header("Location: data-transaksi.php");
            exit();
        }
    }
}
?>



