<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/superadmin-model.php";
require_once __ROOT."php/classes/superadmin/superadmin_contr.classes.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $controller = new SuperAdminController();
    $result = $controller->ingresarAdmin($_POST['in_correo'], $_POST['in_password']);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    }
    session_start();
    $_SESSION["user"] = $result;
    echo json_encode(array('result'=>"success", 'reason'=>"success"));
    exit();
}

?>