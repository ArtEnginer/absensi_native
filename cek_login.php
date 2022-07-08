<?php
session_start();
include 'database/sql.php';
$username = $_POST['username'];
$password = md5($_POST['password']);

$cek = mysqli_query($konek, "SELECT * FROM tb_user
INNER JOIN pegawai ON pegawai.id_user = tb_user.id_user
WHERE username='$username' AND password='$password'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);

if ($result > 0) {
  if ($data['peran'] == 'admin') {

    $_SESSION['username'] = $data['username'];
    $_SESSION['peran'] = $data['peran'];
    $_SESSION['id_pegawai'] = $data['id_pegawai'];
    $_SESSION['nm_pegawai'] = $data['nm_pegawai'];

    echo "<script>alert('Selamat Datang, Admin.');document.location.href='index.php?page=home'</script>";
  } else if ($data['peran'] == 'user') {

    $_SESSION['id_pegawai'] = $data['id_pegawai'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['peran'] = $data['peran'];
    $_SESSION['nm_pegawai'] = $data['nm_pegawai'];
    echo "<script>alert('Selamat Datang, user.');document.location.href='index.php?page=home'</script>";
  } else if ($data['peran'] == 'pimpinan') {

    $_SESSION['id_pegawai'] = $data['id_pegawai'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['peran'] = $data['peran'];
    $_SESSION['nm_pegawai'] = $data['nm_pegawai'];
    echo "<script>alert('Selamat Datang, pimpinan.');document.location.href='index.php?page=home'</script>";
  } else if ($data['peran'] == 'mahasiswa') {

    $_SESSION['id_pegawai'] = $data['id_pegawai'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['peran'] = $data['peran'];
    $_SESSION['nm_pegawai'] = $data['nm_pegawai'];
    echo "<script>alert('Selamat Datang, Mahasiswa.');document.location.href='index.php?page=home'</script>";
  } else {
    header("location:login_view.php?pesan=gagal");
  }
} else {
  header("location:login_view.php?pesan=gagal");
}
