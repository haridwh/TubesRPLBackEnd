<?php
  session_start();
  if (!($_SESSION['status'])) {
    header("location: index.php");
  }
  if ($_SESSION['type'] != 'dsn') {
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
        echo "Nama Dosen : ",$_SESSION['namaDosen'],"<br>";
        echo "Kode Dosen : ",$_SESSION['kodeDosen'],"<br>";
        echo "Keahlian   : ",$_SESSION['keahlian'],"<br>";
      ?>
      <a href="inputNilai.php">Input Nilai</a><br>
      <a href="logout.php" style="font-size:18px">Logout</a>
  </body>
</html>
