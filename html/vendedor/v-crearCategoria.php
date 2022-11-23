<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Registrar categoria</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php include_once __ROOT."html/templates/headerVendedor.php"?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <form id="form_categoria">
        <div class="form_control" requerido="true" state='empt'>
          <div class="mb-3">
            <label for="in_nombre" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="txt_nombre" name="in_nombre" list="datalistOptions" placeholder="Ingrese una categoria...">
          </div>
        </div>
        <div class="form_control" requerido="true" state='empt'>
          <div class="mb-3">
            <label for="in_descrip" class="form-label">Descripcion</label>
            <textarea class="form-control" id="txt_descrip" name="in_descrip" rows="3"></textarea>
          </div>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary mb-3">Registrar</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/jquery-3.6.1.js"></script>
  <script src="../../js/validaciones.js"></script>
  <script src="../../js/crearCategoria.js"></script>

</body>
</html>