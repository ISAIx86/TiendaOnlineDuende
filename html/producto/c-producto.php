<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Producto</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="../../css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php 
    switch ($loggedUser['Rol']) {
        case "comprador":
            include_once __ROOT."html/templates/headerComprador.php";
            break;
        case "vendedor":
            include_once __ROOT."html/templates/headerVendedor.php";
            break;
        case "administrador":
            include_once __ROOT."html/templates/headerAdministrador.php";
            break;
        case "compravende":
            include_once __ROOT."html/templates/headerCompraVende.php";
            break;
    }

    require_once __ROOT."php/models/producto-model.php";
    require_once __ROOT."php/models/multimedia-model.php";
    require_once __ROOT."php/classes/productos/producto_contr.classes.php";
    require_once __ROOT."php/classes/multimedia/multimedia_contr.classes.php";
    
    $infoProd = array();
    $filesProd = array();
    $reviews = array();
    if (isset($_GET['prod'])) {
        $controller = new ProductoController();
        $infoProd = $controller->obtenerProducto($_GET['prod']);
        $controllermult = new MultimediaController();
        $filesProd = $controllermult->obtenerArchivos($_GET['prod']);
    }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
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
              <h5 class="card-title"><?php echo $infoProd['out_titulo']?></h5>
            </div>
            <div>
              <p class="card-text"><?php echo $infoProd['out_descripcion']?></p>
            </div>
            <div>
              <h3>$ <?php echo $infoProd['out_precio']?></h3>
            </div>

            <?php if ($infoProd['out_dispo'] > 0) { ?>
            <div>
              <h6>Stock Disponible</h6>
            </div>
            <div>
              <h7> <?php echo $infoProd['out_dispo'] ?> Disponibles</h7>
            </div>
            <?php } else { ?>
            <h6>Sin Stock Disponible</h6>
            <?php } ?>
            
            <div class ="container">
              <form>
                <div class = "row">
                  <div class="col-4">
                    <label for="inputPassword2" class="visually-hidden">Cantidad</label>
                    <input type="number" class="form-control" id="txt_cantidad" placeholder="Cantidad" min="1" max="256" onKeyDown="return false">
                  </div>
                </div>
                <div class="row">          
                  <div class="col">
                    <button id="btn_carrito" type="button" class="btn btn-warning">Agregar a carrito</button>
                  </div>
                </div>
              </form>
              <div class = "row">
                <div class="col">
                  <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Agregar a Lista
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Favoritos</a></li>
                      <li><a class="dropdown-item" href="#">Publica</a></li>
                      <li><a class="dropdown-item" href="#">Privada</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Nueva Lista</a></li>
                    </ul>
                  </div>  
                </div>
              </div>
            </div> 
            <div>
              <div class="calificacion">
                <input id="cal1" type="radio" disabled <?php if ($infoProd['out_calif'] >= 5.0) { ?>checked<?php }?>>
                <label for="cal1">★</label>
                <input id="cal2" type="radio" disabled <?php if ($infoProd['out_calif'] >= 4.0 & $infoProd['out_calif'] < 4.9) { ?>checked<?php }?>>
                <label for="cañ2">★</label>
                <input id="cal3" type="radio" disabled <?php if ($infoProd['out_calif'] >= 3.0 & $infoProd['out_calif'] < 3.9) { ?>checked<?php }?>>
                <label for="cal3">★</label>
                <input id="cal4" type="radio" disabled <?php if ($infoProd['out_calif'] >= 2.0 & $infoProd['out_calif'] < 2.9) { ?>checked<?php }?>>
                <label for="cal4">★</label>
                <input id="cal5" type="radio" disabled <?php if ($infoProd['out_calif'] >= 1.0 & $infoProd['out_calif'] < 1.9) { ?>checked<?php }?>>
                <label for="cal5">★</label>
              </div>
              <p><?php echo $infoProd['out_calif']?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ESTE DIV TIENE EL FORM DE CALIFICACION -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div>
              <h5>Califique el producto<h5>
            </div>
            <form id="form_calif">
              <input type="hidden" name="in_prodid" value=<?php echo $infoProd['out_id'] ?>>
              <label for="in_calif" class="form-label">Su calificación</label>
              <div class="form_control" requerido="true" state="empt">
                <div class="valoracion">
                  <input id="radio1" type="radio" name="in_val" value="5">
                  <label for="radio1">★</label>
                  <input id="radio2" type="radio" name="in_val" value="4">
                  <label for="radio2">★</label>
                  <input id="radio3" type="radio" name="in_val" value="3">
                  <label for="radio3">★</label>
                  <input id="radio4" type="radio" name="in_val" value="2">
                  <label for="radio4">★</label>
                  <input id="radio5" type="radio" name="in_val" value="1">
                  <label for="radio5">★</label>
                </div>
              </div>
              <div class="form_control" requerido="true" state="empt">
                <input type="text" class="form-control" id="txt_review" name="in_review" placeholder="¿Qué opina del producto?">
              </div>
              <button class="btn btn-primary">Calificar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ESTE DIV TIENE LOS REVIEW -->
    <div class="cointainer">
      <ul id="disp_pedidos" class="list-group">
        <?php foreach($reviews as &$rev) { ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <h6></h6>
              <img class='imgCuadrada' src="../../resources/default_user.jpg" class="d-block w-100" alt="...">
            </div>
            <div class = "col-10">
              <div class="calificacion">
                <input id="radio1" type="radio" value="5" disabled <?php if ($rev['out_calif'] >= 5.0) { ?>checked<?php }?>>
                <label for="radio1">★</label>
                <input id="radio2" type="radio" value="4" disabled <?php if ($rev['out_calif'] >= 4.0 & $rev['out_calif'] < 4.9) { ?>checked<?php }?>>
                <label for="radio2">★</label>
                <input id="radio3" type="radio" value="3" disabled <?php if ($rev['out_calif'] >= 3.0 & $rev['out_calif'] < 3.9) { ?>checked<?php }?>>
                <label for="radio3">★</label>
                <input id="radio4" type="radio" value="2" disabled <?php if ($rev['out_calif'] >= 2.0 & $rev['out_calif'] < 2.9) { ?>checked<?php }?>>
                <label for="radio4">★</label>
                <input id="radio5" type="radio" value="1" disabled <?php if ($rev['out_calif'] >= 1.0 & $rev['out_calif'] < 1.9) { ?>checked<?php }?>>
                <label for="radio5">★</label>
              </div>
              <p>Aqui aparece el comentario del cliente respecto a su opinion del producto.</p>
            </div>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
    <div class = "container">
      <div id = "productosRecomendados">
        <div class = "row" >
          <h3>Más productos del vendedor</h3>
        </div>
        <div class = "row" id="Carusel03">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
                <div class="carousel-item">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
                <div class="carousel-item">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
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
          <h3>Productos relacionados</h3>
        </div>
        <div class = "row" id="Carusel01">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
                <div class="carousel-item">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
                <div class="carousel-item">
                  <div class = "row">
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p03.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p02.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>
                    <div class = "col-4">
                      <div class="card" style="width: 18rem;">
                        <img src="../../resources/p01.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                    </div>                         
                  </div>
                </div>
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
    <section id="app">
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/productos/producto.js"></script>

</body>
</html>