<?php

include (__DIR__.'/../models/usuario-model.php');
include (__DIR__.'/../classes/usuario_contr.classes.php');

session_start();
if (isset($_SESSION['user'])) {
    if (isset($_POST['submit'])) {
        $mode = $_POST['mode'];
        $user = Usuario::create()->setID($_SESSION['user']['ID']);
        switch($mode) {
            case 'data':
                $user->setNombres($_POST['in_nombres'])
                    ->setApellidos($_POST['in_apellidos'])
                    ->setUsername($_POST['in_username'])
                    ->setFechaNac($_POST['in_fechanac'])
                    ->setSexo($_POST['in_genero']);
                $controller = new UsuarioContr($user);
                if ($controller->modificarUsuario()) {
                    $_SESSION['user']['Username'] = $_POST['in_username'];
                    echo json_encode(array('result'=>"success", 'reason'=>"success",
                        'data'=>array(
                            'out_nombres'=>$_POST['in_nombres'],
                            'out_apellidos'=>$_POST['in_apellidos'],
                            'out_username'=>$_POST['in_username'],
                            'out_fechanac'=>$_POST['in_fechanac'],
                            'out_genero'=>$_POST['in_genero']
                        )
                    ));
                    exit();
                }
                else {
                    echo json_encode(array('result'=>"error", 'reason'=>"failure_tried_update_info"));
                    exit();
                }
                break;
            case 'email':
                if ($_SESSION['user']['Correo'] != $_POST['in_correo']) {
                    $user->setCorreo($_POST['in_correo']);
                    $controller = new UsuarioContr($user);
                    if ($controller->modificarCorreo()) {
                        $_SESSION['user']['Correo'] = $_POST['in_correo'];
                        echo json_encode(array('result'=>"success", 'reason'=>"success",
                            'data'=>array('out_email'=>$_POST['in_correo'])
                        ));
                        exit();
                    }
                    else {
                        echo json_encode(array('result'=>"error", 'reason'=>"failure_tried_update_email"));
                        exit();
                    }
                }
                else {
                    echo json_encode(array('result'=>"error", 'reason'=>"actual_email"));
                    exit();
                }
                break;
            case 'password':
                $user->setCorreo($_SESSION['user']['Correo'])
                    ->setPassword($_POST['in_prevpass'])
                    ->setConfPass($_POST['in_confirm']);
                $controller = new UsuarioContr($user);
                if ($controller->modificarContra($_POST['in_password'])) {
                    echo json_encode(array('result'=>"success", 'reason'=>"success"));
                    exit();
                }
                else {
                    echo json_encode(array('result'=>"error", 'reason'=>"failure_tried_update_passw"));
                    exit();
                }
                break;
        }
    }
}

?>