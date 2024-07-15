<?php
//Halaman pengelolaan pengembalian Buku Perustakaaan
require "../../config/config.php";
$dataPeminjam = queryReadData("SELECT pengembalian.id_pengembalian, pengembalian.id_buku, buku.judul, buku.kategori, pengembalian.NIM, member.nama_lengkap, member.Semester, member.jurusan, admin.nama_admin, pengembalian.buku_kembali, pengembalian.keterlambatan, pengembalian.denda
FROM pengembalian
INNER JOIN buku ON pengembalian.id_buku = buku.id_buku
INNER JOIN member ON pengembalian.NIM = member.NIM
INNER JOIN admin ON pengembalian.id_admin = admin.id")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: antiquewhite;
        }
        .table-pink {
            background-color: #ffe4e1;
        }
        .table-pink th {
            background-color: #ff69b4;
            color: whitesmoke;
        }
        .table-pink td, .table-pink th {
            border-color: #ff69b4;
        }
    </style>
    <title>Kelola pengembalian buku || admin</title>
</head>
<body>

<nav class="navbar fixed-top bg-body-tertiary shadow-sm">
    <div class="container-fluid p-3">
        <a class="navbar-brand" href="#">
            <img src="../../assets/logoNav.png" alt="logo" width="120px">
        </a>

        <a class="btn btn-tertiary" href="../dashboardAdmin.php">Dashboard</a>
    </div>
</nav>

<div class="p-4 mt-5">
    <div class="mt-5">
        <caption>List of pengembalian</caption>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover table-pink">
                <thead class="text-center">
                <tr>
                    <th>Id Pengembalian</th>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>Kategori</th>
                    <th>NIM</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Nama Admin</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Keterlambatan</th>
                    <th>Denda</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <?php foreach ($dataPeminjam as $item) : ?>
                    <tr>
                        <td><?= $item["id_pengembalian"]; ?></td>
                        <td><?= $item["id_buku"]; ?></td>
                        <td><?= $item["judul"]; ?></td>
                        <td><?= $item["kategori"]; ?></td>
                        <td><?= $item["NIM"]; ?></td>
                        <td><?= $item["nama_lengkap"]; ?></td>
                        <td><?= $item["NIM"]; ?></td>
                        <td><?= $item["jurusan"]; ?></td>
                        <td><?= $item["nama_admin"]; ?></td>
                        <td><?= $item["buku_kembali"]; ?></td>
                        <td><?= $item["keterlambatan"]; ?></td>
                        <td><?= $item["denda"]; ?></td>
                        <td>
                            <div class="action">
                                <a href="deletePengembalian.php?id=<?= $item["id_pengembalian"]; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ?');"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
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