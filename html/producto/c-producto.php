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
  <style>
      .valoracion {
        position: relative;
        overflow: hidden;
        display: inline-block;
      }
      .valoracion input {
        position: absolute;
        top: -100px;
      }
      .valoracion label {
        float: right;
        color: #c1b8b8;
        font-size: 30px; 
      }
      .valoracion label:hover,
      .valoracion label:hover ~ label,
      .valoracion input:checked ~ label {
        color: #ecec00;
      }
  </style>
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
    require_once __ROOT."php/models/usuario-model.php";
    require_once __ROOT."php/models/producto-model.php";
    require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
    require_once __ROOT."php/classes/productos/producto_contr.classes.php";
    if (isset($_SESSION['user'])) {
        $controller = new UsuarioController();
        $userData = $controller->obtenerDatos($_SESSION['user']['ID']);
        if (gettype($userData) == "string") {
            switch ($userData) {
                case "uncaptured_id":
                    header("Location: ../../index.php");
                    break;
                case "not_found":
                    header("Location: ../../index.php");
                    break;
            }
        } else if (!$userData) {
            header("Location: ../../index.php");
        }
    }
    $infoProd = array("rs_id"=>"", "rs_titulo"=>"", "rs_descripcion"=>"", "rs_precio"=>"", "rs_dispo"=>"", "rs_calif"=>0.0);
    if (isset($_GET['prod'])) {
        $controller = new ProductoController();
        $infoProd = $controller->obtenerProducto($_GET['prod']);
    }
  ?>
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
                <video src="../../resources/clipShort.mp4" controls autoplay> Vídeo no es soportado... </video>
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
                <h5 class="card-title"><?php echo $infoProd['rs_titulo']?></h5>
            </div>
            <div>
                <p class="card-text"><?php echo $infoProd['rs_descripcion']?></p>
            </div>
            <div>
                <h3>$ <?php echo $infoProd['rs_precio']?></h3>
            </div>

            <?php if ($infoProd['rs_dispo']) { ?>
            <div>
              <h6>Stock Disponible</h6>
            </div>
            <div>
              <h7> <?php echo $infoProd['rs_dispo'] ?> Disponibles</h7>
            </div>
            <?php } else { ?>
            <h6>Sin Stock Disponible</h6>
            <?php } ?>
            
            <div class ="container">
              <form>
                <div class = "row">
                  <div class="col-4">
                    <label for="inputPassword2" class="visually-hidden">Cantidad</label>
                    <input type="text" class="form-control" id="inputPassword2" placeholder="Cantidad">
                  </div>
                </div>
                <div class="row">          
                  <div class="col">
                    <button type="button" class="btn btn-warning">Agregar a carrito</button>
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
              <div class="valoracion">
                <input id="radio1" type="radio" name="in_calif" value="5" disabled <?php if ($infoProd['rs_descripcion'] >= 5.0) { ?>checked<?php }?>>
                <label for="radio1">★</label>
                <input id="radio2" type="radio" name="in_calif" value="4" disabled <?php if ($infoProd['rs_descripcion'] >= 4.0 & $infoProd['rs_descripcion'] < 4.9) { ?>checked<?php }?>>
                <label for="radio2">★</label>
                <input id="radio3" type="radio" name="in_calif" value="3" disabled <?php if ($infoProd['rs_descripcion'] >= 3.0 & $infoProd['rs_descripcion'] < 3.9) { ?>checked<?php }?>>
                <label for="radio3">★</label>
                <input id="radio4" type="radio" name="in_calif" value="2" disabled <?php if ($infoProd['rs_descripcion'] >= 2.0 & $infoProd['rs_descripcion'] < 2.9) { ?>checked<?php }?>>
                <label for="radio4">★</label>
                <input id="radio5" type="radio" name="in_calif" value="1" disabled <?php if ($infoProd['rs_descripcion'] >= 1.0 & $infoProd['rs_descripcion'] < 1.9) { ?>checked<?php }?>>
                <label for="radio5">★</label>
              </div>
              <p><?php echo $infoProd['rs_calif']?></p>
            </div>
          </div>
        </div>
      </div>
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

  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/jquery-3.6.1.js"></script>
  <script src="../../js/producto.js"></script>

</body>
</html>