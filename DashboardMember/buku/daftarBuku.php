<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}

require "../../config/config.php";
// query read semua buku
$buku = queryReadData("SELECT * FROM buku");
//search buku
if(isset($_POST["search"]) ) {
  $buku = search($_POST["keyword"]);
}
//read buku informatika
if(isset($_POST["informatika"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'informatika'");
}
//read buku bisnis
if(isset($_POST["bisnis"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'bisnis'");
}
//read buku filsafat
if(isset($_POST["filsafat"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'filsafat'");
}
//read buku novel
if(isset($_POST["novel"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'novel'");
}
//read buku sains
if(isset($_POST["sains"]) ) {
$buku = queryReadData("SELECT * FROM buku WHERE kategori = 'sains'");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Daftar Buku || Member</title>
      <style>

          /*untuk seluruh button genre*/
          .layout-card-custom .btn-primary {
              background-color: deeppink;
              border-color: deeppink;
              color: white;
          }

          /*untuk seluruh button detail pada form*/
          .layout-card-custom .btn {
              background-color: deeppink;
              border-color: deeppink;
              color: white;
          }

          .layout-card-custom .btn:hover {
              background-color: white;
              border-color: deeppink;
              color: deeppink;

          }

          /*untuk seluruh button judul genre*/
          .layout-card-custom .btn-outline-primary {
              background-color: white;
              border-color: deeppink;
              color: deeppink;
          }

          .layout-card-custom .btn-outline-primary:hover {
              background-color: deeppink;
              border-color: deeppink;
              color: white;
          }


      </style>
  </head>
  <style>
    .layout-card-custom {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1.5rem;
    }
  </style>
  <body style="background-color: antiquewhite">
    <nav class="navbar fixed-top bg-body-tertiary shadow-sm">
      <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
          <img src="../../assets/logoNav.png" alt="logo" width="120px">
        </a>
        
        <a class="btn btn-tertiary" href="../dashboardMember.php">Dashboard</a>
      </div>
    </nav>
    
     <div class="p-4 mt-5">
       <!--Btn filter data kategori buku-->
      <div class="d-flex gap-2 mt-5 justify-content-center">
      <form action="" method="post">
        <div class="layout-card-custom">
         <button class="btn btn-primary" type="submit">Semua Genre</button>
         <button type="submit" name="informatika" class="btn btn-outline-primary">Informatika</button>
         <button type="submit" name="bisnis" class="btn btn-outline-primary">Bisnis</button>
         <button type="submit" name="filsafat" class="btn btn-outline-primary">Filsafat</button>
         <button type="submit" name="novel" class="btn btn-outline-primary">Novel</button>
         <button type="submit" name="sains" class="btn btn-outline-primary">Sains</button>
         </div>
        </form>
       </div>
       
       <form action="" method="post" class="mt-5">
       <div class="input-group d-flex justify-content-end mb-3">
         <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari judul atau kategori buku...">
         <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
       </div>
      </form>
      
      <!--Card buku-->
    <div class="layout-card-custom">
       <?php foreach ($buku as $item) : ?>
       <div class="card" style="width: 15rem;">
         <img src="../../imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="250px">
         <div class="card-body">
           <h5 class="card-title"><?= $item["judul"]; ?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Kategori : <?= $item["kategori"]; ?></li>
          </ul>
        <div class="card-body">
          <a class="btn btn-success" href="detailBuku.php?id=<?= $item["id_buku"]; ?>">Detail</a>
          </div>
        </div>
       <?php endforeach; ?>
      </div>
      
     </div>

    <footer class="shadow-lg bg-subtle p-3" style="background-color: whitesmoke">
        <div class="container-fluid d-flex justify-content-between">
            <p class="mt-2">Created by <a href="https://www.instagram.com/keylazlika/" class="text-primary"> Kayla Nazelika </a></p>
            <p class="mt-2">Teknik Informatika 2022
            </p>
        </div>
    </footer>
      
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    </body>
    </html>