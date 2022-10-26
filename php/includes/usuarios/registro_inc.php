<?php
include ("../../php/classes/filemanager.classes.php");
$root = FilesManager::rootDirectory();

include ("$root/php/models/usuario-model.php");
include ("$root/php/classes/usuario_contr.classes.php");

if (isset($_POST['submit'])) {
    $controller = new UsuarioContr();
    $nuevo = Usuario::create()
        ->setNombres()
        ->setApellidos()
        ->setUsername()
        ->setFechaNac()
        ->setSexo()
        ->setRol()
        ->setCorreo()
        ->setPassword()
        ->setConfPass();
    $result = $controller->registrarUsuario($nuevo);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    } else if (!$result) {
        echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
        exit();
    }
    header("location: $root/index.php");
    exit();
}

?>