<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database_name = "perpustakaan";
$connection = mysqli_connect($host, $username, $password, $database_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// === FUNCTION KHUSUS ADMIN START ===

// MENAMPILKAN DATA KATEGORI BUKU
function queryReadData($query) {
    global $connection;
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($connection));
    }
    $items = [];
    while ($item = mysqli_fetch_assoc($result)) {
        $items[] = $item;
    }
    return $items;
}

// Menambahkan data buku
function tambahBuku($dataBuku) {
    global $connection;

    $cover = upload();
    $idBuku = htmlspecialchars($dataBuku["id_buku"]);
    $kategoriBuku = $dataBuku["kategori"];
    $judulBuku = htmlspecialchars($dataBuku["judul"]);
    $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
    $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
    $tahunTerbit = $dataBuku["tahun_terbit"];
    $jumlahHalaman = $dataBuku["jumlah_halaman"];
    $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);

    if (!$cover) {
        return 0;
    }

    $queryInsertDataBuku = "INSERT INTO buku VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $queryInsertDataBuku);
    mysqli_stmt_bind_param($stmt, "sssssssss", $cover, $idBuku, $kategoriBuku, $judulBuku, $pengarangBuku, $penerbitBuku, $tahunTerbit, $jumlahHalaman, $deskripsiBuku);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Function upload gambar
function upload() {
    $namaFile = $_FILES["cover"]["name"];
    $ukuranFile = $_FILES["cover"]["size"];
    $error = $_FILES["cover"]["error"];
    $tmpName = $_FILES["cover"]["tmp_name"];

    if ($error === 4) {
        echo "<script>
        alert('Silahkan upload cover buku terlebih dahulu!');
        </script>";
        return 0;
    }

    $formatGambarValid = ['jpg', 'jpeg', 'png', 'svg', 'bmp', 'psd', 'tiff'];
    $ekstensiGambar = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensiGambar, $formatGambarValid)) {
        echo "<script>
        alert('Format file tidak sesuai');
        </script>";
        return 0;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran file terlalu besar!');
        </script>";
        return 0;
    }

    $namaFileBaru = uniqid() . "." . $ekstensiGambar;
    move_uploaded_file($tmpName, '../../imgDB/' . $namaFileBaru);
    return $namaFileBaru;
}

