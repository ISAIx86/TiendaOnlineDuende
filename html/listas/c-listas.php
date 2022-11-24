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
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php include __ROOT."html/templates/headerComprador.php"?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Lista de Favoritos</h1>
    <div class="cointainer">
      <ul class="list-group">  

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-sm-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-sm-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>$ 14,000</h6>
              <div class = "row">
              <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-warning" data-toggle="button" aria-pressed="false" autocomplete="off">Agregar a carrito</button>
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-danger" data-toggle="button" aria-pressed="false" autocomplete="off">Quitar de la lista</button>
                </div>
                <div class="col-sm-3"></div>  
              </div>                   
            </div>
            <div class = "col-sm-2">
            </div>
          </div>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-sm-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-sm-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>$ 14,000</h6>
              <div class = "row">
              <div class="col-sm-3"></div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-warning" data-toggle="button" aria-pressed="false" autocomplete="off">Agregar a carrito</button>
                </div>
                <div class="col-sm-3">
                  <button type="button" class="btn btn-outline-danger" data-toggle="button" aria-pressed="false" autocomplete="off">Quitar de la lista</button>
                </div>
                <div class="col-sm-3"></div>  
              </div>                   
            </div>
            <div class = "col-sm-2">
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