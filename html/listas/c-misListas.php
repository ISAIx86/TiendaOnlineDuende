<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi lista</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
  <!-- Header -->
  <?php
    require_once __ROOT."html/templates/headerComprador.php";
    require_once __ROOT."php/models/lista-model.php";
    require_once __ROOT."php/classes/listas/list_contr.classes.php";
    $misListas = array();
    if ($_GET['list']) {
        $controller = new ListaController();
        $misListas = $controller->obtenerListas($_SESSION['user']['ID']);
    } else {
        header("Location:../comprador/c-home.php");
        exit();
    }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Mis Listas</h1>
    <div class="container">
      <a href="c-crearLista.php"><button class="btn btn-success">Crear lista</button></a>
    <div class="cointainer">
      <ul class="list-group">
        <?php foreach ($misListas as &$lista) {
          $imageSrc = '"data:image/jpg;base64,'.base64_encode($lista['out_img']).'"';
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold"><?php echo $lista['out_nombre']?></div>
              <h6><?php echo $lista['out_nombre']?></h6>
              <?php if ($lista['privacidad']) {?>
              <h6>Privado</h6>
              <?php } else { ?>
              <h6>Público</h6>
              <?php } ?>
            </div>
            <div class = "col-2">
              <a href="c-lista.php?list=<?php echo $lista['out_id']?>"><button class="btn btn-danger">Ver lista</button></a>
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu">
                  <li><a href="c-editarLista.php?list=<?php echo $lista['out_id']?>" class="dropdown-item">Editar información</a></li>
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
  <script src="../../js/listas/crearLista.js"></script>

</body>
</html>