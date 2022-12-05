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
  <?php 
    require_once __ROOT."html/templates/headerAdministrador.php";
    require_once __ROOT."php/models/producto-model.php";
    require_once __ROOT."php/models/multimedia-model.php";
    require_once __ROOT."php/classes/productos/producto_contr.classes.php";
    require_once __ROOT."php/classes/multimedia/multimedia_contr.classes.php";
    $infoProd = array();
    $filesProd = array();
    if (isset($_GET['prod'])) {
      $controller = new ProductoController();
      $infoProd = $controller->obtenerProductoAutorizar($_GET['prod']);
      $controllermult = new MultimediaController();
      $filesProd = $controllermult->obtenerArchivos($_GET['prod']);
    }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div id="mda_carousel" class="carousel-inner">
            <div class="carousel-inner">
              <?php
                foreach ($filesProd as &$file) {
                  if ($file['out_tipo'] == 'i') {
                    $imageSrc = '"data:image/jpg;base64,'.base64_encode($file["out_cont"]).'"';
              ?>
                <div class="carousel-item active">
                  <img src=<?php echo $imageSrc ?> class="d-block w-100" alt="...">
                </div>
              <?php 
                  } else if ($file['out_tipo'] == 'v') {
              ?>
                <div class="carousel-item">
                  <video src="../../<?php echo $file['out_dir']?>" controls autoplay> Vídeo no es soportado... </video>
                </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#mda_carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#mda_carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class = "col-6">
        <div class="card">
          <div class="card-body">
            <div>
              <h5 class="card-title"><?php echo $infoProd['out_titulo']?></h5>
            </div>
            <div>
              <p class="card-text"><?php echo $infoProd['out_descripcion']?></p>
            </div>
            <div>
              <?php if ($infoProd['out_cotiz']) { ?>
                <h3>Cotizado</h3>
              <?php } else { ?>
                <h3><?php echo $infoProd['out_precio']?></h3>
              <?php } ?>
            </div>
            <div class ="container">
              <div class="col">
                <button id="btn_auto" type="button" class="btn btn-success">Aprobar</button>
              </div>
              <div class="col">
                <button id="btn_deny" type="button" class="btn btn-danger">Denegar</button>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div> 
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/administrador/aprobar.js"></script>

</body>
</html>