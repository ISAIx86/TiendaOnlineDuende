<?php

include (__DIR__.'/../models/usuario-model.php');
include (__DIR__.'/../classes/usuario_contr.classes.php');

if (isset($_POST["submit"])) {
    $nuevo_usuario = Usuario::create()
        ->setCorreo($_POST['in_correo'])
        ->setPassword($_POST['in_password']);

    $controller = new UsuarioContr($nuevo_usuario);
    switch($controller->ingresarUsuario()) {
        case "empty_inputs":
            echo json_encode(array('result'=>"error", 'reason'=>"empty_inputs"));
            break;
        case "no_exists":
            echo json_encode(array('result'=>"error", 'reason'=>"no_exists"));
            break;
        case "not_found":
            echo json_encode(array('result'=>"error", 'reason'=>"not_found"));
            break;
        case "wrong_password":
            echo json_encode(array('result'=>"error", 'reason'=>"wrong_password"));
            break;
        case "unauthorized_admin":
            echo json_encode(array('result'=>"error", 'reason'=>"unauthorized_admin"));
            break;
        case "user_logged":
            session_start();
            $_SESSION["user"] = $controller->empezarSesion();
            $user = $_SESSION["user"];
            echo json_encode(array('result'=>"success", 'reason'=>"success", 'role'=>$nuevo_usuario->getRol()));
    }
}

?>

