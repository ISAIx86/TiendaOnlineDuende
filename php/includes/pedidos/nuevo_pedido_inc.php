<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/pedido-model.php";
require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
require_once __ROOT."php/classes/pedidos/pedidos_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $controleruser = new UsuarioController();
        $products = $controleruser->listaCarrito($_SESSION['user']['ID']);
        if (count($products) == 0) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_products"));
            exit();
        }
        $nuevo = Pedido::create()
            ->setUsuarioID($_SESSION['user']['ID'])
            ->setDomicilioID(null);
        $controller = new PedidosController();
        $result = $controller->registrarPedido($nuevo, $products);
        if ($result) {
            $controleruser->limpiarCarrito($_SESSION['user']['ID']);
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