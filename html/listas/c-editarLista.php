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
    <?php
        require_once __ROOT."html/templates/headerComprador.php";
        require_once __ROOT."php/models/lista-model.php";
        require_once __ROOT."php/classes/listas/lista_contr.classes.php";
        $infoLista = array();
        if ($_GET['list']) {
            $controller = new ListaController();
            $infoLista = $controller->obtenerInfoLista($_GET['list'], $_SESSION['user']['ID']);
        } else {
            header("Location:../comprador/c-home.php");
            exit();
        }
    ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <h5>Editar lista</h5>
        <div class = "row">
            <form id="form_lista_upd">
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
                        <input type="text" class="form-control" id="txt_nombre" name="in_nombre" list="datalistOptions" value="<?php echo $infoLista['out_nombre']?>">
                    </div>
                    <small>Error</small>
                </div>
                <div class="form_control" requerido="true" state='empt'>
                    <div class="mb-3">
                        <label for="in_descrip" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="txt_descrip" name="in_descrip" rows="3"><?php echo $infoLista['out_descripcion']?></textarea>
                    </div>
                    <small>Error</small>
                </div>
                <div class="form_control" requerido="false" state='empt'>
                    <div class="mb-3">
                        <div class = "row">
                            <div class = "col-6">
                                <div class="form-check">
                                    <input class="form-check-input" id="rdb_publ" type="radio" name="in_privacidad" value="0" <?php if ($infoLista['out_privacidad'] == "0") {?>checked<?php }?>>
                                    <label class="form-check-label" for="rdb_publ">
                                        Público
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="rdb_priv" type="radio" name="in_privacidad" value="1" <?php if ($infoLista['out_privacidad'] == "1") {?>checked<?php }?>>
                                    <label class="form-check-label" for="rdb_priv">
                                        Privado
                                    </label>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Editar</button>
                </div>
            </form>
        </div>
    </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/utilities/validaciones.js"></script>
  <script src="../../js/listas/crearLista.js"></script>
  <script src="../../js/listas/checarCampos.js"></script>

</body>
</html>