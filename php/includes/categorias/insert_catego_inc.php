<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/categoria-model.php";
require_once __ROOT."php/classes/categorias/categoria_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nuevo = Categoria::create()
            ->setCreador($_SESSION['user']['ID'])
            ->setNombre($_POST['in_nombre'])
            ->setDescripcion($_POST['in_descrip']);
        $controller = new CategoriaController();
        $result = $controller->crearCategoria($nuevo);
        if (gettype($result) == "string") {
            echo json_encode(array('result'=>"error", 'reason'=>$result));
            exit();
        } else if (!$result) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
            exit();
        }
        echo json_encode(array('result'=>"success"));
        exit();
    }
}

?>