<?php
include 'layout/header.php';

$data_riwayat = select("SELECT * FROM transaksi");

?>

<div class="container mt-4">
    <h1>Riwayat Transaksi</h1>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Nama Mobil</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Harga Total</th>
                <th>Keterangan Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_riwayat as $trs) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $trs['nama_penyewa'] ?></td>
                    <td><?= $trs['nama_mobil'] ?></td>
                    <td><?= $trs['tgl_pinjam'] ?></td>
                    <td><?= $trs['tgl_kembali'] ?></td>
                    <td><?= $trs['harga_rental'] ?></td>
                    <td><?= keterangan_waktu($trs['timestamp']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
// Function untuk mendapatkan keterangan waktu (hari ini, 2 hari lalu, seminggu yang lalu, dll.)
function keterangan_waktu($timestamp)
{
    date_default_timezone_set('Asia/Jakarta');
    $today = strtotime(date("Y-m-d"));
    $timestamp = strtotime($timestamp);

    echo "Waktu Pemesanan: " . date("Y-m-d H:i:s", $timestamp) . "<br>"; // Cetak nilai timestamp untuk pemeriksaan

    /*$difference = $today - $timestamp;
    $days = floor($difference / (60 * 60 * 24));

     if ($days == 0) {
        return 'Hari ini';
    } elseif ($days == 1) {
        return 'Kemarin';
    } elseif ($days == 2) {
        return '2 hari lalu';
    } elseif ($days >= 3 && $days <= 6) {
        return $days . ' hari lalu';
    } elseif ($days >= 7) {
        $weeks = floor($days / 7);
        if ($weeks == 1) {
            return '1 minggu lalu';
        } else {
            return $weeks . ' minggu lalu';
        }
    } else {
        return 'Kurang dari seminggu lalu';
    }*/
}
?>
