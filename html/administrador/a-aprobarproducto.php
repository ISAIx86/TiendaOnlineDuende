<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador - Aprobar productos</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href = "../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php include_once __ROOT."html/templates/headerAdministrador.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class = "col-6">
        <div class="card">
          <div class="card-body">
            <div>
              <h5 class="card-title">Computadora Gamer de Ultima Generación</h5>
            </div>
            <div>
              <h6 class="card-subtitle mb-2 text-muted">Nuevo</h6>
            </div>
            <div>
              <p class="card-text">-Pc de escritorio solo agrega tu monitor preferido HD o incluso 4k (soporta monitores con entrada VGA y HDMI capacidad de hasta 2 monitores simultáneos) </p>
            </div>
            <div>
              <h3>$15,999</h3>
            </div>
            <div>
              <h6>IVA incluido</h6>
            </div>
            <div>
              <h6>Stock Disponible</h6>
            </div>
            <div>
              <h7>5 Disponibles</h7>
            </div>
            <div class ="container">
              <form class="row">
                <div class="col">
                  <button type="button" class="btn btn-success">Aprobar</button>
                </div>
                <div class="col">
                  <button type="button" class="btn btn-danger">Denegar</button>
                </div>
              </form>
            </div> 
          </div>
        </div>
      </div>
    </div> 
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>
</html>