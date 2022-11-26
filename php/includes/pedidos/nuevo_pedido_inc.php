<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;

require __ROOT."php/includes/paypal/config.php";

require_once __ROOT."php/models/pedido-model.php";
require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
require_once __ROOT."php/classes/pedidos/pedidos_contr.classes.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";

session_start();
if (!isset($_SESSION['user'])) {
    header();
    exit();
}
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
    header();
    exit();
}

// Obtener los productos del carrito.
$user_controller = new UsuarioController();
$products = $user_controller->listaCarrito($_SESSION['user']['ID']);
if (count($products) == 0) {
    header();
    exit();
}

// Checar si hay existencia en stock.
$product_controller = new ProductoController();
foreach ($products as &$prod) {
    $stock = $product_controller->obtenerStock($prod['rs_id']);
    if ($stock) {
        if ($prod['rs_cantidad'] > $stock) {
            header();
            exit();
        }
    } else {
        header();
        exit();
    }
}

// Registrar pedido en la base de datos.
$nuevo = Pedido::create()
    ->setUsuarioID($_SESSION['user']['ID'])
    ->setDomicilioID(null);
$pedido_controller = new PedidosController();
$result = $pedido_controller->registrarPedido($nuevo, $products);
if (gettype($result) == "string") {
    exit();
} else if (!$result) {
    exit();
}

// Enlistar objetos de compra.
$transactions = array();
foreach ($products as &$product) {
    
    $currency = 'MXN';
    $item_qty = $product['out_cantidad'];
    $amountPayable = $product['out_precio'];
    $product_name = $product['out_name'];
    $item_code = $product['out_id'];
    $description = 'Paypal transaction';
    $invoiceNumber = uniqid();
    $my_items = array(
        array('name'=>$product_name, 'quantity'=>$item_qty, 'price'=>$amountPayable, 'sku'=>$item_code, 'currency'=>$currency)
    );

    $amount = new Amount();
    $amount
        ->setCurrency($currency)
        ->setTotal($amountPayable);

    $items = new ItemList();
    $items->setItems($my_items);

    $transaction = new Transaction();
    $transaction
        ->setAmount($amount)
        ->setDescription($description)
        ->setInvoiceNumber($invoiceNumber)
        ->setItemList($items);
    array_push($transactions, $transaction);

}

$redirectUrls = new RedirectUrls();
$redirectUrls
    ->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$payment = new Payment();
$payment
    ->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions($transactions)
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}


if ($result) {
    $user_controller->limpiarCarrito($_SESSION['user']['ID']);
}

header('location:' . $payment->getApprovalLink());
exit();

?>