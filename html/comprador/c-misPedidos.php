<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

use App\Controllers\CategoriaController;
use App\Controllers\PedidosController;

$catcontroller = new CategoriaController();
$pedcontroller = new PedidosController();
$categos = $catcontroller->obtenerTodos();
$pedidos = array();
$cat = null;
$stdt = null;
$eddt = null;
if (isset($_GET['in_cat'])) {
  if ($_GET['in_cat'] != "") $cat = $_GET['in_cat'];
}
if (isset($_GET['in_start'])) {
  if ($_GET['in_start'] != "") $stdt = $_GET['in_start'];
} 
if (isset($_GET['in_end'])) {
  if ($_GET['in_end'] != "") $eddt = $_GET['in_end'];
} 
if (isset($_SESSION['user'])) {
  $pedidos = $pedcontroller->histoPedidos($_SESSION['user']['ID'], $cat, $stdt, $eddt);
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi lista</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>

  <!-- Header -->
  <?php require_once __ROOT."html/templates/headerComprador.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
  <div class = "container">
      <div class = "row">
        <div class="container text-center">
          <div class="row">
            <form action='c-misPedidos.php' method='get'>
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-6 col-sm-6">
                    <label for="birthday">Fecha inicial:</label>
                    <input type="date" name="in_start">
                  </div>
                  <div class="col-6 col-sm-6">
                    <label for="birthday">Fecha final:</label>
                    <input type="date" name="in_end">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class = "row">
                  <div class="col-6 col-sm-6">
                    <select class="form-select" name="in_cat" aria-label="Default select example">
                      <option selected value="">Todas las categorias</option>
                      <?php foreach($categos as &$cat) { ?>
                      <option value=<?php echo $cat['out_nombre']?>><?php echo $cat['out_nombre']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-6 col-sm-6">
                      <button type="submit" class="btn btn-info">Filtrar</button>
                  </div>       
                </div>      
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <h1>Mis pedidos</h1>
    <div class="cointainer">
      <ul id="disp_pedidos" class="list-group">
      <?php foreach($pedidos as &$ped) {
        $imageSrc = '"data:image/jpg;base64,'.base64_encode($ped['out_img']).'"';
      ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <p>Folio: <?php echo $ped['out_folio']?></p>
              <div class="fw-bold"><?php echo $ped['out_prod']?></div>
              <h6>Precio: $<?php echo $ped['out_precio']?></h6>
              <p><?php echo $ped['out_catego']?></p>
              <div class="calificacion">
                <input id="cal1" type="radio" value="5" disabled <?php if ($ped['out_calif'] >= 5.0) { ?>checked<?php }?>>
                <label for="cal1">★</label>
                <input id="cal2" type="radio" value="4" disabled <?php if ($ped['out_calif'] >= 4.0 & $ped['out_calif'] < 4.9) { ?>checked<?php }?>>
                <label for="cal2">★</label>
                <input id="cal3" type="radio" value="3" disabled <?php if ($ped['out_calif'] >= 3.0 & $ped['out_calif'] < 3.9) { ?>checked<?php }?>>
                <label for="cal3">★</label>
                <input id="cal4" type="radio" value="2" disabled <?php if ($ped['out_calif'] >= 2.0 & $ped['out_calif'] < 2.9) { ?>checked<?php }?>>
                <label for="cal4">★</label>
                <input id="cal5" type="radio" value="1" disabled <?php if ($ped['out_calif'] >= 1.0 & $ped['out_calif'] < 1.9) { ?>checked<?php }?>>
                <label for="cal5">★</label>
              </div>
              <h6>Calificación: <?php echo $ped['out_calif']?></h6>
              <h6>Fecha y hora: <?php echo $ped['out_fecha']?></h6>
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">Cantidad: <?php echo $ped['out_cant']?></span>
              <br/>
              <span class="badge bg-primary rounded-pill">Total: $<?php echo $ped['out_total']?></span>
            </div>
          </div>
        </li>
      <?php } ?>
      </ul>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>