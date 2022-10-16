<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Metodo de pago</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/register.css">
    <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
</head>
<body>
    <!-- Header -->
    <?php
    
        include("./templates/headerComprador.php");
        include (__DIR__.'/php/models/usuario-model.php');
        include (__DIR__.'/php/classes/usuario_contr.classes.php');

        if (isset($_SESSION['user'])) {
            $buscar_usuario = Usuario::create()->setID($_SESSION['user']['ID']);
            $controller = new UsuarioContr($buscar_usuario);
            $userData = $controller->obtenerDatos();
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
                            <input type="file" id="fle_fotoperfil" name="FotoPerfil">
                        </div>
                        <div class="form_control" requerido="true" state="empt">
                            <input type="text" id="txt_nombres" name="in_nombres" maxlength="64" placeholder="Nombres" value="<?php echo $userData['Nombres'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_apellidos" name="in_apellidos" maxlength="64" placeholder="Apellidos" value="<?php echo $userData['Apellidos'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state="empt">
                            <div >Género:</div>
                            <?php
                                switch($userData['Sexo']) {
                                    case 'Hombre': ?>
                                <input type="radio" id="rdb_h" name="in_genero" value="H" checked>
                                <label for="rdb_h">Hombre</label>
                                <input type="radio" id="rdb_m" name="in_genero" value="M">
                                <label for="rdb_m">Mujer</label>
                                <input type="radio" id="rdb_o" name="in_genero" value="O">
                                <label for="rdb_o">Otro</label>
                            <?php
                                        break;
                                    case 'Mujer': ?>
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
                        <div class="form_control" requerido="true" state='empt'>
                            <div >Fecha de nacimiento:</div>
                            <input type="date" id="txt_fechanac" name="in_fechanac" placeholder="Fecha de nacimiento" value="<?php echo $userData['Fecha_nac'] ?>">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="text" id="txt_username" name="in_username" maxlength="32" placeholder="Nombre de usuario" value="<?php echo $userData['Username'] ?>">
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
                            <input type="email" id="txt_correo" name="in_correo" maxlength="256" placeholder="Correo electrónico" value="<?php echo $userData['Correo'] ?>">
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
    <?php include("./templates/footer.php") ?>

    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/jquery-3.6.1.js"></script>
    <script src="./js/validaciones.js"></script>
    <script src="./js/checarCampos.js"></script>
    <script src="./js/registro.js"></script>

</body>
</html>