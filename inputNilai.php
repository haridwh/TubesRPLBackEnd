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
    <title>Input Nilai</title>
  </head>
  <body>
    <?php
      include 'database.php';
      $kodeDosen = $_SESSION['kodeDosen'];
      if ($_SERVER['REQUEST_METHOD']=='POST') {
        $kodemk = $_POST['kodemk'];
        $nim = $_POST['nim'];
        $uts = $_POST['uts'];
        $uas = $_POST['uas'];
        $tugas = $_POST['tugas'];
        if (isset($_POST['submit'])) {
          $query = "UPDATE MENGAMBIL_MK SET uts = $uts, uas = $uas, tugas = $tugas
            WHERE (kode_dosen = '$kodeDosen' AND kodemk='$kodemk') AND nim='$nim'";
          mysqli_query($con,$query);
        }else if(isset($_POST['delete'])){
          $query = "UPDATE MENGAMBIL_MK SET uts = NULL, uas = NULL, tugas = NULL
            WHERE (kode_dosen = '$kodeDosen' AND kodemk='$kodemk') AND nim='$nim'";
          mysqli_query($con,$query);
        }
      }
      $query = "SELECT MENGAMBIL_MK.nim, namamhs, kodemk, uts, uas, tugas FROM MENGAMBIL_MK
        JOIN MAHASISWA ON (MENGAMBIL_MK.NIM = MAHASISWA.NIM)
        WHERE kode_dosen = '$kodeDosen'";
      $result = mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
      ?>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <?php echo $row['nim']." ";
        echo $row['namamhs']." "; ?>
        <input type="number" name="uts" value="<?php echo $row['uts'] ?>" required min="0" max="100" placeholder="UTS">
        <input type="number" name="uas" value="<?php echo $row['uas'] ?>" required min="0" max="100" placeholder="UAS">
        <input type="number" name="tugas" value="<?php echo $row['tugas'] ?>" required min="0" max="100" placeholder="TUGAS">
        <input type="hidden" name="nim" value="<?php echo $row['nim'];?>">
        <input type="hidden" name="kodemk" value="<?php echo $row['kodemk'];?>">
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="delete" value="Delete">
      </form>
      <?php
        }
      }else{
        echo "Data Kosong";
      }
      mysqli_close($con);
     ?>
    <a href="panelDosen.php">Menu</a>
  </body>
</html>
