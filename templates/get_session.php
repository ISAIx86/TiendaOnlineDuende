<?php
session_start();
if(isset($_SESSION["user"])){
  $loggedUser = $_SESSION["user"];
}
else {
  header('Location: ../index.php');
  exit();
}
?>