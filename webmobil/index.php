<?php
  // Memeriksa apakah pengguna telah mengirimkan data login
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai yang dikirimkan dari form
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Jika login berhasil, redirect ke halaman lain
    if ($email == "jawir@gmail.com" && $password == "123") {
      header("Location: home.php");
      exit();
    } else {
      // Jika login gagal, tampilkan pesan error
      $error_message = "Email atau password salah";
    }
  }

  
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        


        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form style="width: 23rem;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <h1 class="fw-normal mb-6 pb-5" style="letter-spacing: 1px;">Log in</h1>

            <?php
              if (isset($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
              }
            ?>

            <div class="form-outline mb-4">
              <input type="email" id="form2Example18" class="form-control form-control-lg" name="email" required placeholder="Email address" />
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="form2Example28" class="form-control form-control-lg" name="password" required placeholder="Password" />
            </div>
            
            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
            </div>  
          </form>

        </div>

      </div>
      <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="img3.webp"
          alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
      </div>
    </div>
  </div>
</section>

<?php include 'layout/footer.php'; ?>

    



?>