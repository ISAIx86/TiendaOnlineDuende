<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi lista</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>

  <!-- Header -->
  <?php include __ROOT."html/templates/headerComprador.php"?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Mis pedidos</h1>
    <div class="cointainer">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>13/9/2022</h6>
              <h6>Calificación: 5</h6>                     
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
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
              <h6>13/9/2022</h6>
              <h6>Calificación: 5</h6>                     
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
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
              <h6>13/9/2022</h6>
              <h6>Calificación: 5</h6>
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
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