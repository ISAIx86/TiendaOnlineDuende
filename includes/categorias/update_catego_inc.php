<?php

use App\Controllers\CategoriaController;
use App\Models\Categoria;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $controller = new CategoriaController();
        switch($_POST['mode']) {
            case 'data': {
                $nuevo = Categorias::create()
                    ->setID($_POST['in_id'])
                    ->setNombre($_POST['in_nombre'])
                    ->setDescripcion($_POST['in_descrip']);
                $result = $controller->modificarCategoria($nuevo);
                if (gettype($result) == "string") {
                    echo json_encode(array('result'=>"error", 'reason'=>$result));
                    exit();
                } else if (!$result) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                    exit();
                }
                echo json_encode(array('result'=>"success"));
                exit();
                break;
            }
            case 'author': {
                $result = $controller->autorizarCategoria($_POST['in_id'], $_SESSION['user']['ID']);
                if (gettype($result) == "string") {
                    echo json_encode(array('result'=>"error", 'reason'=>$result));
                    exit();
                } else if (!$result) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
                    exit();
                }
                echo json_encode(array('result'=>"success"));
                exit();
                break;
            }
        }
        
    }
}

?>