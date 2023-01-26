<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

use App\Controllers\CotizacionController;

$controller = new CotizacionController();
$cotizaciones = $controller->listaComprador($_SESSION['user']['ID']);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Cotizaciones</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php require_once __ROOT."html/templates/headerComprador.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Cotizaciones pendientes</h1>
    <div class="cointainer">
      <ul class="list-group">
        <?php foreach ($cotizaciones as &$cot) {
          $imageSrc = '"data:image/jpg;base64,'.base64_encode($cot['out_img']).'"';
          $imageUsr = '"data:image/jpg;base64,'.base64_encode($cot['out_pavatar']).'"';
        ?>
        <li id="cot_row" class="list-group-item d-flex justify-content-between align-items-start" cotid=<?php echo $cot['out_id']?>>
          <div class = "row">
            <div class = "col-2">
              <h6><?php $cot['out_titulo']?><h6>
              <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold"><?php echo $cot['out_puser']?></div>
              <h6>Cantidad solicitda: <?php echo $cot['out_cantidad']?></h6>
              <h6>Fecha: <?php echo $cot['out_fechamod']?></h6>
            </div>
            <div class = "col-2">
              <a href="c-cotizado.php?cotiz=<?php echo $cot['out_id']?>"><button class="btn btn-danger">Ver detalles</button></a>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu">
                  <li><a id="btn_del" class="dropdown-item">Eliminar</a></li>
                </ul>
              </div>
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
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/cotizaciones/listas.js"></script>

</body>
</html>