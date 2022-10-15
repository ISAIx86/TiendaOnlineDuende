<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Aceptar cotización</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php include("./templates/headerComprador.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./resources/p02.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <video src="./resources/videoprueba.mp4" controls autoplay> Vídeo no es soportado... </video>
            </div>
            <div class="carousel-item">
              <video src="./resources/clipShort.mp4" controls autoplay> Vídeo no es soportado... </video>
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
              <p class="card-text">Figura de accion de coleccion </p>
            </div>
            <div>
              <h3> $1,599 </h3>
              <h5> Vigencia 16-09-2022 </h5>
            </div>
            <div>
              <h6>IVA incluido</h6>
            </div>
            <div>
              <h6>Stock Disponible</h6>
            </div>
            <div>
              <h7>Cotización por 3 piezas</h7>
            </div>
            <div class ="container">
              <form>
                <div class="row">
                  <div class="col-4"></div>
                </div>
                <div class="row">          
                  <div class="col">
                    <button type="button" class="btn btn-info">Agregar a carrito</button>
                  </div>
                </div>
              </form>
              <div class = "row">
                <div class="col">
                  <button type="button" class="btn btn-warning">No aceptar</button>
                </div>
              </div>
            </div>   
            <p></p>
          </div>
        </div>
      </div>
    </div> 
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>

</body>
</html>