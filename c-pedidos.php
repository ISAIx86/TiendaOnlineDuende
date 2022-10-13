<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mis pedidos</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/Nuevo.css">
</head>
<body>
  <!-- Header -->
  <?php include("./templates/headerComprador.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <div class="container text-center">
          <h1>Mis pedidos</h1>
        </div>
      </div>
      <div class ="row">
      </div>
    </div>
    <div class = "container" id = "tablaVentas">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Fecha</th>
              <th scope="col">Categoria</th>
              <th scope="col">Producto</th>
              <th scope="col">Calificación</th>
              <th scope="col">Precio</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>13/9/2022, 21:43:30</td>
              <td>Computadoras</td>
              <td>Computadora gamer</td>
              <td>5</td>
              <td>$12,500</td>
            </tr>
            <tr>
                        <th scope="row">2</th>
                        <td>13/9/2022, 21:43:30</td>
                        <td>Oficina</td>
                        <td>Silla</td>
                        <td>4</td>
                        <td>$4,500</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>13/9/2022, 21:43:30</td>
              <td>Belleza</td>
              <td>Maquillaje</td>
              <td>3</td>
              <td>$12,500</td>
            </tr>
            <tr>
              <th scope="row">4</th>
              <td>13/9/2022, 21:43:30</td>
              <td>Computadoras</td>
              <td>Computadora gamer</td>
              <td>5</td>
              <td>$12,500</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>
  <script src="./js/navComprador.js "></script>

</body>
</html>