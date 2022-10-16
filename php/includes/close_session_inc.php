<?php
session_start();
if (isset($_SESSION['user'])) {
    if (session_destroy()) {
        header('Location: ../../index.php');
        exit();
    }
}
else {
    header('Location: ../../index.php');
    exit();
}
?>