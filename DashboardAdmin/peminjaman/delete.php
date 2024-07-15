<?php
require "../../config/config.php";

if (isset($_GET['id'])) {
    $idPeminjaman = $_GET['id'];

    // Prepare statement to delete the record
    $queryDeletePeminjaman = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
    global $connection;
    $stmt = mysqli_prepare($connection, $queryDeletePeminjaman);
    mysqli_stmt_bind_param($stmt, "i", $idPeminjaman);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>
            alert('Data peminjaman berhasil dihapus!');
            document.location.href = 'peminjamanBuku.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data peminjaman!');
            document.location.href = 'peminjamanBuku.php';
        </script>";
    }

    mysqli_stmt_close($stmt);
} else {
    header("Location: peminjamanBuku.php");
    exit();
}
?>
