<?php

use App\Controllers\CarritoController;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new CarritoController();
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