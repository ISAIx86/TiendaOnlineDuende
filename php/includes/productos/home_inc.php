<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/productos/busqueda_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['mode'])) {
        $controller = new BusquedaProdController();
        $result = "query_error";
        switch($_GET['mode']) {
            case 'vendidos': {
                $result = $controller->masVendidos();
            }
            case 'vistos': {
                $result = $controller->masVistos();
            }
            case 'recomendados': {
                $result = $controller->masRecomendados();
            }
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