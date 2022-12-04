<?php
define("__HOST", (!empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER["HTTP_HOST"]."/TiendaOnlineDuende/");
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ".__HOST."html/superadmin/sa-home.php");
}
else {
    header("Location: ".__HOST."html/superadmin/sa-login.php");
}
exit();
?>