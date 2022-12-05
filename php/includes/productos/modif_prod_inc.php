<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/models/multimedia-model.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";
require_once __ROOT."php/classes/multimedia/multimedia_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nuevo = Producto::create()
            ->setID($_POST['in_prodid'])
            ->setPublicador($_SESSION['user']['ID'])
            ->setTitulo($_POST['in_nombre'])
            ->setDescripcion($_POST['in_descrip'])
            ->setCotizacion($_POST['in_tipoprecio'] == 'CT' ? 1 : 0)
            ->setPrecio($_POST['in_precio']);
        $controller = new ProductoController();
        $result = $controller->modificarProducto($nuevo, json_decode($_POST['in_categos']));
        if (gettype($result) == "string") {
            echo json_encode(array('result'=>"error", 'reason'=>$result));
            exit();
        } else if (!$result) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
            exit();
        }
        $array_files = array();
        $countfiles = count($_FILES['in_files']['name']);
        if ($countfiles > 0) {
            $controllermult = new MultimediaController();
            $result = $controllermult->limpiarArchivos($nuevo->getID());
            if (gettype($result) == "string") {
                echo json_encode(array('result'=>"error", 'reason'=>$result));
                exit();
            } else if (!$result) {
                echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                exit();
            }
            for ($i = 0; $i < $countfiles; $i++) {
                array_push($array_files, array(
                    'name' => $_FILES['in_files']['name'][$i],
                    'type' => $_FILES['in_files']['type'][$i],
                    'tmp_name' => $_FILES['in_files']['tmp_name'][$i],
                    'error' => $_FILES['in_files']['error'][$i],
                    'size' => $_FILES['in_files']['size'][$i]
                ));
            }
            
            $result = $controllermult->insertarMultimedia($nuevo->getID(), $array_files);
        }
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