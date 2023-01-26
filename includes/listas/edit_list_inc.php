<?php

use App\Controllers\ListaController;
use App\Models\Lista;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $nuevo = Lista::create()
            ->setID($_POST['id_lista'])
            ->setCreador($_SESSION['user']['ID'])
            ->setNombre($_POST['in_nombre'])
            ->setDescripcion($_POST['in_descrip'])
            ->setPrivacidad($_POST['in_privacidad'])
            ->setImagenInfo($_FILES['in_img']);
        $controller = new ListaController();
        $result = $controller->modificarLista($nuevo);
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