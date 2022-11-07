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
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>1 x 14,000</h6>
              <form>
                <div class = "row">
                  <div class = "col-1">
                    <button type="button" class="btn btn-warning">-</button>
                  </div>
                  <div class = "col-1">
                    <button type="button" class="btn btn-info">1</button>
                  </div>
                  <div class = "col-1">
                    <button type="button" class="btn btn-success">+</button>
                  </div>
                </div>
              </form>
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
              <form>
                <button type="button" class="btn btn-danger">Quitar</button>
              </form>
            </div>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>1 x 14,000</h6>
              <form>
                <div class = "row">
                  <div class = "col-1">
                    <button type="button" class="btn btn-warning">-</button>
                  </div>
                  <div class = "col-1">
                    <button type="button" class="btn btn-info">1</button>
                  </div>
                  <div class = "col-1">
                    <button type="button" class="btn btn-success">+</button>
                  </div>
                </div>
              </form>
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
              <form>
                <button type="button" class="btn btn-danger">Quitar</button>
              </form>
            </div>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-8"></div>
            <div class = "col-2">
              <img src="../../resources/carrito.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$28,000</span>
              <form>
                <a href = "c-pagando.html">
                  <button type="button" class="btn btn-success">Pagar</button>
                </a>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>    
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/bootstrap.bundle.js"></script>

</body>
</html>