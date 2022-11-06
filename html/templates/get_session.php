<?php
session_start();
if(isset($_SESSION["user"])){
  $loggedUser = $_SESSION["user"];
}
else {
  header("Location: ".__ROOT."index.php");
  exit();
}
?>