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
    <title>Input Mata Kuliah</title>
  </head>
  <body>
    <?php
      include 'database.php';
      if ($_SERVER['REQUEST_METHOD']=="POST") {
        if (isset($_POST['add'])) {
          $i_kodemk = $_POST['i_kodemk'];
          $i_namamk = $_POST['i_namamk'];
          $i_sks = $_POST['i_sks'];
          $i_kelas = $_POST['i_kelas'];
          $i_hari = $_POST['i_hari'];
          $i_jam = $_POST['i_jam'];
          $query = "INSERT INTO `MATAKULIAH`(`KODEMK`, `NAMAMK`, `SKS`, `KELAS`, `HARI`, `JAM`)
            VALUES ('$i_kodemk','$i_namamk',$i_sks,'$i_kelas','$i_hari','$i_jam')";
          mysqli_query($con,$query);
          $query = "SELECT * FROM `MATAKULIAH` WHERE kodemk='$i_kodemk' AND kelas='$i_kelas'";
          $result = mysqli_query($con,$query);
          if (mysqli_num_rows($result)>0) {
            echo "Input Berhasil";
          }else{
            echo "Input Gagal";
          }
        }else if(isset($_POST['edit'])){
          $kodemk = $_POST['kodemk'];
          $kelas = $_POST['kelas'];
          $query = "";
        }else if(isset($_POST['delete'])){
          $kodemk = $_POST['kodemk'];
          $kelas = $_POST['kelas'];
          $query = "DELETE FROM MATAKULIAH
            WHERE kodemk = '$kodemk' AND kelas = '$kelas'";
          mysqli_query($con,$query);
          $query = "SELECT namamk FROM MATAKULIAH WHERE kodemk = '$kodemk' AND kelas = '$kelas'";
          $result = mysqli_query($con, $query);
          if (!(mysqli_num_rows($result)>0)){
            echo "Kode MK $kodemk, Kelas $kelas Berhasil Dihapus!";
          }else{
            echo "Gagal Dihapus";
          }
        }
      }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <label>Kode MK :</label><br>
      <input type="text" name="i_kodemk" required><br>
      <label>Nama MK :</label><br>
      <input type="text" name="i_namamk" required><br>
      <label>SKS :</label><br>
      <input type="number" name="i_sks" required min='1' max='4'><br>
      <label>Kelas :</label><br>
        <select name="i_kelas">
            <option value="IF-30-30">IF-30-30</option>
            <option value="IF-30-31">IF-30-31</option>
            <option value="IF-30-32">IF-30-32</option>
            <option value="IF-30-33">IF-30-33</option>
            <option value="IF-30-34">IF-30-34</option>
        </select><br>
      <label>Hari :</label><br>
        <select name="i_hari">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
        </select><br>
      <label>Jam : </label><br>
        <select name="i_jam">
          <option value="07:00:00">07:00</option>
          <option value="09:00:00">09:00</option>
          <option value="11:00:00">11:00</option>
          <option value="13:00:00">13:00</option>
          <option value="15:00:00">15:00</option>
        </select><br>
      <input type="submit" name="add" value="Add"><br><br><br>
    </form>
    <?php
      $query = "SELECT `kodemk`, `namamk`, `sks`, `kelas`, `hari`, `jam` FROM `MATAKULIAH`";
      $result = mysqli_query($con,$query);
      if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <?php
        echo "Kode MK : ".$row['kodemk'].'<br>';
        echo "Nama MK : ".$row['namamk'].'<br>';
        echo "SKS : ".$row['sks'].'<br>';
        echo "Kelas : ".$row['kelas'].'<br>';
        echo "Hari : ".$row['hari'].'<br>';
        echo "Jam : ".$row['jam'].'<br>';
      ?>
      <input type="hidden" name="kodemk" value="<?php echo $row['kodemk'];?>">
      <input type="hidden" name="kelas" value="<?php echo $row['kelas'];?>">
      <input type="submit" name="edit" value="Edit">
      <input type="submit" name="delete" value="Delete">
      <br>=====================
    </form>
    <?php
        }
      }else{
        echo "Belum Ada Mata Kuliah.<br>";
      }
      mysqli_close($con);
     ?>
     <a href="panelDosen.php">Home</a>
  </body>
</html>
