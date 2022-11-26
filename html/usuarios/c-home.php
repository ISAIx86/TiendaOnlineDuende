<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>¡Cuidado con el Duende!</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="../../css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php
  include_once __ROOT."html/templates/headerComprador.php";
  require_once __ROOT."php/classes/productos/busqueda_contr.classes.php";
  $d_recomend = array();
  $d_vistos = array();
  $d_vendidos = array();
  if (isset($_SESSION['user'])) {
    $controller = new BusquedaProdController();
    $d_recomend = $controller->masRecomendados();
    $d_vistos = $controller->masVistos();
    $d_vendidos = $controller->masVendidos();
  }
  ?>

  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../../resources/producto01.PNG" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../../resources/producto02.PNG" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="../../resources/producto03.PNG" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>

    <div class = "container" id = "recomendados">
      <div class = "row" id="Carusel03">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <div class = "container">
            <div id = "productosRecomendados">
              <div class = "row" >
                <h1>Productos Recomendados</h1>
              </div>
              <div class = "row" id="Carusel03">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner" id="disp_recomend">
                  <?php foreach($d_recomend as &$prod) {
                    $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
                  ?>
                    <div class="carousel-item active">
                      <div class = "row">
                        <div class = "col-4">
                          <div class="card" style="width: 18rem;">
                            <img src=<?php echo $imageSrc?> class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $prod['out_titulo'] ?></h5>
                              <p class="card-text"><?php echo $prod['out_descripcion'] ?></p>
                              <p class="card-text"><?php echo $prod['out_precio'] ?></p>
                              <a href="../producto/c-producto.php?prod=<?php echo $prod['out_id'] ?>" class="btn btn-primary">Ver detalles</a>
                            </div>
                          </div>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
      
          <div class = "container">
            <div id = "productosPopulares">
              <div class = "row" >
                <h1>Productos populares</h1>
              </div>
              <div class = "row" id="Carusel01">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner" id="disp_vistos">
                  <?php foreach($d_vistos as &$prod) {
                    $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
                  ?>
                    <div class="carousel-item active">
                      <div class = "row">
                        <div class = "col-4">
                          <div class="card" style="width: 18rem;">
                            <img src=<?php echo $imageSrc?> class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title"><?php echo $prod['out_titulo'] ?></h5>
                              <p class="card-text"><?php echo $prod['out_descripcion'] ?></p>
                              <p class="card-text"><?php echo $prod['out_precio'] ?></p>
                              <a href="../producto/c-producto.php?prod=<?php echo $prod['out_id'] ?>" class="btn btn-primary">Ver detalles</a>
                            </div>
                          </div>
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class = "container">
            <div id = "productosMasVendidos">
              <div class = "row" >
                <h1>Productos Más Vendidos</h1>
              </div>
              <div class = "row" id="Carusel02">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" id="disp_vendidos">
                    <?php foreach($d_vendidos as &$prod) {
                      $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
                    ?>
                      <div class="carousel-item active">
                        <div class = "row">
                          <div class = "col-4">
                            <div class="card" style="width: 18rem;">
                              <img src=<?php echo $imageSrc ?> class="card-img-top" alt="...">
                              <div class="card-body">
                                <h5 class="card-title"><?php echo $prod['out_titulo'] ?></h5>
                                <p class="card-text"><?php echo $prod['out_descripcion'] ?></p>
                                <p class="card-text"><?php echo $prod['out_precio'] ?></p>
                                <a href="../producto/c-producto.php?prod=<?php echo $prod['out_id'] ?>" class="btn btn-primary">Ver detalles</a>
                              </div>
                            </div>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php" ?>

  <script src="../../js/bootstrap.bundle.js"></script>

</body>
</html>