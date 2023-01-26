<?php

use App\Controllers\CategoriaController;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controller = new CategoriaController();
    $result = $controller->buscarPorNombre($_GET['in_texto']);
    if (gettype($result) == "string") {
        echo json_encode(array('result'=>"error", 'reason'=>$result));
        exit();
    } else if (gettype($result)!="array" & !$result) {
        echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
        exit();
    }
    echo json_encode(array('result'=>"success", 'content'=>$result));
    exit();
}

?>