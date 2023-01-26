<?php

use App\Controllers\SuperAdminController;

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $controller = new SuperAdminController();
        $result = $controller->autorizar($_SESSION['user']['ID'], $_POST['in_userid']);
        if (gettype($result) == "string") {
            echo json_encode(array('result'=>"error", 'reason'=>$result));
            exit();
        } else if (!$result) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_query_results"));
            exit();
        }
        echo json_encode(array('result'=>"success", 'reason'=>"success"));
        exit();
    }
}

?>