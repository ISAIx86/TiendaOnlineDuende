<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Solicita cotización</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
  <link rel="stylesheet" href="./css/comments.css">
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
  <?php include("./templates/headerComprador.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
      <div class = "row">
        <div class = "col-6">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="resources/p02.PNG" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <video src="resources/videoprueba.mp4" controls autoplay> Vídeo no es soportado... </video>
                  </div>
                  <div class="carousel-item">
                    <video src="resources/clipShort.mp4" controls autoplay> Vídeo no es soportado... </video>
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
                        <h5 class="card-title">Koku SSJ 3</h5>
                    </div>
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Nuevo</h6>
                    </div>
                    <div>
                        <p class="card-text">Figura de accion de coleccion </p>
                    </div>
                    <div>
                        <h3>  </h3>
                    </div>
                    <div>
                        <h6></h6>
                    </div>
                    <div>
                        <h6>Stock Disponible</h6>
                    </div>
                    <div>
                        <h7>5 Disponibles</h7>
                    </div>
                    <div>
                        <h7>Cantidad a cotizar: 3</h7>
                    </div>
                    <div class ="container">
                      <form>
                          <div class = "row">
                              
                              <div class="col-4">
                                  <label for="inputPassword2" class="visually-hidden">Cantidad</label>
                                  <input type="text" class="form-control" id="inputPassword2" placeholder="Precio a cotizar">
                              </div>
                          
                          </div>
                          <div class="row">          
                              <div class="col">
                                <button type="button" class="btn btn-warning">Enviar Cotización</button>
                              </div>
                          </div>
                      </form>
                      <div class = "row">
                    
                      </div>
                      
                    </div> 
                    <div>
                      
                      </div>
                    </div>
                   <p></p>
                </div>
              </div>
        </div>
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>
  <script src="js/jquery-3.6.1.js"></script>
  <script src="js/producto.js"></script>

</body>
</html>