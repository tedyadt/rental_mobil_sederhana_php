<?php
  // Memulai session
  session_start();

  // Jika parameter "confirm" bernilai true
  if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    // Menghapus semua data session
    session_destroy();

    // Mengarahkan pengguna ke halaman login
    header("Location: index.php");
    exit();
  }
?>

