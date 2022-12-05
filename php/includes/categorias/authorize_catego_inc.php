<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/categoria-model.php";
require_once __ROOT."php/classes/categorias/categoria_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $controller = new CategoriaController();
        $result = false;
        if ($_POST['mode'] == "auto") {
            $result = $controller->autorizarCategoria($_POST['in_catid'], $_SESSION['user']['ID']);
        } else if ($_POST['mode'] == "deny") {
            $result = $controller->denegarCategoria($_POST['in_catid'], $_SESSION['user']['ID']);
        }
        if (gettype($result) == "string") {
            echo json_encode(array('result'=>"error", 'reason'=>$result));
            exit();
        } else if (!$result) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
            exit();
        }
        echo json_encode(array('result'=>"success", 'products'=>$result));
        exit();
    }
}

?>