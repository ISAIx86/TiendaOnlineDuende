<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";

require_once __ROOT."php/models/superadmin-model.php";
require_once __ROOT."php/classes/superadmin/superadmin_contr.classes.php";
$controller = new SuperAdminController();
$admins = $controller->peticionesUsuarios();
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
  <?php require_once __ROOT."html/templates/headerSadmin.php";?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "container">
      <div class = "row">
        <table class="table table-sm table-dark">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Correo</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Usuario</th>
              <th scope="col">Fecha nacimiento</th>
              <th scope="col">Sexo</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($admins as &$admin) {
            $imageSrc = '"data:image/jpg;base64,'.base64_encode($admin['out_avatar']).'"';
          ?>
            <tr id="adm_row" idusu=<?php echo $admin['out_id']?> >
              <td><img class='imgRedonda' src=<?php echo $imageSrc?> class="d-block w-100"></td>
              <td><?php echo $admin['out_correo']?></td>
              <td><?php echo $admin['out_nombres']?></td>
              <td><?php echo $admin['out_apellidos']?></td>
              <td><?php echo $admin['out_username']?></td>
              <td><?php echo $admin['out_fecnac']?></td>
              <td><?php echo $admin['out_sexo']?></td>
              <td>
                <div class="input-group mb-1">
                <button id="btn_auto" class="btn btn-outline-secondary col-6" type="button">Autorizar</button>
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
  <script src="../../js/superadmin/autorizaciones.js"></script>

</body>
</html>