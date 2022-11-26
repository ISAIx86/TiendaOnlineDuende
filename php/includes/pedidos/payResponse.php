<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
define("__HS_ROOT", "http://".$_SERVER["SERVER_NAME"]."/TiendaOnlineDuende/");

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require __ROOT."php/includes/pedidos/config.php";

require_once __ROOT."php/models/pedido-model.php";
require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/pedidos/pedidos_contr.classes.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";
require_once __ROOT."php/classes/usuarios/carrito_contr.classes.php";

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: '.__HS_ROOT.'html/comprador/c-compraExitosa.php');
    exit();
}
if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    header('Location: '.__HS_ROOT.'html/comprador/c-compraExitosa.php');
    exit();
}

$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {

    $payment->execute($execution, $apiContext);

    try {

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        // Obtener los productos del carrito.
        $carr_controller = new CarritoController();
        $products = $carr_controller->listaCarrito($_SESSION['user']['ID']);
        if (count($products) == 0) {
            header('Location: '.__HS_ROOT.'html/comprador/c-compraExitosa.php');
            exit();
        }

        // Registrar pedido en la base de datos.
        $nuevo = Pedido::create()
            ->setUsuarioID($_SESSION['user']['ID'])
            ->setDomicilioID(null);
        $pedido_controller = new PedidosController();
        $result = $pedido_controller->registrarPedido($nuevo, $products);
        if (gettype($result) == "string") {
            header();
            exit();
        } else if (!$result) {
            header('Location: '.__HS_ROOT.'html/comprador/c-compraExitosa.php');
            exit();
        } else {
            $carr_controller->limpiarCarrito($_SESSION['user']['ID']);
            header('Location: '.__HS_ROOT.'html/comprador/c-compraExitosa.php');
            exit();
        }

    } catch (Exception $e) {

    }

} catch (Exception $e) {

}

?>