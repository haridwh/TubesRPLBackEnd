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
    <title>Daftar Nilai</title>
  </head>
  <body>
    <?php
      include 'database.php';
      $nim = $_SESSION['nim'];
      $query = "SELECT namamk, uts, uas, tugas FROM MENGAMBIL_MK
        JOIN MATAKULIAH ON (MENGAMBIL_MK.KODEMK=MATAKULIAH.KODEMK)
        WHERE NIM = '$nim' AND uts IS NOT NULL AND uas IS NOT NULL AND tugas IS NOT NULL";
      $result = mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
          echo "Mata Kuliah : ".$row['namamk'].'<br>';
          echo "UTS : ".$row['uts'].'<br>';
          echo "UAS : ".$row['uas'].'<br>';
          echo "TUGAS : ".$row['tugas'].'<br>';
          $nilaiAkhir = 0.4*$row['uts']+0.4*$row['uas']+0.2*$row['tugas'];
          if ($nilaiAkhir !=NULL) {
            echo "Nilai Akhir : ".$nilaiAkhir.'<br>';
            switch ($nilaiAkhir) {
              case ($nilaiAkhir>79.99):
                echo 'Index : A';
                break;
              case ($nilaiAkhir>74.99):
                echo 'Index : AB';
                break;
              case ($nilaiAkhir>69.99):
                echo 'Index : B';
                break;
              case ($nilaiAkhir>69.99):
                echo 'Index : BC';
                break;
              case ($nilaiAkhir>59.99):
                echo "Index : C";
                break;
              case ($nilaiAkhir>49.99):
                echo "Index : CD";
                break;
              case ($nilaiAkhir>39.99):
                echo "Index : D";
                break;
              default:
                echo "Index : E";
                break;
            }
          }else {
            echo "--";
          }
          echo "<br>=========================================<br>";
        }
      }else{
        echo "Nilai Belum Ada";
      }
      mysqli_close($con);
     ?>
     <a href="panelMhs.php">Home</a>
  </body>
</html>
