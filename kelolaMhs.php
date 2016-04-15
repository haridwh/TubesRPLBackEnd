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
    <title>Kelola Mahasiswa</title>
  </head>
  <body>
    <?php
      include 'database.php';
      if ($_SERVER['REQUEST_METHOD']=="POST") {
        if (isset($_POST['add'])) {
          $i_nim = $_POST['i_nim'];
          $i_nama = $_POST['i_nama'];
          $i_alamat = $_POST['i_alamat'];
          $i_username = $_POST['i_username'];
          $i_password = $_POST['i_password'];
          $query = "INSERT INTO LOGIN (IDLOGIN, PASSWORD) VALUES ('$i_username','$i_password')";
          mysqli_query($con,$query);
          $query = "INSERT INTO MAHASISWA (NIM, NAMAMHS, ALAMATMHS, IDLOGIN) VALUES ('$i_nim','$i_nama','$i_alamat','$i_username')";
          mysqli_query($con,$query);
          $query = "SELECT * FROM `MAHASISWA` WHERE nim='$i_nim'";
          $result = mysqli_query($con,$query);
          if (mysqli_num_rows($result)>0) {
            echo "Input Berhasil";
          }else{
            echo "Input Gagal";
          }
        }else if(isset($_POST['edit'])){
          $nim = $_POST['nim'];
          $query = "UPDATE MAHASISWA SET `NIM`=[value-1],`NAMAMHS`=[value-2],
            `ALAMATMHS`=[value-3],`IDLOGIN`=[value-4] WHERE 1";
        }else if(isset($_POST['delete'])){
          $nim = $_POST['nim'];
          $query = "DELETE FROM LOGIN WHERE IDLOGIN =
            (SELECT IDLOGIN FROM MAHASISWA WHERE NIM = '$nim')";
          mysqli_query($con,$query);
        }
      }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <label>NIM :</label><br>
      <input type="text" name="i_nim" required><br>
      <label>Nama :</label><br>
      <input type="text" name="i_nama" required><br>
      <label>Alamat :</label><br>
      <input type="text" name="i_alamat" required><br>
      <label>Username :</label><br>
      <input type="text" name="i_username" required><br>
      <label>Password :</label><br>
      <input type="password" name="i_password" required><br>
      <input type="submit" name="add" value="Add"><br><br><br>
    </form>
    <?php
      $query = "SELECT nim, namamhs, alamatmhs FROM MAHASISWA";
      $result = mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <?php
        echo "NIM : ".$row['nim'].'<br>';
        echo "Nama : ".$row['namamhs'].'<br>';
        echo "Alamat : ".$row['alamatmhs'].'<br>';
      ?>
      <input type="hidden" name="nim" value="<?php echo $row['nim'];?>">
      <input type="submit" name="edit" value="Edit">
      <input type="submit" name="delete" value="Delete">
      <br>=====================
    </form>
    <?php
        }
      }else{
        echo "Belum Ada Mahasiswa.<br>";
      }
      mysqli_close($con);
     ?>
     <a href="panelDosen.php">Home</a>
  </body>
</html>
