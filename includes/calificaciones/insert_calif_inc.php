<?php

use App\Controllers\CalificacionesController;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" & $_POST['submit']) {
        $controller = new CalificacionesController();
        $result = $controller->insertarNuevoReview($_SESSION['user']['ID'], $_POST['in_prodid'], $_POST['in_val'], $_POST['in_review']);
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