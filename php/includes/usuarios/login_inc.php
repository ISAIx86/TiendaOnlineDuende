<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $controller = new UsuarioController();
    $result = $controller->ingresarUsuario($_POST['in_correo'], $_POST['in_password']);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    }
    session_start();
    $_SESSION["user"] = $result;
    echo json_encode(array('result'=>"success", 'reason'=>"success", 'role'=>$result['Rol']));
    exit();
}

?>