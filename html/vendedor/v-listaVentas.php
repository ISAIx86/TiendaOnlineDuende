<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duence - Reporte Ventas</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php
  require_once __ROOT."html/templates/headerVendedor.php";
  require_once __ROOT."php/models/categoria-model.php";
  require_once __ROOT."php/models/pedido-model.php";
  require_once __ROOT."php/classes/categorias/categoria_contr.classes.php";
  require_once __ROOT."php/classes/pedidos/pedidos_contr.classes.php";
  $catcontroller = new CategoriaController();
  $pedcontroller = new PedidosController();
  $categos = $catcontroller->obtenerTodos();
  $ventas = array();
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
    $ventas = $pedcontroller->ventasDetallada($_SESSION['user']['ID'], $cat, $stdt, $eddt);
  }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <div class="container text-center">
          <div class="row">
            <form action='v-listaVentas.php' method='get'>
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
    <div class = "container" id = "tablaVentas">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">Fecha</th>
              <th scope="col">Categoria</th>
              <th scope="col">Producto</th>
              <th scope="col">Calificación</th>
              <th scope="col">Precio</th>
              <th scope="col">Existencia</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($ventas as &$vent) { ?>
            <tr>
              <td><?php echo $vent['out_fecha']?></td>
              <td><?php echo $vent['out_catego']?></td>
              <td><?php echo $vent['out_prod']?></td>
              <td><?php echo $vent['out_calif']?></td>
              <td>$<?php echo $vent['out_precio']?></td>
              <td><?php echo $vent['out_dispo']?></td>                       
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php" ?>

  <script src="../../js/bootstrap.bundle.js"></script>

</body>
</html>