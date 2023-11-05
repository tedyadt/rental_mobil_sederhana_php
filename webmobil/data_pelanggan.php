<?php
// menu_data_pelanggan.php
include 'layout/header.php';
// Fungsi untuk melakukan koneksi ke database
function connectDatabase()
{
    $host = "localhost"; // Sesuaikan dengan host database Anda
    $username = "root"; // Sesuaikan dengan username database Anda
    $password = ""; // Sesuaikan dengan password database Anda
    $database = "rental_mobil"; // Sesuaikan dengan nama basis data Anda

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    return $conn;
}

// Fungsi untuk mengambil data pelanggan dari database
function getDataPelanggan()
{
    $conn = connectDatabase();

    $sql = "SELECT * FROM penyewa";
    $result = $conn->query($sql);

    $dataPelanggan = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dataPelanggan[] = $row;
        }
    }

    $conn->close();

    return $dataPelanggan;
}

// Panggil fungsi untuk mengambil data pelanggan
$daftar_pelanggan = getDataPelanggan();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu Data Pelanggan</title>
    <!-- Tambahan kode JavaScript untuk fungsi search -->
    
<body>
<h1 style="text-align: center">Data Pelanggan</h1>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<hr>

<style>
  .search-container {
    text-align: center;
    margin-bottom: 10px;
  }

  .search-container input[type="text"] {
    padding: 5px;
    border: 1px solid #ccc;
    width: 200px;
  }

  .search-container button {
    padding: 5px 10px;
    background: #ccc;
    border: none;
    cursor: pointer;
  }

  .loader {
    display: none;
    width: 100px;
  }
</style>

<?php
// ... (kode sebelumnya tetap tidak berubah)

$search = isset($_GET['search']) ? $_GET['search'] : '';

function filterData($data, $search)
{
  $filteredData = array();

  foreach ($data as $pelanggan) {
    if (stripos($pelanggan['nama_penyewa'], $search) !== false) {
      $filteredData[] = $pelanggan;
    }
  }

  return $filteredData;
}

$data = $daftar_pelanggan; // Menggunakan data pelanggan yang sudah diambil sebelumnya

if (!empty($search)) {
  $data = filterData($data, $search);
}
?>

<div class="search-container">
  <form method="GET" action="">
    <input type="text" name="search" placeholder="Cari nama..." id="search-input">
    <button type="submit" id="search-button"><i class="fas fa-search"></i></button>
    <img src="loading.gif" class="loader" id="loader">
  </form>
</div>

<p id="no-result" style="text-align: center; display: none;">Hasil tidak ada</p>


</head>
<a class="btn btn-sm btn-primary" href="tambah_pelanggan.php">Tambah Data</a>
</div><br>

        <table border="1" class="table table-striped">
        <thead class="thead-dark">
        <tr align=center>
            <th class="border border-dark" scope="col">ID Penyewa</th>
            <th class="border border-dark" scope="col">Nama Penyewa</th>
            <th class="border border-dark" scope="col">Email</th>
            <th class="border border-dark" scope="col">Telepon</th>
            <th class="border border-dark" scope="col">Alamat</th>
            <th class="border border-dark" scope="col">No. KTP</th>
            <th class="border border-dark" scope="col">No. KK</th>
            <th class="border border-dark" scope="col">Aksi</th>
        </tr>
        </thead>
        <?php foreach ($daftar_pelanggan as $pelanggan) : ?>
    <tr align=center>
        <td><?= $pelanggan['id_penyewa']; ?></td>
        <td><?= $pelanggan['nama_penyewa']; ?></td>
        <td><?= $pelanggan['email']; ?></td>
        <td><?= $pelanggan['telp']; ?></td>
        <td><?= $pelanggan['alamat']; ?></td>
        <td><?= $pelanggan['ktp']; ?></td>
        <td><?= $pelanggan['KK']; ?></td>
        <td>
        <a class="btn btn-outline-primary" href="edit_pelanggan.php?id=<?= $pelanggan['id_penyewa']; ?>"><i class="fas fa-edit"></i>Edit</a> |
        <a class="btn btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')" href="hapus_pelanggan.php?id=<?= $pelanggan['id_penyewa']; ?>">Hapus</a>
        </td>
    </tr>
<?php endforeach; ?>
        
    </table>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Fungsi untuk melakukan pencarian
    function search() {
      var keyword = $("#search-input").val().toLowerCase();
      var $tableRows = $(".table tbody tr");

      var $filteredRows = $tableRows.filter(function() {
        return $(this).text().toLowerCase().indexOf(keyword) > -1;
      });

      // Menampilkan atau menyembunyikan hasil pencarian
      $tableRows.hide();
      $filteredRows.show();

      // Menampilkan pesan "hasil tidak ada" jika tidak ada hasil pencarian
      if ($filteredRows.length === 0) {
        $("#no-result").show();
      } else {
        $("#no-result").hide();
      }

      // Mengatur tampilan gambar loader
      $("#loader").show(); // Menampilkan gambar loader

      // Menyembunyikan gambar loader setelah 1 detik
      setTimeout(function() {
        $("#loader").hide();
      }, 1000);
    }

    // Event listener saat tombol pencarian ditekan
    $("#search-button").click(function(e) {
      e.preventDefault(); // Mencegah aksi default form submit
      search();
    });

    // Event listener saat teks input pencarian berubah
    $("#search-input").on("keyup", function() {
      search();
    });
  });
</script>