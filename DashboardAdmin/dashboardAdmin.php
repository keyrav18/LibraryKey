<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../sign/admin/sign_in.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Admin Dashboard</title>
  </head>
  <body>
    
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
      <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
          <img src="../assets/logoNav.png" alt="logo" width="120px">
        </a>
  
        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/adminLogo.png" alt="adminLogo" width="40px">
          </button>
        <ul style="margin-left: -7rem;" class="dropdown-menu position-absolute mt-2 p-2">
          <li>
            <a class="dropdown-item text-center" href="#">
            <img src="../assets/adminLogo.png" alt="adminLogo" width="30px">
            </a>
          </li>
          <li>
            <a class="dropdown-item text-center text-secondary" href="#"> <span class="text-capitalize"><?php echo $_SESSION['admin']['nama_admin']; ?></a>
            </span>
          </li>
          <hr>
          <li>
            <a class="dropdown-item text-center mb-2" href="#">Akun Terverifikasi <span class="text-primary"><i class="fa-solid fa-circle-check"></i></span></a>
          </li>
          <li>
            <a class="dropdown-item text-center p-2 bg-danger text-light rounded" href="signOut.php">Sign Out <i class="fa-solid fa-right-to-bracket"></i></a>
          </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="mt-5 p-4" ; style="background-color: antiquewhite">
      <?php
      // Mendapatkan tanggal dan waktu saat ini
      $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
      // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
      $day = date('l');
      // Mendapatkan tanggal dalam format 1 hingga 31
      $dayOfMonth = date('d');
      // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
      $month = date('F');
      // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
      $year = date('Y');
      ?>

      <h1 class="mt-5 fw-bold">Dashboard - <span class="fs-4 text-secondary"> <?php echo $day. " ". $dayOfMonth." ". " ". $month. " ". $year; ?> </span></h1>
    
      <div class="alert alert-success" style="background-color: hotpink; border: none" role="alert">Selamat datang admin - <span class="fw-bold text-capitalize"><?php echo $_SESSION['admin']['nama_admin']; ?></span> di Dashboard KeyLibrary</div>
      
      <div class="mt-4 p-3">

        <div class="d-flex flex-wrap justify-content-center gap-2">
        <div class="cardImg">
          <a href="member/member.php">
            <img src="../assets/dashboardCardMember/member.png" alt="member" style="max-width: 100%;" width="600px">
          </a>
        </div>
        <div class="cardImg">
          <a href="buku/daftarBuku.php">
          <img src="../assets/dashboardCardMember/bukuAdmin.png" alt="daftar buku" style="max-width: 100%;" width="600px">
          </a>
        </div>

        <div class="cardImg">
          <a href="peminjaman/peminjamanBuku.php">
            <img src="../assets/dashboardCardMember/peminjaman.png" alt="peminjaman buku" style="max-width: 100%;" width="600px">
          </a>
        </div>
        <div class="cardImg">
          <a href="pengembalian/pengembalianBuku.php">
          <img src="../assets/dashboardCardMember/pengembalianAdmin.png" alt="pengembalian buku" style="max-width: 100%;" width="600px" height="300px">
          </a>
        </div>
      
         <div class="cardImg">
           <a href="denda/daftarDenda.php">
           <img src="../assets/dashboardCardMember/denda.png" alt="daftar denda" style="max-width: 100%;" width="600px">
           </a>
         </div>
        </div>

      </div>
      
    </div>

    <footer class="shadow-lg bg-subtle p-3" style="background-color: whitesmoke">
        <div class="container-fluid d-flex justify-content-between">
            <p class="mt-2">Created by <a href="https://www.instagram.com/keylazlika/" class="text-primary"> Kayla Nazelika </a></p>
            <p class="mt-2">Tehnik Informatika 2022
            </p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>