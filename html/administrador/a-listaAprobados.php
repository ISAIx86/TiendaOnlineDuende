<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reporte Ventas</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href = "../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php
    require_once __ROOT."html/templates/headerAdministrador.php";
    require_once __ROOT."php/models/producto-model.php";
    require_once __ROOT."php/classes/productos/producto_contr.classes.php";
    $lista = array();
    if (isset($_SESSION['user'])) {
      $controller = new ProductoController();
      $lista = $controller->obtenerPeticiones();
    }
  ?>
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
              </div>      
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class = "container" id = "tablaVentas">
      <div class = "row">
        <div class="cointainer">
          <ul id="disp_pedidos" class="list-group">
          <?php foreach($lista as &$prod) {
            $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
          ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
              <div class = "row">
                <div class = "col-2">
                  <img src=<?php echo $imageSrc?> class="d-block w-100" alt="...">
                </div>
                <div class = "col-8">
                  <h6>Titulo: <?php echo $prod['out_titulo']?></h6>
                  <p>Descripción: <?php echo $prod['out_descripcion']?></p>
                  <?php if ($prod['out_cotiz']) { ?>
                    <h3>Cotizado</h3>
                  <?php } else { ?>
                    <h3><?php echo $prod['out_precio']?></h3>
                  <?php } ?>
                </div>
                <div class = "col-2">
                  <a href="a-aprobarproducto.php?prod=<?php echo $prod['out_prodid']?>" class="btn btn-primary">Ver detalles</a>
                </div>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>
  
  <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>
</html>