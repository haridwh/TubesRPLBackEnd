<?php
  include('login.php');
  if ((isset($_SESSION['username']) != '')){
    header('Location: home.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LOGIN</title>
  </head>
  <body>
    <h2>Login</h2>
    <?php
      echo $error;
    ?>
    <form method="post" action="">
      <label>Username:</label><br>
      <input type="text" name="username" placeholder="Username"><br>
      <label>Password:</label><br>
      <input type="password" name="password" placeholder="Password"><br>
      <select name="type">
          <option value="adm">Admin</option>
          <option value="dsn">Dosen</option>
          <option value="mhs">Mahasiswa</option>
      </select><br>
      <button type="submit" name="submit">Login</button>
    </form>
  </body>
</html>
