<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        switch ($_POST['mode']) {
            case 'data': {
                $user = Usuario::create()
                    ->setID($_SESSION['user']['ID'])
                    ->setNombres($_POST['in_nombres'])
                    ->setApellidos($_POST['in_apellidos'])
                    ->setUsername($_POST['in_username'])
                    ->setFechaNac($_POST['in_fechanac'])
                    ->setSexo($_POST['in_genero'])
                    ->setPrivacidad($_POST['in_privacidad'])
                    ->setAvatarInfo($_FILES['in_fotoperfil']);
                $controller = new UsuarioController();
                $result = $controller->modificarUsuario($user);
                if (gettype($result) == "string") {
                    echo json_encode(array('result'=>"error", 'reason'=>$result));
                    exit();
                } else if (!$result) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                    exit();
                }
                $_SESSION['user']['Username'] = $_POST['in_username'];
                $_SESSION['user']['Avatar'] = $user->getAvatar();
                echo json_encode(array('result'=>"success", 'reason'=>"success"));
                exit();
                break;
            }
            case 'email': {
                if ($_SESSION['user']['Correo'] == $_POST['in_correo']) {
                    echo json_encode(array('result'=>"error", 'reason'=>"actual_email"));
                    exit();
                }
                $controller = new UsuarioController();
                $result = $controller->modificarCorreo($_SESSION['user']['ID'], $_POST['in_correo']);
                if (gettype($result) == "string") {
                    echo json_encode(array('result'=>"error", 'reason'=>$result));
                    exit();
                }
                else if (!$result) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                    exit();
                }
                $_SESSION['user']['Correo'] = $_POST['in_correo'];
                echo json_encode(array('result'=>"success", 'reason'=>"success",
                    'data'=>array('out_email'=>$_POST['in_correo'])
                ));
                exit();
                break;
            }
            case 'password': {
                $user->setCorreo()
                    ->setPassword($_POST['in_prevpass'])
                    ->setConfPass($_POST['in_confirm']);
                $controller = new UsuarioController($user);
                $result = $controller->modificarContra($_SESSION['user']['ID'], $_SESSION['user']['Correo'], $_POST['in_prevpass'], $_POST['in_password'], $_POST['in_confirm']);
                if (gettype($result) == "string") {
                    echo json_encode(array('result'=>"error", 'reason'=>$result));
                    exit();
                }
                else if (!$result) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                    exit();
                }
                echo json_encode(array('result'=>"success", 'reason'=>"success"));
                exit();
                break;
            }
        }
    }
}

?>