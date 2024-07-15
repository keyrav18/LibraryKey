<?php
// FILE LOGIN SYSTEM 
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "perpustakaan";
$connect = mysqli_connect($host, $username, $password, $database);


/* SIGN UP Member */
function signUp($data) {
  global $connect;
  
  $NIM = htmlspecialchars($data["NIM"]);
  $kode_member= htmlspecialchars($data["kode_member"]);
  $nama_lengkap = htmlspecialchars(strtolower($data["nama_lengkap"]));
  $password = mysqli_real_escape_string($connect, $data["password"]);
  $confirmPw = mysqli_real_escape_string($connect, $data["confirmPw"]);
  $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
  $kelas = htmlspecialchars($data["Semester"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $noTlp = htmlspecialchars($data["no_tlp"]);
  $tglDaftar = $data["tgl_pendaftaran"];
  
    // cek NIM sudah ada / belum
  $NIMResult = mysqli_query($connect, "SELECT NIM FROM member WHERE NIM = $NIM");
  if(mysqli_fetch_assoc($NIMResult)) {
    echo "<script>
    alert('NIM sudah terdaftar, silahkan gunakan NIM lain!');
    </script>";
    return 0;
  }
  
  //cek kodeMember sudah ada / belum
  $kode_memberResult = mysqli_query($connect, "SELECT kode_member FROM member WHERE kode_member = '$kode_member'");
  if(mysqli_fetch_assoc($kode_memberResult)){
    echo "<script>
    alert('Kode member telah terdaftar, silahkan gunakan kode member lain!');
    </script>";
    return 0;
  }
  
  // Pengecekan kesamaan confirm password dan password
  if($password !== $confirmPw) {
    echo "<script>
    alert('password / confirm password tidak sesuai');
    </script>";
    return 0;
  }
  
  // Enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);
  
  
  $querySignUp = "INSERT INTO member VALUES($NIM, '$kode_member', '$nama_lengkap', '$password', '$jenis_kelamin', '$kelas', '$jurusan', '$noTlp', '$tglDaftar')";
  mysqli_query($connect, $querySignUp);
  return mysqli_affected_rows($connect);
  
}

?>
