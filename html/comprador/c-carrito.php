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
            <div class = "col-8"></div>
            <div class = "col-2">
              <img src="../../resources/carrito.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-2">
              <span id="lbl_total" class="badge bg-primary rounded-pill">$0</span>
                <a href="c-pagando.php">
                  <button type="button" class="btn btn-success">Pagar</button>
                </a>
            </div>
          </div>
        </li>
        <div id="lst_carrito">

        </div>
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