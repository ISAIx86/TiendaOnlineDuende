<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuidado con el Duende - Dirección</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/register.css">
    <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
    <!-- Header -->
    <?php include __ROOT."html/templates/headerComprador.php"?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class = "row">
            <div class = "col-12">
                <div class="form-container">
                    <div class="header">
                        <h2>Mi Dirección</h2>
                    </div>
                    <form class="form" id="form_direc">
                        <div class="form_control" requerido="true" state="empt">
                            <select id="cbx_estado" form="form" name="in_estado">
                                <option disabled selected>Estado</option>
                                <option value="comprador">Nuevo León</option>
                                <option value="vendedor">CDMX</option>
                                <option value="compravende">Jalisco</option>
                            </select>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_municipio" name="in_municipio" maxlength="32" placeholder="Municipio">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_colonia" name="in_colonia" maxlength="32" placeholder="Colonia">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_calle" name="in_calle" maxlength="32" placeholder="Calle">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_noext" name="in_noext" maxlength="16" placeholder="No Exterior">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_noint" name="in_noint" maxlength="16" placeholder="No Exterior">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <button>Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include __ROOT."html/templates/footer.php"?>

    <script src="../../js/lib/bootstrap.bundle.js"></script>
    <script src="../../js/lib/jquery-3.6.1.js"></script>
    <script src="../../js/utilities/validaciones.js"></script>
    <script src="../../js/comprador/regDireccion.js"></script>

</body>
</html>