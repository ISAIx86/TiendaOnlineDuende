<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Duende no encontró su oro</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <!-- Header -->
    <?php
        switch ($loggedUser['Rol']) {
            case "comprador":
                require_once __ROOT."html/templates/headerComprador.php";
                break;
            case "vendedor":
                require_once __ROOT."html/templates/headerVendedor.php";
                break;
            case "administrador":
                require_once __ROOT."html/templates/headerAdministrador.php";
                break;
            case "compravende":
                require_once __ROOT."html/templates/headerCompraVende.php";
                break;
        }
        $context = "Error desconocido";
        $message = "Algo salió mal. Tenemos un error inesperado.";
        $details = "";

        if (isset($_GET['context'])) {
            if ($GET['context'] != "") $context = $_GET['context'];
        }
        if (isset($_GET['message'])) {
            if ($GET['message'] != "") $message = $_GET['message'];
        }
        if (isset($_GET['details'])) {
            if ($GET['details'] != "") $details = $_GET['details'];
        }
    ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class="container">
            <div class = "row">
                <h1><?php echo $context?></h1>
                <p><?php echo $message?></p>
                <p><?php echo $details?></p>
                <a href="../../index.php">
                    <button type="button" class="btn btn-success">Volver al inicio</button>
                </a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include __ROOT."html/templates/footer.php"?>

    <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>
</html>