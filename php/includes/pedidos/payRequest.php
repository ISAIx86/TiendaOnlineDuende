<?php

define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
define("__HS_ROOT", "http://".$_SERVER["SERVER_NAME"]."/TiendaOnlineDuende/");

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;

require __ROOT."php/includes/pedidos/config.php";

require_once __ROOT."php/models/producto-model.php";
require_once __ROOT."php/classes/productos/producto_contr.classes.php";
require_once __ROOT."php/classes/usuarios/carrito_contr.classes.php";

session_start();
if (!isset($_SESSION['user'])) {
    header('Location:'.__HS_ROOT.'html/comprador/c-compraExitosa.php');
    exit();
}
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
    header('Location:'.__HS_ROOT.'html/comprador/c-compraExitosa.php');
    exit();
}

// Obtener los productos del carrito.
$carr_controller = new CarritoController();
$products = $carr_controller->listaCarrito($_SESSION['user']['ID']);
if (count($products) == 0) {
    header('Location:'.__HS_ROOT.'html/comprador/c-compraExitosa.php');
    exit();
}

// Checar si hay existencia en stock.
$product_controller = new ProductoController();
foreach ($products as &$prod) {
    $stock = $product_controller->obtenerStock($prod['out_id']);
    if ($stock) {
        if ($prod['out_cantidad'] > $stock) {
            header('Location:'.__HS_ROOT.'html/comprador/c-compraExitosa.php');
            exit();
        }
    } else {
        header('Location:'.__HS_ROOT.'html/comprador/c-compraExitosa.php');
        exit();
    }
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Enlistar objetos de compra.
$transactions = array();
foreach ($products as &$product) {
    
    $currency = 'MXN';
    $item_qty = (int)$product['out_cantidad'];
    $amountPayable = (float)$product['out_precio'];
    $product_name = $product['out_titulo'];
    $item_code = $product['out_id'];
    $description = 'Paypal transaction';
    $invoiceNumber = uniqid();
    $my_items = array(
        array('name'=>$product_name, 'quantity'=>$item_qty, 'price'=>$amountPayable, 'sku'=>$item_code, 'currency'=>$currency)
    );

    $amount = new Amount();
    $amount
        ->setCurrency($currency)
        ->setTotal((float)$amountPayable * $item_qty);

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

header('location:' . $payment->getApprovalLink());
exit();

?>