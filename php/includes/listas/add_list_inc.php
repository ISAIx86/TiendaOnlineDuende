<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/lista-model.php";
require_once __ROOT."php/classes/listas/lista_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nuevo = Lista::create()
            ->setCreador($_SESSION['user']['ID'])
            ->setNombre($_POST['in_nombre'])
            ->setDescripcion($_POST['in_descrip'])
            ->setPrivacidad($_POST['in_descrip'])
            ->setImagenInfo($_FILES['in_img']);
        $controller = new ListaController();
        $result = $controller->crearLista($nuevo);
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