<?php
require "../../config/config.php";
$dataPeminjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.NIM, member.nama_lengkap, member.jenis_kelamin,member.Semester, member.jurusan, member.no_tlp,peminjaman.id_admin,  peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian
FROM peminjaman 
INNER JOIN member ON peminjaman.NIM = member.NIM
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Kelola peminjaman buku || admin</title>
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
<body style="background-color: #FFEFD5;">
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
        <caption>List of Member</caption>
        <div class="table-responsive mt-3">
            <table class="table table-pink">
                <thead>
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
                <tbody>
                <?php foreach ($dataPeminjam as $item) : ?>
                    <tr>
                        <td><?= $item["NIM"]; ?></td>
                        <td><?= $item["id_buku"]; ?></td>
                        <td><?= $item["nama_lengkap"]; ?></td>
                        <td><?= $item["jenis_kelamin"];?></td>
                        <td><?= $item["Semester"]; ?></td>
                        <td><?= $item["jurusan"]; ?></td>
                        <td><?= $item["no_tlp"]?></td>
                        <td><?= $item["tgl_peminjaman"]; ?></td>
                        <td>
                            <a href="delete.php?id=<?= $item['id_peminjaman']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
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
