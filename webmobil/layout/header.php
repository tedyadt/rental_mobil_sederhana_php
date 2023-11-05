<?php   

include 'koneksi.php';

function select($query){

    global $conn;

    $result = mysqli_query($conn,$query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script>
    // Fungsi untuk menampilkan dialog konfirmasi saat tombol logout ditekan
    function confirmLogout() {
      var confirmation = confirm("Apakah Anda ingin logout?");
      if (confirmation) {
        // Jika pengguna memilih "Ya", maka arahkan ke logout.php dengan parameter confirm=true
        window.location.href = "logout.php?confirm=true";
      } else {
        // Jika pengguna memilih "Tidak", batalkan tindakan logout
        // Anda dapat menghapus baris di bawah ini jika Anda ingin tetap memberikan opsi logout tanpa memerlukan konfirmasi.
        alert("Logout dibatalkan.");
      }
    }
  </script>
 
  </head>


  <body>

  <div>
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
      <div class="container">
        <a class="navbar-brand" href="home.php">Rental Mobil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="data-mobil.php">Data Mobil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="data_pelanggan.php">Data Pelanggan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="transaksi.php">Transaksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="riwayat-trs.php">Riwayat Transaksi</a>
            </li>
          </ul>
          <button onclick="confirmLogout()" class="btn btn-danger">Logout</button>

        </div>
      </div>
    </nav>
  </div>
</body>

</nav>
</div>