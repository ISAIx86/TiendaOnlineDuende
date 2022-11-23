<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $controller = new UsuarioController();
    $nuevo = Usuario::create()
        ->setNombres($_POST['in_nombres'])
        ->setApellidos($_POST['in_apellidos'])
        ->setUsername($_POST['in_username'])
        ->setFechaNac($_POST['in_fechanac'])
        ->setSexo($_POST['in_genero'])
        ->setRol($_POST['in_rolus'])
        ->setCorreo($_POST['in_correo'])
        ->setPassword($_POST['in_password'])
        ->setConfPass($_POST['in_confirm'])
        ->setAvatarInfo($_FILES['in_fotoperfil']);
    $result = $controller->registrarUsuario($nuevo);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    } else if (!$result) {
        echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
        exit();
    }
    echo json_encode(array('result'=>"success"));
    exit();
}

?>