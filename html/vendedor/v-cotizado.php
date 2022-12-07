<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

require_once __ROOT."php/classes/cotizaciones/cotizacion_contr.classes.php";

$cotiz = array();
if (isset($_GET['cotiz'])) {
  $controller = new CotizacionController();
  $cotiz = $controller->obtenerCotizacion($_GET['cotiz']);
} else {
  header("Location: ../templates/something_went_wrong.php?context='Producto perdido'&message=El ID del producto se perdió.");
  exit();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Cotizacion</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href = "../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php require_once __ROOT."html/templates/headerVendedor.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <?php $imageSrc = '"data:image/jpg;base64,'.base64_encode($cotiz["out_img"]).'"';?>
        <?php $compAvt = '"data:image/jpg;base64,'.base64_encode($cotiz["out_cavatar"]).'"';?>
        <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
      </div>
      <div class = "col-6">
        <div class="card">
          <div class="card-body">
            <div>
                <h5 class="card-title"><?php echo $infoProd['out_titulo']?></h5>
            </div>
            <div>
                <p class="card-text"><?php echo $infoProd['out_cuser']?></p>
                <img class='imgRedonda' src=<?php echo $compAvt?> e class="d-block w-100" alt="...">
            </div>
            <div>
                <p class="card-text">Cantidad: <?php echo $infoProd['out_ccant']?></p>
                <p class="card-text">Precio unitario: <?php echo $infoProd['out_cprecio']?></p>
            </div>
            <div>
                <label for="txt_cantidad" class="visually-hidden">Cantidad</label>
                <input type="number" class="form-control" id="txt_cantidad" placeholder="Cantidad" value="1" min="1" max="256" onKeyDown="return false">
                <label for="txt_precio" class="visually-hidden">Precio unitario</label>
                <input type="text" id="txt_precio" name="in_precio" class="form-control" maxlength="8" aria-label="Amount (to the nearest dollar)" autocomplete="off">
            </div>
            <div class ="container">
              <div class="col">
                <button id="btn_cambiar" type="button" class="btn btn-success">Cambiar</button>
              </div>
              <div class="col">
                <button id="btn_deny" type="button" class="btn btn-danger">Denegar</button>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div> 
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>

</body>
</html>