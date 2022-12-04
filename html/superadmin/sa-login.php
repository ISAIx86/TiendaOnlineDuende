<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUPER ADMINISTRADOR</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/Nuevo.css">
</head>
<body>
    <header>
        <div class="container_menu">
            <div class="logo">
                <img src="../../resources/logo02.png" alt="">
            </div>
            <div class="menu">
                <nav id="nav">
                    <ul>
                        <li>INTERFAZ DE SUPER ADMINISTRADORES</li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="container_portada">
            <div class="portada">
                <div class="form-container">
                    <div class="header">
                        <h2>Inicia sesión</h2>
                    </div>
                    <form class="form" id="form_login">
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="email" id="txt_correo" name="in_correo" placeholder="Correo electrónico" autocomplete="on"> 
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="password" id="txt_password" name="in_password" placeholder="Contraseña" autocomplete="on">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <button>Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>   
    </main>
    <!--Footer-->
    <div class="container-footer">
        <footer>
            <h4>Todos los derechos Reservados 2022</h4>
        </footer>
    </div>
    <script src="../../js/lib/bootstrap.bundle.js"></script>
    <script src="../../js/lib/jquery-3.6.1.js"></script>
    <script src="../../js/utilities/validaciones.js"></script>
    <script src="../../js/superadmin/superadmin.js"></script>
</body>
</html>