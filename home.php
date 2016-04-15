<?php
  session_start();
  if (isset($_SESSION['status'])){
    switch ($_SESSION['type']) {
      case 'adm':
        header("location: panelAdmin.php");
        break;
      case 'dsn':
        header("location: panelDosen.php");
        break;
      case 'mhs':
        header("location: panelMhs.php");
        break;
      default:
        break;
    }
  }else{
    header("location:index.php");
  }
?>
