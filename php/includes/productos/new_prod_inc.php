<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nuevo = Producto::create()
            ->setPublicador($_SESSION['user']['ID'])
            ->setTitulo($_POST['in_nombre'])
            ->setDescripcion($_POST['in_descrip'])
            ->setCotizacion($_POST['in_tipoprecio'] == 'CT' ? 1 : 0)
            ->setPrecio($_POST['in_precio'])
            ->setDisponibilidad($_POST['in_dispo']);
        $controller = new ProductoController();
        $result = $controller->crearProducto($nuevo, json_decode($_POST['in_categos']));
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