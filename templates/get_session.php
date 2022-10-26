<?php
include("../php/classes/filemanager.classes.php");
$root = FilesManager::rootDirectory();
session_start();
if(isset($_SESSION["user"])){
  $loggedUser = $_SESSION["user"];
}
else {
  header("Location: $root/index.php");
  exit();
}
?>