// MENAMPILKAN SESUATU SESUAI DENGAN INPUTAN USER PADA * SEARCH ENGINE *
function search($keyword) {
    global $connection;
    $querySearch = "SELECT * FROM buku WHERE judul LIKE ? OR kategori LIKE ?";
    $stmt = mysqli_prepare($connection, $querySearch);
    $searchParam = "%$keyword%";
    mysqli_stmt_bind_param($stmt, "ss", $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function searchMember($keyword) {
    global $connection;
    $searchMember = "SELECT * FROM member WHERE NIM LIKE ? OR kode_member LIKE ? OR nama_lengkap LIKE ? OR jurusan LIKE ?";
    $stmt = mysqli_prepare($connection, $searchMember);
    $searchParam = "%$keyword%";
    mysqli_stmt_bind_param($stmt, "ssss", $searchParam, $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// DELETE DATA Buku
function delete($bukuId) {
    global $connection;
    $queryDeleteBuku = "DELETE FROM buku WHERE id_buku = ?";
    $stmt = mysqli_prepare($connection, $queryDeleteBuku);
    mysqli_stmt_bind_param($stmt, "s", $bukuId);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// UPDATE || EDIT DATA BUKU
function updateBuku($dataBuku) {
    global $connection;

    $gambarLama = htmlspecialchars($dataBuku["coverLama"]);
    $idBuku = htmlspecialchars($dataBuku["id_buku"]);
    $kategoriBuku = $dataBuku["kategori"];
    $judulBuku = htmlspecialchars($dataBuku["judul"]);
    $pengarangBuku = htmlspecialchars($dataBuku["pengarang"]);
    $penerbitBuku = htmlspecialchars($dataBuku["penerbit"]);
    $tahunTerbit = $dataBuku["tahun_terbit"];
    $jumlahHalaman = $dataBuku["jumlah_halaman"];
    $deskripsiBuku = htmlspecialchars($dataBuku["buku_deskripsi"]);

    if ($_FILES["cover"]["error"] === 4) {
        $cover = $gambarLama;
    } else {
        $cover = upload();
    }

    $queryUpdate = "UPDATE buku SET 
        cover = ?, id_buku = ?, kategori = ?, judul = ?, pengarang = ?, 
        penerbit = ?, tahun_terbit = ?, jumlah_halaman = ?, buku_deskripsi = ?
        WHERE id_buku = ?";

    $stmt = mysqli_prepare($connection, $queryUpdate);
    mysqli_stmt_bind_param($stmt, "ssssssssss", $cover, $idBuku, $kategoriBuku, $judulBuku, $pengarangBuku, $penerbitBuku, $tahunTerbit, $jumlahHalaman, $deskripsiBuku, $idBuku);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Hapus member yang terdaftar
function deleteMember($NIMMember) {
    global $connection;
    $deleteMember = "DELETE FROM member WHERE NIM = ?";
    $stmt = mysqli_prepare($connection, $deleteMember);
    mysqli_stmt_bind_param($stmt, "s", $NIMMember);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Hapus history pengembalian data BUKU
function deleteDataPengembalian($idPengembalian) {
    global $connection;
    $deleteDataPengembalianBuku = "DELETE FROM pengembalian WHERE id_pengembalian = ?";
    $stmt = mysqli_prepare($connection, $deleteDataPengembalianBuku);
    mysqli_stmt_bind_param($stmt, "i", $idPengembalian);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// === FUNCTION KHUSUS ADMIN END ===

// === FUNCTION KHUSUS MEMBER START ===
// Peminjaman BUKU
function pinjamBuku($dataBuku) {
    global $connection;

    $idBuku = $dataBuku["id_buku"];
    $NIM = $dataBuku["NIM"];
    $idAdmin = isset($dataBuku["id"]) ? $dataBuku["id"] : null;
    $tglPinjam = $dataBuku["tgl_peminjaman"];
    $tglKembali = $dataBuku["tgl_pengembalian"];

    // Perbaikan pada prepared statement
    $cekDenda = mysqli_prepare($connection, "SELECT denda FROM pengembalian WHERE NIM = ? AND denda > 0");
    mysqli_stmt_bind_param($cekDenda, "s", $NIM);
    mysqli_stmt_execute($cekDenda);
    $result = mysqli_stmt_get_result($cekDenda);

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);
        $jumlahDenda = $item["denda"];
        if ($jumlahDenda > 0) {
            echo "<script>
                alert('Anda belum melunasi denda, silahkan lakukan pembayaran terlebih dahulu !');
            </script>";
            return 0;
        }
    }

    // Perbaikan pada prepared statement
    $NIMResult = mysqli_prepare($connection, "SELECT NIM FROM peminjaman WHERE NIM = ?");
    mysqli_stmt_bind_param($NIMResult, "s", $NIM);
    mysqli_stmt_execute($NIMResult);
    $result = mysqli_stmt_get_result($NIMResult);

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Anda sudah meminjam buku, Harap kembalikan dahulu buku yg anda pinjam!');
        </script>";
        return 0;
    }

    $queryPinjam = "INSERT INTO peminjaman (id_buku, NIM, id_admin, tgl_peminjaman, tgl_pengembalian) VALUES(?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $queryPinjam);
    mysqli_stmt_bind_param($stmt, "sssss", $idBuku, $NIM, $idAdmin, $tglPinjam, $tglKembali);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Bayar denda
function bayarDenda($data) {
    global $connection;
    $idPengembalian = $data["id_pengembalian"];
    $jmlDenda = $data["denda"];
    $jmlDibayar = $data["bayarDenda"];
    $calculate = $jmlDenda - $jmlDibayar;

    $bayarDenda = "UPDATE pengembalian SET denda = ? WHERE id_pengembalian = ?";
    $stmt = mysqli_prepare($connection, $bayarDenda);
    mysqli_stmt_bind_param($stmt, "di", $calculate, $idPengembalian);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Pengembalian BUKU
function pengembalian($dataBuku) {
    global $connection;

    $idPeminjaman = $dataBuku["id_peminjaman"];
    $idBuku = $dataBuku["id_buku"];
    $NIM = $dataBuku["NIM"];
    $idAdmin = $dataBuku["id_admin"];
    $tglPengembalian = isset($dataBuku["tgl_pengembalian"]) ? $dataBuku["tgl_pengembalian"] : date('Y-m-d'); // Default to today's date if not set
    $keterlambatan = $dataBuku["keterlambatan"];
    $denda = $dataBuku["denda"];

    // Periksa apakah id_admin valid
    $checkAdmin = mysqli_prepare($connection, "SELECT id FROM admin WHERE id = ?");
    mysqli_stmt_bind_param($checkAdmin, "i", $idAdmin);
    mysqli_stmt_execute($checkAdmin);
    $adminResult = mysqli_stmt_get_result($checkAdmin);

    if (mysqli_num_rows($adminResult) == 0) {
        die("Error: Invalid admin ID");
    }

    $queryPengembalian = "INSERT INTO pengembalian (id_peminjaman, id_buku, NIM, id_admin, buku_kembali, keterlambatan, denda) VALUES(?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $queryPengembalian);
    mysqli_stmt_bind_param($stmt, "issiisi", $idPeminjaman, $idBuku, $NIM, $idAdmin, $tglPengembalian, $keterlambatan, $denda);

    if (!mysqli_stmt_execute($stmt)) {
        die("Execute failed: (" . mysqli_stmt_errno($stmt) . ") " . mysqli_stmt_error($stmt));
    }

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $queryDelete = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
        $stmtDelete = mysqli_prepare($connection, $queryDelete);
        mysqli_stmt_bind_param($stmtDelete, "i", $idPeminjaman);
        mysqli_stmt_execute($stmtDelete);
    }
    return mysqli_stmt_affected_rows($stmt);
}

// Menampilkan Buku yang tersedia pada halaman MEMBER
function showBookList($queryRead) {
    global $connection;
    $result = mysqli_query($connection, $queryRead);
    if (!$result) {
        die("Query error: " . mysqli_error($connection));
    }
    $items = [];
    while ($item = mysqli_fetch_assoc($result)) {
        $items[] = $item;
    }
    return $items;
}

// === FUNCTION KHUSUS MEMBER END ===

// Menampilkan seluruh data pada dashboard admin (dataBuku)
function queryReadAllData($query) {
    global $connection;
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Query error: " . mysqli_error($connection));
    }
    $items = [];
    while ($item = mysqli_fetch_assoc($result)) {
        $items[] = $item;
    }
    return $items;
}

// === FUNCTION TAMBAHAN START ===
// Hitung jumlah hari terlambat
function calculateLateDays($dueDate, $returnDate) {
    $dueDateTimestamp = strtotime($dueDate);
    $returnDateTimestamp = strtotime($returnDate);
    $lateDays = ($returnDateTimestamp - $dueDateTimestamp) / (60 * 60 * 24);
    return ($lateDays > 0) ? $lateDays : 0;
}
// === FUNCTION TAMBAHAN END ===
?>
