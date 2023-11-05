<?php

include 'layout/header.php';

// Mengecek apakah parameter pencarian telah diberikan


$data_mobil = select("SELECT * FROM mobil");

?>
   
    <div class="container mt-4">
        <h1>Data Mobil</h1>

    <form action="" method="GET" class="mt-2">
        <div class="input-group">
        <input type="text" id="search-input" class="form-control" placeholder="Cari mobil...">
            <div class="input-group-append">
               
            </div>
        </div>
    </form>

        <a href="form-add.php"class="btn btn-primary mt-2">Tambah</a>
    <div id="mobil-table">
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
                <?php $no = 1 ;?>
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

            <script src="jquery.js"></script>
            <script src="search-mobil.js"></script>

            </tbody>

    </table>
    </div>
    </div>
    

<?php include 'layout/footer.php';?>