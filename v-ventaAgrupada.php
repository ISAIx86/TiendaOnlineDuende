<?php include_once("./templates/get_session.php") ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Reporte Ventas</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href = "./css/style.css">
</head>
<body>
  <!-- Header -->
  <?php include_once("./templates/headerVendedor.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <div class="container text-center">
          <div class="row">
            <div class="col-sm-6">
              <div class = "row">
                <div class="col-6 col-sm-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Todas las categorias</option>
                    <option value="1">Computadoras</option>
                    <option value="2">Oficina</option>
                    <option value="3">Belleza</option>
                  </select>
                </div>
                <div class="col-6 col-sm-6">
                  <button type="button" class="btn btn-info">Filtrar</button>
                </div>     
                <div class="col-6 col-sm-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Mayo</option>
                    <option value="3">Diciembre</option>
                  </select>
                </div>
                <div class="col-6 col-sm-6">
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Año</option>
                    <option value="1">2020</option>
                    <option value="2">2021</option>
                    <option value="3">2022</option>
                  </select>
                </div>  
              </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class = "container" id = "tablaVentas">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Categoria</th>
              <th scope="col">Producto</th>
              <th scope="col">Califación</th>
              <th scope="col">Total</th>
              <th scope="col">Ventas</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Computadoras</td>
              <td>Computadora gamer</td>
              <td>5</td>
              <td>$82,500</td>
              <td>5</td>                       
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Oficina</td>
              <td>Silla</td>
              <td>4</td>
              <td>$44,500</td>
              <td>13</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Belleza</td>
              <td>Maquillaje</td>
              <td>3</td>
              <td>$42,500</td>
              <td>75</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include_once("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>

</body>
</html>
