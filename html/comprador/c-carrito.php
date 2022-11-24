<?php
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
  <?php include __ROOT."html/templates/headerComprador.php"?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Carrito de compra</h1>
    <div class="cointainer">
      <ul class="list-group">
        <div id="lst_carrito">
           
        </div>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-sm-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-sm-10">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>$ 14,000</h6>
              <div class = "row">
              <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-warning" data-toggle="button" aria-pressed="false" autocomplete="off">Agregar a lista</button>
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-danger" data-toggle="button" aria-pressed="false" autocomplete="off">Quitar del carrito</button>
                </div>
                <div class="col-sm-3"></div>  
              </div>                   
            </div>
          </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-sm-2">
              <img src="../../resources/comprar.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-sm-10">
              <div class="fw-bold">Total</div>
              <h6>$ 50,000</h6>
              <div class = "row">
                <div class="col-sm-4">
                  <button id="btn_pagar" class="btn btn-outline-success">Pagar</button>
                </div>
                <div class="col-sm-4">
                  <button id="btn_guardaLista" class="btn btn-outline-warning">Guardar en lista</button>
                </div>
                <div class="col-sm-4">
                  <button id="btn_clean" class="btn btn-outline-danger">Limpiar Carrito</button>
                </div>  
              </div>                   
            </div>
          </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="row">
            <div class="col-8"></div>
            <div class="col-2">
              <img src="../../resources/carrito.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="col-2">
              <span id="lbl_total" class="badge bg-primary rounded-pill">$0</span>
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

  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/jquery-3.6.1.js"></script>
  <script src="../../js/carrito.js"></script>

</body>
</html>