<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Crear lista</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include_once __ROOT."html/templates/headerComprador.php"?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <h5>Crear lista</h5>
        <div class = "row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
            <form id="form_lista">
                <div class="form_control" requerido="false" state='empt'>
                    <div class="mb-3">
                        <label for="fle_media" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="fle_img" name="in_img">
                    </div>
                    <small>Error</small>
                </div>
                <div class="form_control" requerido="true" state='empt'>
                    <div class="mb-3">
                        <label for="in_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="txt_nombre" name="in_nombre" list="datalistOptions" autocomplete="off">
                    </div>
                    <small>Error</small>
                </div>
                <div class="form_control" requerido="true" state='empt'>
                    <div class="mb-3">
                        <label for="in_descrip" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="txt_descrip" name="in_descrip" rows="3"></textarea>
                    </div>
                    <small>Error</small>
                </div>
                <div class="form_control" requerido="false" state='empt'>
                    <div class="mb-3">
                        <div class = "row">
                            <div class = "col-1">
                                <div class="form-check">
                                    <input class="form-check-input" id="rdb_publ" type="radio" name="in_privacidad" value="0" checked>
                                    <label class="form-check-label" for="rdb_publ">
                                        Público
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="rdb_priv" type="radio" name="in_privacidad" value="1">
                                    <label class="form-check-label" for="rdb_priv">
                                        Privado
                                    </label>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-success mb-3">Registrar</button>
                </div>
            </form>
            </div>
            <div class="col-sm-2"></div>

        </div>
    </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/utilities/validaciones.js"></script>
  <script src="../../js/listas/crearLista.js"></script>

</body>
</html>