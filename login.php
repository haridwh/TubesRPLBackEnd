<?php
  session_start();
  $error = '';
  if (isset($_POST['submit'])){
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $error = "Form tidak boleh kosong!";
    }else{
      include 'database.php';
      $username=$_POST['username'];
      $password=$_POST['password'];
      $type=$_POST['type'];
      $username=mysql_real_escape_string(stripslashes($username));
      $password=mysql_real_escape_string(stripslashes($password));
      switch ($type) {
        case 'adm':
          $query = "SELECT nama_admin, id_admin FROM LOGIN
            JOIN ADMIN_SA ON (LOGIN.IDLOGIN = ADMIN_SA.IDLOGIN)
            WHERE LOGIN.IDLOGIN='$username' AND password='$password'";
          $result = mysqli_query($con,$query);
          if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['status']=1;
            $_SESSION['username']=$username;
            $_SESSION['namaAdmin']=$row['nama_admin'];
            $_SESSION['idAdmin']=$row['id_admin'];
            $_SESSION['type']=$type;
            header("location:home.php");
          }else {
            $error = "Username atau password salah!";
          }
          break;
        case 'dsn':
          $query = "SELECT nama_dosen, kode_dosen, keahlian FROM LOGIN
            JOIN DOSEN ON (LOGIN.IDLOGIN = DOSEN.IDLOGIN)
            WHERE LOGIN.IDLOGIN='$username' AND password='$password'";
          $result = mysqli_query($con,$query);
          if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['status']=1;
            $_SESSION['username']=$username;
            $_SESSION['namaDosen']=$row['nama_dosen'];
            $_SESSION['kodeDosen']=$row['kode_dosen'];
            $_SESSION['keahlian']=$row['keahlian'];
            $_SESSION['type']=$type;
            header("location:home.php");
          }else {
            $error = "Username atau password salah!";
          }
          break;
        case 'mhs':
          $query = "SELECT namamhs, nim FROM LOGIN
            JOIN MAHASISWA ON (LOGIN.IDLOGIN = MAHASISWA.IDLOGIN)
            WHERE LOGIN.IDLOGIN='$username' AND password='$password'";
          $result = mysqli_query($con,$query);
          if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['status']=1;
            $_SESSION['username']=$username;
            $_SESSION['namamhs']=$row['namamhs'];
            $_SESSION['nim']=$row['nim'];
            $_SESSION['type']=$type;
            header("location:home.php");
          }else {
            $error = "Username atau password salah!";
          }
          break;
        default:
          break;
      }
      mysqli_close($con);
    }
  }
 ?>
