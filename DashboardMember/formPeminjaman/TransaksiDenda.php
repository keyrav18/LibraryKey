<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
  header("Location: ../../sign/member/sign_in.php");
  exit;
}
require "../../config/config.php";
$NIMSiswa = $_SESSION["member"]["NIM"];
$dataDenda = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_peminjaman, pengembalian.id_buku, buku.judul, pengembalian.NIM, member.nama_lengkap, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.NIM = member.NIM
INNER JOIN admin ON pengembalian.id_admin = admin.id
WHERE pengembalian.NIM = $NIMSiswa && pengembalian.denda > 0");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
     <title>Transaksi Denda Buku || Member</title>
      <style>
          .table-pink {
              width: 100%;
              border-collapse: collapse;
          }
          .table-pink th, .table-pink td {
              padding: 12px;
              text-align: left;
              border: none;
          }
          .table-pink th {
              background-color: #FF69B4;
              color: whitesmoke;
          }
          .table-pink tr {
              background-color: #FFC0CB;
          }
          .table-pink tr:nth-child(even) {
              background-color: #FFB6C1;
          }
      </style>
  </head>
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
    <div class="mt-5" role="alert">Riwayat transaksi Denda Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama_lengkap"]); ?></span></div>

  <div class="table-responsive mt-3">
    <table class="table table-striped table-hover table-pink">
      <thead class="text-center">
      <tr>
        <th>id buku</th>
        <th>Judul buku</th>
        <th>NIM</th>
        <th>Nama siswa</th>
        <th>Nama admin</th>
        <th>Hari pengembalian</th>
        <th>Keterlambatan</th>
        <th>Denda</th>
        <th>Action</th>
      </tr>
      <thead class="text-center">
        <?php foreach ($dataDenda as $item) : ?>
      <tr>
        <td><?= $item["id_buku"]; ?></td>
        <td><?= $item["judul"]; ?></td>
        <td><?= $item["NIM"]; ?></td>
        <td><?= $item["nama_lengkap"]; ?></td>
        <td><?= $item["nama_admin"]; ?></td>
        <td><?= $item["buku_kembali"]; ?></td>
        <td><?= $item["keterlambatan"]; ?></td>
        <td><?= $item["denda"]; ?></td>
        <td>
          <a class="btn btn-success" href="formBayarDenda.php?id=<?= $item["id_pengembalian"]; ?>">Bayar</a>
        </td>
      </tr>
        <?php endforeach; ?>
    </table>
    </div>
  </div>

    <footer class="fixed-bottom shadow-lg bg-subtle p-3" style="background-color: whitesmoke">
        <div class="container-fluid d-flex justify-content-between">
            <p class="mt-2">Created by <a href="https://www.instagram.com/keylazlika/" class="text-primary"> Kayla Nazelika</a> ©️2022</p>
            <p class="mt-2">Teknik Informatika 2022</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>