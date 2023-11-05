<?php
include 'layout/koneksi.php';

$data_transaksi = select("SELECT * FROM transaksi");
function select($query){

    global $conn;

    $result = mysqli_query($conn,$query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;

}

if (isset($_POST['search'])) {
    $search = $_POST['search'];

    // Menjalankan query pencarian berdasarkan kata kunci yang diberikan
    $query = "SELECT * FROM transaksi WHERE id_transaksi LIKE '%$search%' OR nama_penyewa LIKE '%$search%' OR nama_mobil LIKE '%$search%'";
    $data_transaksi = select($query);
} else {
    // Jika tidak ada parameter pencarian, tampilkan semua data mobil
    $data_transaksi = select("SELECT * FROM transaksi");
}
?>

    <div id="mobil-table">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Nama Mobil</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Harga total</th>
                </tr>
            </thead>

            <tbody> 
                <?php $no = 1 ;?>
                <?php foreach ($data_transaksi as $trs) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $trs['nama_penyewa'] ?></td>
                <td><?= $trs['nama_mobil'] ?></td>
                <td><?= $trs['tgl_pinjam'] ?></td>
                <td><?= $trs['tgl_kembali'] ?></td>
                <td><?= $trs['harga_rental'] ?></td>

                
                <td width="15%" class="text-center">
                        <a href="edit-transaksi.php?id=<?= $trs['id_transaksi'] ?>" class="btn btn-success">Ubah</a>
                        <a href="delete-transaksi.php?id=<?= $trs['id_transaksi']?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>

            
            </tbody>

    </table>
    </div>
    </div>