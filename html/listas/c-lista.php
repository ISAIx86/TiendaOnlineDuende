<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

use App\Controllers\ListaController;
$productos = array();
$info = array();
if ($_GET['list']) {
    $controller = new ListaController();
    $info = $controller->obtenerInfoLista($_GET['list'], $_SESSION['user']['ID']);
    $productos = $controller->obtenerProductos($_GET['list']);
} else {
    header("Location:../templates/something_went_wrong.php?context=Lista perdida&message=El ID de la lista se perdió.");
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php require_once __ROOT."html/templates/headerComprador.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1><?php echo $info['out_nombre']?></h1>
    <h6><?php echo $info['out_descripcion']?></h6>
    <div class = "row">
      <?php $imageList = '"data:image/jpg;base64,'.base64_encode($info['out_img']).'"'; ?>
      <span>
        <img src=<?php echo $imageList?> class='imgCuadrada'/>
      </span>
    </div>
    <div class="cointainer">
      <ul class="list-group">
        <?php foreach($productos as &$prod) {
          $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold"><?php echo $prod['out_titulo']?></div>
              <h6><?php echo $prod['out_disponibilidad']?></h6>
              <div class="calificacion">
                <input id="cal1" type="radio" disabled <?php if ($prod['out_calif'] >= 5.0) { ?>checked<?php }?>>
                <label for="cal1">★</label>
                <input id="cal2" type="radio" disabled <?php if ($prod['out_calif'] >= 4.0 & $prod['out_calif'] < 4.9) { ?>checked<?php }?>>
                <label for="cañ2">★</label>
                <input id="cal3" type="radio" disabled <?php if ($prod['out_calif'] >= 3.0 & $prod['out_calif'] < 3.9) { ?>checked<?php }?>>
                <label for="cal3">★</label>
                <input id="cal4" type="radio" disabled <?php if ($prod['out_calif'] >= 2.0 & $prod['out_calif'] < 2.9) { ?>checked<?php }?>>
                <label for="cal4">★</label>
                <input id="cal5" type="radio" disabled <?php if ($prod['out_calif'] >= 1.0 & $prod['out_calif'] < 1.9) { ?>checked<?php }?>>
                <label for="cal5">★</label>
              </div>
              <h6><?php echo $prod['out_calif']?></h6>
            </div>
            <div class = "col-2">
              <?php if ($prod['out_cotiz']) {?>
                <span class="badge bg-primary rounded-pill">Cotizado</span>
              <?php } else {?>
                <span class="badge bg-primary rounded-pill">$<?php echo $prod['out_precio']?></span>
              <?php }?>
              <br/>
              <a href="../producto/c-producto.php?prod=<?php echo $prod['out_id']?>"><button type="button" class="btn btn-success">Ver producto</button></a>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu">
                  <li><a id="btn_del" idprod=<?php echo $prod['out_id']?> class="dropdown-item">Eliminar</a></li>
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
  <script src="../../js/listas/quitarProd.js"></script>

</body>
</html>