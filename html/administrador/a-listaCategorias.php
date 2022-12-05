<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SUPERADMIN - AUTORIZACIONES</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php
  require_once __ROOT."html/templates/headerAdministrador.php";
  require_once __ROOT."php/models/categoria-model.php";
  require_once __ROOT."php/classes/categorias/categoria_contr.classes.php";
  $categosList = array();
  if (isset($_SESSION['user'])) {
    $controller = new CategoriaController();
    $categosList = $controller->obtenerPeticiones();
  }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Descripción</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($categosList as &$catego) { ?>
            <tr id="cat_row" idcat=<?php echo $catego['out_id']?>>
              <td><?php echo $catego['out_nombre']?></td>
              <td><?php echo $catego['out_descripcion']?></td>
              <td>
                <div class="input-group mb-1">
                    <button id="btn_auto" class="btn btn-outline-secondary col-6" type="button">Autorizar</button>
                </div>
              </td>
              <td>
                <div class="input-group mb-1">
                    <button id="btn_deny" class="btn btn-outline-secondary col-6" type="button">Denegar</button>
                </div>
              </td>
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
  <script src="../../js/categorias/autorizaciones.js"></script>

</body>
</html>