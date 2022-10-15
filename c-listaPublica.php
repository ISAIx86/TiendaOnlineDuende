<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php include("./templates/headerComprador.php") ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Lista de compus con lucecitas</h1>
    <h6>De</h6>
    <div class = "row">
      <span>
        <img src='resources/dongato.PNG' class='imgRedonda' />
        <h5>DonGatox16</h5>
      </span>  
    </div>
    <div class="cointainer">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>$ 14,000</h6>                   
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
              <form>
                <button type="button" class="btn btn-success">Regalar</button>
              </form>
            </div>
          </div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Computadora con lucecitas</div>
              <h6>$ 14,000</h6>                   
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">$14,000</span>
              <form>
                <button type="button" class="btn btn-success">Regalar</button>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </div>    
  </div>
  <!-- Footer -->
  <?php include("./templates/footer.php") ?>

  <script src="./js/bootstrap.bundle.js"></script>

</body>
</html>