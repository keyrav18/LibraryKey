<?php 
require "../../config/config.php"; 

$NIMMember = $_GET["id"];
if(deleteMember($NIMMember) > 0) {
    echo "<script>
    alert('Member berhasil dihapus!');
    document.location.href = 'member.php';
    </script>";
  }else {
    echo "<script>
    alert('Member gagal dihapus!');
    document.location.href = 'member.php';
    </script>";
}
?>
