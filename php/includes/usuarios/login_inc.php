<?php
include ("../../classes/filemanager.classes.php");
$root = FilesManager::rootDirectory();

include ("$root/php/models/usuario-model.php");
include ("$root/php/classes/usuarios/usuario_contr.classes.php");

if (isset($_POST["submit"])) {
    $controller = new UsuarioContr();
    $result = $controller->ingresarUsuario($_POST['in_correo'], $_POST['in_password']);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
    }
    session_start();
    $_SESSION["user"] = $result;
    echo json_encode(array('result'=>"success", 'reason'=>"success", 'role'=>$result['Rol']));
}

?>