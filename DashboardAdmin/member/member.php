<?php
session_start();
if(!isset($_SESSION["signIn"]) ) {
    header("Location: ../../sign/admin/sign_in.php");
    exit;
}
require "../../config/config.php";
$member = queryReadData("SELECT * FROM member");
if(isset($_POST["search"]) ) {
    $member = searchMember($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"  rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Member terdaftar</title>
    <style>
        .table-pink {
            background-color: pink; /* Warna pink */
        }
        .table-pink th {
            background-color: #FF69B4; /* Warna pink yang lebih gelap untuk header */
            color: whitesmoke;
        }
        .table-pink tr:nth-child(even) {
            background-color: #FFB6C1; /* Warna pink yang sedikit berbeda untuk baris genap */
        }
    </style>
</head>
<body style="background-color: antiquewhite">
<nav class="navbar fixed-top bg-body-tertiary shadow-sm" >
    <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
            <img src="../../assets/logoNav.png" alt="logo" width="120px">
        </a>

        <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
    </div>
</nav>

<div class="p-4 mt-5">
    <!--search engine --->
    <form action="" method="post" class="mt-5">
        <div class="input-group d-flex justify-content-end mb-3">
            <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari data member...">
            <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
    <caption>List of Member</caption>
    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover table-pink">
            <thead class="text-center">
            <tr>
                <th>NIM</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Semester</th>
                <th>Jurusan</th>
                <th>No Telepon</th>
                <th>Pendaftaran</th>
                <th>Delete</th>
            </tr>
            </thead>
            <?php foreach($member as $item) : ?>
                <tr>
                    <td><?=$item["NIM"];?></td>
                    <td><?=$item["kode_member"];?></td>
                    <td><?=$item["nama_lengkap"];?></td>
                    <td><?=$item["jenis_kelamin"];?></td>
                    <td><?=$item["Semester"];?></td>
                    <td><?=$item["jurusan"];?></td>
                    <td><?=$item["no_tlp"];?></td>
                    <td><?=$item["tgl_pendaftaran"];?></td>
                    <td>
                        <div class="action">
                            <a href="deleteMember.php?id=<?= $item["NIM"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data member ?');"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
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