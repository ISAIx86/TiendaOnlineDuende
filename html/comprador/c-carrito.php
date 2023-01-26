<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Carrito</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php
  include __ROOT."html/templates/headerComprador.php";
  use App\Controllers\CarritoController;
  $controller = new CarritoController();
  $productos = $controller->listaCarrito($_SESSION['user']['ID']);
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Carrito de compra</h1>
    <div class="cointainer">
      <ul class="list-group">
        <div id="lst_carrito">
        <?php foreach ($productos as &$prod) {
            $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
        ?>
          <li id="emt-list" prodid=<?php echo $prod['out_id'] ?> class="list-group-item d-flex justify-content-between align-items-start">
            <div class="row">
              <div class="col-2">
                <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
              </div>
              <div class="col-8">
                <div class="fw-bold"><?php echo $prod['out_titulo'] ?></div>
                <h6 id="lbl_price" value=<?php echo $prod['out_precio'] ?>><?php echo "$".$prod['out_precio'] ?></h6>
                <span class="badge bg-primary rounded-pill"><?php echo $prod['out_dispo'] ?> Disponibles</span>
                </br>
                <button>Guardar en lista</button>
                <button>Ver productos similares</button>
              </div>
              <div id="cant_control" class="col-2">
                <span id="lbl_subtotal" class="badge bg-primary rounded-pill">$<?php echo $prod['out_total'] ?></span>
                </br>
                <?php if (!$prod['out_cotizado']) { ?>
                  <button id="btn_menos" class="btn btn-secondary btn-circle btn-sm">-</button>
                <?php } ?>
                <span id="lbl_cant" class="badge bg-primary rounded-pill"><?php echo $prod['out_cantidad'] ?></span>
                <?php if (!$prod['out_cotizado']) { ?>
                  <button id="btn_mas" class="btn btn-secondary btn-circle btn-sm">+</button>
                <?php } ?>
                <form>
                  <button id="btn_quitar" class="btn btn-danger">Quitar</button>
                </form>
              </div>
            </div>
          </li>
        <?php } ?>
        </div>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="row">
            <div class="col-8"></div>
            <div class="col-2">
              <img src="../../resources/carrito.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="col-2">
              <?php if ($carritoTot) { ?>
              <span id="lbl_total" class="badge bg-primary rounded-pill"><?php echo "$$carritoTot" ?></span>
              <?php } else { ?>
              <span id="lbl_total" class="badge bg-primary rounded-pill">$0</span>
              <?php } ?>
              <button id="btn_pagar" class="btn btn-success">Pagar</button>
              <button id="btn_guardaLista" class="btn btn-success">Guardar en lista</button>
              <button id="btn_clean" class="btn btn-danger">Limpiar Carrito</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/comprador/carrito.js"></script>

</body>
</html>