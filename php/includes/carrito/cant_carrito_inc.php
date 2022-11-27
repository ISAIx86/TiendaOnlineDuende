<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/classes/usuarios/carrito_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new UsuarioController();
        $result = $controller->modifCantCarrito($_SESSION['user']['ID'], $_POST['in_prodid'], $_POST['in_cant']);
        if (gettype($result) == "string") {
            echo json_encode(array('result'=>"error", 'reason'=>$result));
            exit();
        } else if (!$result) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
            exit();
        } else {
            $result = $controller->totalCarrito($_SESSION['user']['ID']);
            echo json_encode(array('result'=>"success", 'total'=>$result));
            exit();
        }
    }
}

?>