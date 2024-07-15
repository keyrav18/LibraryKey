<?php
session_start();

if(!isset($_SESSION["signIn"]) ) {
    header("Location: ../../sign/member/sign_in.php");
    exit;
}
require "../../config/config.php";
$akunmember = $_SESSION["member"]["NIM"];
$dataPinjam = queryReadData("SELECT peminjaman.id_peminjaman, peminjaman.id_buku, buku.judul, peminjaman.NIM, member.nama_lengkap, admin.nama_admin, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian
FROM peminjaman
INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN member ON peminjaman.NIM = member.NIM
INNER JOIN admin ON peminjaman.id_admin = admin.id
WHERE peminjaman.NIM = $akunmember");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Transaksi peminjaman Buku || Member</title>
    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        .table-pink {
            width: 100%;
            border-collapse: collapse;
        }
        .table-pink th, .table-pink td {
            padding: 12px;
            text-align: left;
        }
        .table-pink th {
            background-color: #FF69B4;
            color: white;
        }
        .table-pink tr {
            background-color: white;
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

<div class="wrapper">
    <div class="content p-4 mt-5">
        <div class="mt-5" role="alert">Riwayat transaksi Peminjaman Buku Anda - <span class="fw-bold text-capitalize"><?php echo htmlentities($_SESSION["member"]["nama_lengkap"]); ?></span></div>
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover table-pink">
                <thead class="text-center">
                <tr>
                    <th>Id Peminjaman</th>
                    <th>Id Buku</th>
                    <th>Judul Buku</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Nama Admin</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($dataPinjam as $item) : ?>
                    <tr>
                        <td><?= $item["id_peminjaman"]; ?></td>
                        <td><?= $item["id_buku"]; ?></td>
                        <td><?= $item["judul"]; ?></td>
                        <td><?= $item["NIM"]; ?></td>
                        <td><?= $item["nama_lengkap"]; ?></td>
                        <td><?= $item["nama_admin"]; ?></td>
                        <td><?= $item["tgl_peminjaman"]; ?></td>
                        <td><?= $item["tgl_pengembalian"]; ?></td>
                        <td>
                            <a class="btn btn-success" style="background-color: blue; border-color: blue" href="pengembalianBuku.php?id=<?= $item["id_peminjaman"]; ?>">Kembalikan</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="shadow-lg bg-subtle p-3" style="background-color: whitesmoke">
        <div class="container-fluid d-flex justify-content-between">
            <p class="mt-2">Created by <a href="https://www.instagram.com/keylazlika/" class="text-primary">Kayla Nazelika</a></p>
            <p class="mt-2">Teknik Informatika 2022</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>