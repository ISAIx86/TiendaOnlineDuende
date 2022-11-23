<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/categoria-model.php";
require_once __ROOT."php/classes/categorias/categoria_contr.classes.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controller = new CategoriaController();
    $result = $controller->buscarPorNombre($_GET['in_texto']);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    } else if (!$result) {
        echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
        exit();
    }
    echo json_encode(array('result'=>"success", 'content'=>$result));
    exit();
}

?>