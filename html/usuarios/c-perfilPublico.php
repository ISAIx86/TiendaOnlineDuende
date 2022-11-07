<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende</title>
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
            <div class = "col-4">
                <img src='resources/dongato.PNG' class='imgRedonda150' />
            </div>
            <div class = "col-4">
                <h2>DonGatox16</h2>
                <h3>Comprador</h3>
                <h4>2 Listas</h4>
            </div>
        </div>
        <div class = "row">
            <div class = "col-8">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Lista de verano </div>
                        Content for list item
                      </div>
                      <span class="badge bg-primary rounded-pill">3</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Lista de cumpleaños</div>
                        Content for list item
                      </div>
                      <span class="badge bg-primary rounded-pill">8</span>
                    </li>
                  </ul>
            </div>            
        </div>
       
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>

</body>
</html>