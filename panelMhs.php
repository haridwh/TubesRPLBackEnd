<?php
  session_start();
  if (!$_SESSION['status']) {
    header("location: index.php");
  }
  if($_SESSION['type'] != 'mhs'){
    header("location: home.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
    <?php
      echo "Nama Mahasiswa : ",$_SESSION['namamhs'],"<br>";
      echo "NIM : ",$_SESSION['nim'];
    ?><br>
    <a href="lihatNilai.php" style="font-size:18px">Lihat Nilai</a><br>
    <a href="logout.php" style="font-size:18px">Logout</a>
  </body>
</html>
