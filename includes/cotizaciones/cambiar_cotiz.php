<?php

use App\Controllers\CotizacionController;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new CotizacionController();
        $result;
        if ($_POST['mode'] == 'c'){
            $result = $controller->ofertaComprador($_POST['in_idcot'], $_POST['in_sub'], $_POST['in_cant']);
        } else if ($_POST['mode'] == 'v') {
            $result = $controller->ofertaVendedor($_POST['in_idcot'], $_POST['in_sub'], $_POST['in_cant']);
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