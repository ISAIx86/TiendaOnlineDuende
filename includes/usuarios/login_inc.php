<?php

require_once "../../myautoload.php";

use App\Controllers\UsuarioController;

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