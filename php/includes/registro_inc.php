<?php

include (__DIR__.'/../models/usuario-model.php');
include (__DIR__.'/../classes/usuario_contr.classes.php');

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
    header("location: ../../index.php");
    exit();
}

?>