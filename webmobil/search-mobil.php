<?php
include 'layout/koneksi.php';
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
    $query = "SELECT * FROM mobil WHERE plat_mobil LIKE '%$search%' OR nama_mobil LIKE '%$search%' OR merk_mobil LIKE '%$search%'";
    $data_mobil = select($query);
} else {
    // Jika tidak ada parameter pencarian, tampilkan semua data mobil
    $data_mobil = select("SELECT * FROM mobil");
}
?>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Plat</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($data_mobil as $mobil) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $mobil['plat_mobil'] ?></td>
                <td><?= $mobil['nama_mobil'] ?></td>
                <td><?= $mobil['merk_mobil'] ?></td>
                <td><?= $mobil['harga_rental'] ?></td>      
                <td width="10%" height="10%">
                <img src="gambar/<?= $mobil['foto_mobil'] ?>" alt="Foto Mobil" width="100">
                </td>
                <td width="15%" class="text-center">
                    <a href="edit.php?id=<?= $mobil['plat_mobil'] ?>" class="btn btn-success">Ubah</a>
                    <a href="delete.php?id=<?= $mobil['plat_mobil'] ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'layout/footer.php'; ?>
