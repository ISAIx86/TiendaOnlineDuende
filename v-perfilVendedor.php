<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <!-- Header -->
  <?php include("./templates/headerVendedor.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "container" id = "pagina">
        <div class = "row">
          <div class="container text-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
              <div class="col-auto" >
                <div class="card" style="width: 18rem;">
                  <img src="resources/p02.PNG" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Kokun supersallallin 3</h5>
                    <p class="card-text">Figura de coleción de anime</p>
                    <a href="c-productoCotizado.html" class="btn btn-primary">Ofertar</a>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="card" style="width: 18rem;">
                  <img src="resources/p01.PNG" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Compu con lucecitas</h5>
                    <p class="card-text">Computadora super rapida</p>
                    <a href="c-producto.html" class="btn btn-primary">Comprar</a>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="card" style="width: 18rem;">
                  <img src="resources/p03.PNG" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">Nutella</h5>
                    <p class="card-text">Crema de avellana</p>
                    <a href="c-producto.html" class="btn btn-primary">Comprar</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class = "row">
          <div class = "col-5"></div>
            <div class = "col-2">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
          </div>
          <div class = "col-5"></div>
        </div>
      </div>
    </div>  
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>

</body>
</html>