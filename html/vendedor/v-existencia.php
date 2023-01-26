<?php
require_once "../../myautoload.php";
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

use App\Controllers\CategoriaController;
use App\Controllers\ProductoController;

$catcontroller = new CategoriaController();
$prodcontroller = new ProductoController();
$categos = $catcontroller->obtenerTodos();

$cat = null;
if (isset($_GET['in_cat'])) {
  if ($_GET['in_cat'] != "") $cat = $_GET['in_cat'];
}
$productos = $prodcontroller->existencias($_SESSION['user']['ID'], $cat);
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Reporte Ventas</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php require_once __ROOT."html/templates/headerVendedor.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <div class="container text-center">
          <div class="row">
            <div class="col-sm-6">
              <div class = "row">
                <form action="v-existencia.php" method="get">
                  <div class="col-6 col-sm-6">
                    <select class="form-select" aria-label="Default select example" name="in_cat">
                      <option selected value="">Todas las categorias</option>
                      <?php foreach($categos as &$cat) { ?>
                      <option value=<?php echo $cat['out_nombre']?>><?php echo $cat['out_nombre']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-6 col-sm-6">
                    <button type="submit" class="btn btn-info">Filtrar</button>
                  </div>
                </form>  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class = "container" id = "tablaVentas">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Categoria</th>
              <th scope="col">Producto</th>
              <th scope="col">Calificación</th>
              <th scope="col">Precio</th>
              <th scope="col">Existencia</th>
              <th scope="col">Añadir</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($productos as &$prod) {
            $imageSrc = '"data:image/jpg;base64,'.base64_encode($prod['out_img']).'"';
          ?>
            <tr id="prod_row" idprod=<?php echo $prod['out_prodid']?>>
              <td><img class='imgCuadrada' src=<?php echo $imageSrc?> class="d-block w-100"></td>
              <td><?php echo $prod['out_categos']?></td>
              <td><?php echo $prod['out_titulo']?></td>
              <td><?php echo $prod['out_calif']?></td>
              <td>
                <?php if ($prod['out_cotiz']) {?>
                  Cotizado
                <?php } else { 
                 echo $prod['out_precio'];
                 } ?>
              </td>
              <td><?php echo $prod['out_dispo']?></td>
              <td>
                <div class="input-group mb-1">
                <input id="txt_cant" type="number" class="form-control col-6" placeholder="Añadir" aria-label="Piezas" aria-describedby="button-addon2" min="1" max="256" onKeyDown="return false">
                <button id="btn_addex" class="btn btn-outline-secondary col-6" type="button">Agregar a inventario</button>
                </div>  
              </td>
              <td>
                <a href="v_editarProducto.php?prod=<?php echo $prod['out_prodid']?>">
                  <button class="btn btn-outline-secondary col-6">Editar</button>
                </a>
              </td>
              <td><button id="btn_del" class="btn btn-outline-secondary col-6" type="button">Eliminar</button></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php" ?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/vendedor/existencias.js"></script>

</body>
</html>