<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagar</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
    <!-- Header -->
    <?php
    include __ROOT."html/templates/headerComprador.php";
    $productos = array();
    if (isset($_SESSION['user'])) {
        $controller = new CarritoController();
        $productos = $controller->listaCarrito($_SESSION['user']['ID']);
    }
    ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class="container">
            <ul class="list-group">
                <div id="lst_carrito">
                <?php foreach($productos as &$prod) {
                    $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="row">
                            <div class="col-2">
                                <img src=<?php echo $imageSrc ?> class="d-block w-100" alt="...">
                            </div>
                            <div class="col-8">
                                <div class="fw-bold"><?php echo $prod['out_titulo']?></div>
                                <h6>$<?php echo $prod['out_precio']?></h6>
                            </div>
                            <div id="cant_control" class="col-2">
                            <span id="lbl_cant" class="badge bg-primary rounded-pill">Unidades: <?php echo $prod['out_cantidad']?></span>
                            </br>
                            <span class="badge bg-primary rounded-pill">Subtotal: $<?php echo $prod['out_total']?></span>
                            </div>
                        </div>
                    </li>
                <?php } ?>
                </div>
            </ul>
            <div class = "row">
                <div class = "col-6">
                    <div class = "container">
                        <div class = "row">
                            <h4>Direcion de envio</h4>
                        </div>
                        <div class="row">
                            <a href = "../comprador/c-dirección.html">
                                <button type="button" class="btn btn-warning">Actualizar mi Direcion</button>
                            </a>
                            <h1></h1>
                        </div>
                        <div class = "row">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5>Estado</h5>
                                    <h8>Nuevo León</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Municipio</h5>
                                    <h8>Monterrey</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Codigo Postal</h5>
                                    <h8>64000</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Colonia</h5>
                                    <h8>Centro</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Calle</h5>
                                    <h8>Juan Ignacio Ramon</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>No Exterior</h5>
                                    <h8>1400B</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>No Interior</h5>
                                    <h8>4D</h8>
                                </li>
                              </ul>
                        </div>
                    </div>
                </div>
                <div class = "col-6">
                    <div class="container">
                        <div class = "row">
                            <h4>Metodos de pago registrados</h4>
                            <a href = "../comprador/c-RegMetodoPago.html">
                                <button type="button" class="btn btn-warning">Registrar metodo de pago</button>
                            </a>
                            <h1></h1>
                        </div>
                        <div class = "row">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5>Tarjeta Credito</h5>
                                    <h8>XXXX XXXX XXXX X386</h8>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                          Selecionar
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <h5>Tarjeta de debito</h5>
                                    <h8>XXXX XXXX XXXX X256</h8>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Selecionar
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class = "container">
                            <div class = "row">
                                <h1></h1>
                                <span class="badge bg-secondary rounded-pill">Total a pagar</span>
                                <?php if ($carritoTot) { ?>
                                <span id="lbl_total" class="badge bg-primary rounded-pill"><?php echo "$$carritoTot" ?></span>
                                <?php } else { ?>
                                <span id="lbl_total" class="badge bg-primary rounded-pill">$0</span>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <h1></h1>
                                <div class = "col-12">
                                    <form action='../../php/includes/pedidos/payRequest.php' method='post'>
                                        <button type="submit" class="btn text-bg-success">Pagar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include __ROOT."html/templates/footer.php"?>

    <script src="../../js/bootstrap.bundle.js"></script>

</body>
</html>