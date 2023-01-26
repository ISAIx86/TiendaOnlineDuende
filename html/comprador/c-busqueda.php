<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
$type = null;
$search = null;
if (isset($_GET['srch_type'])) {
  if ($_GET['srch_type'] != "") $type = $_GET['srch_type'];
} else {
  header("Location:".__ROOT."../../index.php");
  exit();
}
if (isset($_GET['in_search'])) {
  if ($_GET['in_search'] != "") $search = $_GET['in_search'];
}

use App\Controllers\BusquedaProdController;
use App\Controllers\UsuarioController;

$redirect = "";
$btn = "";
$data = array();
if ($type == "prod") {
  $redirect = "../producto/c-producto.php?prod=";
  $btn = "Ver producto";
  $controller = new BusquedaProdController();
  $resultset = $controller->busquedaAvanzada($search);
  foreach($resultset as &$row) {
    array_push(
      $data,
      array(
        'id'=>$row['out_id'],
        'img'=>$row['out_img'],
        'title'=>$row['out_titulo'],
        'subtitle'=>$row['out_descripcion'],
        'content'=>$row['out_precio'],
      )
    );
  } 
} else if ($type == "user") {
  require_once __ROOT."php/models/usuario-model.php";
  require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
  $redirect = __ROOT."html/usuarios/c-perfil.php?user=";
  $btn = "Ver perfil";
  $controller = new UsuarioController();
  $resultset = $controller->busquedaAvanzada($search);
  foreach($resultset as &$row) {
    array_push(
      $data,
      array(
        'id'=>$row['out_id'],
        'img'=>$row['out_avatar'],
        'title'=>$row['out_user'],
        'subtitle'=>"",
        'content'=>"",
      )
    );
  } 
} else {
  header("Location:".__ROOT."../../index.php");
  exit();
}

?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Búsqueda</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php 
    switch ($loggedUser['Rol']) {
      case "comprador":
          include_once __ROOT."html/templates/headerComprador.php";
          break;
      case "vendedor":
          include_once __ROOT."html/templates/headerVendedor.php";
          break;
      case "administrador":
          include_once __ROOT."html/templates/headerAdministrador.php";
          break;
      case "compravende":
          include_once __ROOT."html/templates/headerCompraVende.php";
          break;
    }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class="col-auto">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
          <?php
          $count = 0;
          $size = count($data);
          $rows = (int)ceil((float)$size / 3);
          for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < 3; $j++) {
              if ($count >= $size) break;
              $imageSrc = '"data:image/jpg;base64,'.base64_encode($data[$count]["img"]).'"';
          ?>
          <div class="col-m">
            <div class="card" style="width: 18rem;">
              <img src=<?php echo $imageSrc?> class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $data[$count]["title"]?></h5>
                <p class="card-text"><?php echo $data[$count]["subtitle"]?></p>
                <p class="card-text"><?php echo $data[$count]["content"]?></p>
                <a href=<?php echo $redirect.$data[$count]['id']?> class="btn btn-primary"><?php echo $btn?></a>
              </div>
            </div>
          </div>
          <?php
              $count++;
            }
          }
          ?>
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
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/usuarios/busqueda.js"></script>

</body>
</html>