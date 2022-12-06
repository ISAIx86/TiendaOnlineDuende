<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
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
  <?php
        require_once __ROOT."html/templates/headerComprador.php";
        require_once __ROOT."php/models/lista-model.php";
        require_once __ROOT."php/classes/listas/list_contr.classes.php";
        $productos = array();
        if ($_GET['list']) {
            $controller = new ListaController();
            $productos = $controller->obtenerProductos($_GET['list']);
        } else {
            header("Location:../comprador/c-home.php");
            exit();
        }
    ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <h1>Titulo de lista</h1>
    <h6>Descripcion</h6>
    <div class = "row">
      <span>
        <img src='../../resources/dongato.PNG' class='imgCuadrada'/>
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
            </div>
          </div>
        </li>
        <?php } ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class = "row">
            <div class = "col-2">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class = "col-8">
              <div class="fw-bold">Titulo producto</div>
              <h6>Disponibilidad</h6>
              <h6>Calificacion</h6>
            </div>
            <div class = "col-2">
              <span class="badge bg-primary rounded-pill">Precio</span>
              <br/>
              <a href="../producto/c-producto.php?prod="><button type="button" class="btn btn-success">Ver producto</button></a>
            </div>
          </div>
        </li>
      </ul>
    </div>    
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>
</html>