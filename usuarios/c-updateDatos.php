<?php
include_once("../templates/get_session.php");
$root = FilesManager::rootDirectory();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuidado con el Duenda - Modificar información</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">
    <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
    <!-- Header -->
    <?php
        switch ($loggedUser['Rol']) {
            case "comprador":
                include_once("$root/templates/headerComprador.php");
                break;
            case "vendedor":
                include_once("$root/templates/headerVendedor.php");
                break;
            case "administrador":
                include_once("$root/templates/headerAdministrador.php");
                break;
            case "compravende":
                include_once("$root/templates/headerCompraVende.php");
                break;
        }
        
        include ("$root/php/models/usuario-model.php");
        include ("$root/php/classes/usuarios/usuario_contr.classes.php");

        if (isset($_SESSION['user'])) {
            $controller = new UsuarioContr();
            $userData = $controller->obtenerDatos($_SESSION['user']['ID']);
            if (gettype($userData) == "string") {
                switch ($userData) {
                    case "uncaptured_id":
                        header("Location: $root/index.php");
                        break;
                    case "not_found":
                        header("Location: $root/index.php");
                        break;
                }
            } else if (!$userData) {
                header("Location: $root/index.php");
            }
        }
    ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class = "row">
            <div class = "col-12">
                <div class="form-container">
                    <div class="header">
                        <h2>Actualizar Datos</h2>
                    </div>
                    <form class="form" id="form_registro_upd">
                        <div class="form_control" requerido="false" state='empt'>
                            <label for="FotoPerfil">Foto de perfil:</label>
                            <input type="file" id="fle_fotoperfil" name="in_fotoperfil">
                        </div>
                        <div class="form_control" requerido="true" state="empt">
                            <input type="text" id="txt_nombres" name="in_nombres" maxlength="64" placeholder="Nombres" value="<?php echo $userData['rs_nombres'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_apellidos" name="in_apellidos" maxlength="64" placeholder="Apellidos" value="<?php echo $userData['rs_apellidos'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state="empt">
                            <div >Género:</div>
                            <?php
                                switch($userData['rs_sexo']) {
                                    case 'H': ?>
                                <input type="radio" id="rdb_h" name="in_genero" value="H" checked>
                                <label for="rdb_h">Hombre</label>
                                <input type="radio" id="rdb_m" name="in_genero" value="M">
                                <label for="rdb_m">Mujer</label>
                                <input type="radio" id="rdb_o" name="in_genero" value="O">
                                <label for="rdb_o">Otro</label>
                            <?php
                                        break;
                                    case 'M': ?>
                                <input type="radio" id="rdb_h" name="in_genero" value="H">
                                <label for="rdb_h">Hombre</label>
                                <input type="radio" id="rdb_m" name="in_genero" value="M" checked>
                                <label for="rdb_m">Mujer</label>
                                <input type="radio" id="rdb_o" name="in_genero" value="O">
                                <label for="rdb_o">Otro</label>
                            <?php
                                        break;
                                    default: ?>
                                <input type="radio" id="rdb_h" name="in_genero" value="H">
                                <label for="rdb_h">Hombre</label>
                                <input type="radio" id="rdb_m" name="in_genero" value="M">
                                <label for="rdb_m">Mujer</label>
                                <input type="radio" id="rdb_o" name="in_genero" value="O" checked>
                                <label for="rdb_o">Otro</label>
                            <?php
                                        break;
                                }
                            ?>
                        </div>
                        <div class="form_control" requerido="true" state="empt">
                            <div >Privacidad de cuenta:</div>
                            <?php
                                if ($userData['rs_privacidad']) {
                            ?>
                                <input type="radio" id="rdb_priv" name="in_privacidad" value="1" checked>
                                <label for="rdb_priv">Privado</label>
                                <input type="radio" id="rdb_publ" name="in_privacidad" value="0">
                                <label for="rdb_publ">Público</label>
                            <?php
                                } else {
                            ?>
                                <input type="radio" id="rdb_priv" name="in_privacidad" value="1">
                                <label for="rdb_priv">Privado</label>
                                <input type="radio" id="rdb_publ" name="in_privacidad" value="0" checked>
                                <label for="rdb_publ">Público</label>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <div >Fecha de nacimiento:</div>
                            <input type="date" id="txt_fechanac" name="in_fechanac" placeholder="Fecha de nacimiento" value="<?php echo $userData['rs_fecha_nac'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_username" name="in_username" maxlength="32" placeholder="Nombre de usuario" value="<?php echo $userData['rs_username'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <button>Actualizar</button>
                    </form>
                    <form class="form" id="form_correo_upd">
                        <div class="header">
                            <h2>Actualizar correo electrónico</h2>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="email" id="txt_correo" name="in_correo" maxlength="256" placeholder="Correo electrónico" value="<?php echo $userData['rs_correo'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <button>Actualizar correo electrónico</button>
                    </form>
                    <form class="form" id="form_contra_upd">
                        <div class="header">
                            <h2>Actualizar contraseña</h2>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="password" id="txt_prevpass" name="in_prevpass" minlength="8" maxlength="16" placeholder="Contraseña actual">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="password" id="txt_password" name="in_password" minlength="8" maxlength="16" placeholder="Contraseña">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <p id="pass_format" style="display:none">Tu contraseña debe tener: 1 Mayúscula, 1 minúscula, 1 número y 1 caracter especial.</p>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="password" id="txt_confirm" name="in_confirm" minlength="8" maxlength="16" placeholder="Confirmar contraseña">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <button>Actualizar contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include("$root/templates/footer.php") ?>

    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery-3.6.1.js"></script>
    <script src="../js/validaciones.js"></script>
    <script src="../js/checarCampos.js"></script>
    <script src="../js/registro.js"></script>

</body>
</html>