<?php
define("__ROOT", (!empty($_SERVER['HTTPS']) ? 'https' : 'http')."://".$_SERVER["HTTP_HOST"]."/TiendaOnlineDuende/");
session_start();
if (isset($_SESSION['user'])) {
    $current_user = $_SESSION['user'];
    switch($current_user['Rol']) {
        case 'comprador':
            header("Location: ".__ROOT."html/usuarios/c-home.php");
            exit();
            break;
        case 'vendedor':
            header("Location: ".__ROOT."html/usuarios/c-profile.php");
            exit();
            break;
        case 'administrador':
            header("Location: ".__ROOT."html/usuarios/c-profile.php");
            exit();
            break;
        case 'compravende':
            // TODO: Direccionar a inicio de rol de comprador-vendedor.
            break;
    }
}
else {
    header("Location: ".__ROOT."html/starting/landingPage.php");
}
?>