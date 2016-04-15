<?php
  session_start();
  if (!($_SESSION['status'])) {
    header("location: index.php");
  }
  if ($_SESSION['type'] != 'adm') {
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
        echo "Nama Admin : ",$_SESSION['namaAdmin'],"<br>";
        echo "ID Admin : ",$_SESSION['idAdmin'],"<br>";
      ?>
      <a href="inputMk.php">Input Mata Kuliah</a><br>
      <a href="kelolaMhs.php">Kelola Mahasiswa</a><br>
      <a href="logout.php" style="font-size:18px">Logout</a>
  </body>
</html>
