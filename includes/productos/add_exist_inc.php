<?php

use App\Controllers\ProductoController;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $controller = new ProductoController();
        $result = $controller->añadirStock($_POST['in_prodid'], $_POST['in_cant']);
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