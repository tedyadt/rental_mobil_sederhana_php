<?php
include 'layout/header.php';

if (isset($_GET['id'])) {
    $idTransaksi = $_GET['id'];

    // Hapus data mobil dari database berdasarkan plat mobil
    $query = "DELETE FROM transaksi WHERE id_transaksi = '$idTransaksi'";
    $result = mysqli_query($conn, $query);

    // Setelah berhasil menghapus data, arahkan pengguna kembali ke halaman "index.php" atau tampilkan pesan berhasil
    if ($result && mysqli_affected_rows($conn) > 0) {
        echo '<script>
                alert("Data mobil berhasil dihapus.");
                window.location.href = "transaksi.php";
              </script>';
        exit();
    } else {
        echo "Gagal menghapus data mobil.";
    }
} else {
    echo "Plat mobil tidak ditemukan.";
}

include 'layout/footer.php';
?>