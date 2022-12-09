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
    header("Location: ".__HS_ROOT."html/templates/something_went_wrong.php?context='No hay usuario ingresado'&message='Se perdió la sesión de usuario o se ingresó sin autorización.'");
    exit();
}
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
    header("Location: ".__HS_ROOT."html/templates/something_went_wrong.php?context='Verbo no válido'&message='Se intentó ejecutar el pago sin verbo'");
    exit();
}

// Obtener los productos del carrito.
$carr_controller = new CarritoController();
$products = $carr_controller->listaCarrito($_SESSION['user']['ID']);
if (count($products) == 0) {
    header("Location: ".__HS_ROOT."html/templates/something_went_wrong.php?context='Carrito vacío'&message='No hay productos para pagar en el carrito.'");
    exit();
}

// Checar si hay existencia en stock.
$product_controller = new ProductoController();
foreach ($products as &$prod) {
    $stock = $product_controller->obtenerStock($prod['out_id']);
    if ($stock) {
        if ($prod['out_cantidad'] > $stock) {
            header("Location: ".__HS_ROOT."html/templates/something_went_wrong.php?context='No hay productos'&message='No hay suficientes productos en existencia que usted desea comprar.'");
            exit();
        }
    } else {
        header("Location: ".__HS_ROOT."html/templates/something_went_wrong.php?context='Error al buscar existencias'&message='Algo ocurrió mientras checabamos los productos en existencia para esta compra.'");
        exit();
    }
}

// PAYER
$payer = new Payer();
$payer->setPaymentMethod('paypal');

$invoiceNumber = uniqid();
$currency = 'MXN';
$description = 'Paypal transaction';
$my_items = array();
$total = 0.0;

foreach ($products as &$product) {
    $total += (float)$product['out_precio'] * (int)$product['out_cantidad'];
    array_push(
        $my_items,
        array (
            'name'=>$product['out_titulo'],
            'quantity'=>(int)$product['out_cantidad'],
            'price'=>(float)$product['out_precio'],
            'sku'=>$product['out_id'],
            'currency'=>$currency
        )
    );
}

$amount = new Amount();
$amount
    ->setCurrency($currency)
    ->setTotal($total);

$items = new ItemList();
$items->setItems($my_items);

$transaction = new Transaction();
$transaction
    ->setAmount($amount)
    ->setDescription($description)
    ->setInvoiceNumber($invoiceNumber)
    ->setItemList($items);

$redirectUrls = new RedirectUrls();
$redirectUrls
    ->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment
    ->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    header("Location:".__HS_ROOT."html/templates/something_went_wrong.php?context=No se pudo crear link de pago&message=Algo salió mal al redirigir a PayPal");
    exit();
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit();

?>

