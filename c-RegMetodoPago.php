<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metodo de pago</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/Nuevo.css">
</head>
<body>
    <!-- Header -->
    <?php include("./templates/headerComprador.php") ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class = "row">
            <div class = "col-12">
                <div class="form-container">
                    <div class="header">
                        <h2>Registrar Metodo de pago</h2>
                    </div>
                    <form class="form" id="form_metopag">
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_propietario" name="in_correo" maxlength="128" placeholder="Nombre del propietario">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_numtarj" name="in_username" maxlength="19" placeholder="Numero de tarjeta XXXX-XXXX-XXXX-XXXX">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_venc" name="in_correo" maxlength="5" placeholder="Venciemiento MM/AA">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_cvv" name="in_username" maxlength="3" placeholder="CVV">
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
    <?php include("./templates/footer.php") ?>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/navComprador.js "></script>
    <script src="./js/jquery-3.6.1.js"></script>
    <script src="./js/validaciones.js"></script>
    <script src="./js/registroMetodoPago.js"></script>

</body>
</html>