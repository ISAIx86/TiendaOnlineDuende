<?php
include ("../../php/classes/filemanager.classes.php");
$root = FilesManager::rootDirectory();

session_start();
if (isset($_SESSION['user'])) {
    if (session_destroy()) {
        header("Location: $root/index.php");
        exit();
    }
}
else {
    header("Location: $root/index.php");
    exit();
}
?>