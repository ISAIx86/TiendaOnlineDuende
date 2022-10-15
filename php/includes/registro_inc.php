<?php

include (__DIR__.'/../models/usuario-model.php');
include (__DIR__.'/../classes/usuario_contr.classes.php');

if (isset($_POST["submit"])) {
    $nuevo_usuario = Usuario::create()
        ->setNombres($_POST['in_nombres'])
        ->setApellidos($_POST['in_apellidos'])
        ->setUsername($_POST['in_username'])
        ->setFechaNac($_POST['in_fechanac'])
        ->setSexo($_POST['in_genero'])
        ->setRol($_POST['in_rolus'])
        ->setCorreo($_POST['in_correo'])
        ->setPassword($_POST['in_password'])
        ->setConfPass($_POST['in_confirm']);

    $controller = new UsuarioContr($nuevo_usuario);
    $controller->registrarUsuario();

    header("location: ../../landingPage.html");
}

?>