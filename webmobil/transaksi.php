<?php

include 'layout/header.php';

$data_transaksi = select("SELECT * FROM transaksi");

?>

<div class="container mt-4">
        <h1>Data Transaksi</h1>

    <form action="" method="GET" class="mt-2">
        <div class="input-group">
        <input type="text" id="search-input" class="form-control" placeholder="Cari data transaksi...">
            <div class="input-group-append">
               
            </div>
        </div>
    </form>

        <a href="add-transaksi.php"class="btn btn-primary mt-2">Tambah</a>
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
            
            <script src="jquery.js"></script>
            <script src="search-transaksi.js"></script>
            
            </tbody>

    </table>
    </div>
    </div>