<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

require_once __ROOT."php/models/pedido-model.php";
require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
require_once __ROOT."php/classes/pedidos/pedidos_contr.classes.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";

session_start();
if (isset($_SESSION['user'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $controlleruser = new UsuarioController();
        $products = $controlleruser->listaCarrito($_SESSION['user']['ID']);
        if (count($products) == 0) {
            echo json_encode(array('result'=>"error", 'reason'=>"no_products"));
            exit();
        }
        $controllerprod = new ProductoController();
        foreach ($products as &$prod) {
            $stock = $controllerprod->obtenerStock($prod['rs_id']);
            if ($stock) {
                if ($prod['rs_cantidad'] > $stock) {
                    echo json_encode(array('result'=>"error", 'reason'=>"no_aviable"));
                    exit();
                }
            } else {
                echo json_encode(array('result'=>"error", 'reason'=>"no_aviable"));
                exit();
            }
        }
        
        $nuevo = Pedido::create()
            ->setUsuarioID($_SESSION['user']['ID'])
            ->setDomicilioID(null);
        $controller = new PedidosController();
        $result = $controller->registrarPedido($nuevo, $products);
        if ($result) {
            $controlleruser->limpiarCarrito($_SESSION['user']['ID']);
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