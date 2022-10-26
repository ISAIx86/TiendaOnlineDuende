<?php
include("php/classes/filemanager.classes.php");
$root = FilesManager::rootDirectory();
session_start();
if (isset($_SESSION['user'])) {
    $current_user = $_SESSION['user'];
    switch($current_user['Rol']) {
        case 'comprador':
            header("Location: $root/usuarios/c-home.php");
            exit();
            break;
        case 'vendedor':
            header("Location: $root/usuarios/c-profile.php");
            exit();
            break;
        case 'administrador':
            header("Location: $root/usuarios/c-profile.php");
            exit();
            break;
        case 'compravende':
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuidado con el duende</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href = "./css/Nuevo.css">
</head>
<body>
    <header>
        <div class="container_menu">
            <div class="logo">
                <img src="./resources/logo02.png" alt="">
            </div>
            <div class="menu">
                <nav id="nav">
                    <ul>
                        <li><button onclick="location.href='./registro.html'" type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Registrarse</button></li>
                        <li><button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Ayuda</button></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
        <div class="container_portada">
            <div class="portada">
                <div class="Parte1">
                    <div class = "row" id="Carusel">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="resources/producto01.PNG" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/producto02.PNG" class="d-block w-100">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/producto03.PNG" class="d-block w-100">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="text">
                        <h1>Cuidado con el Duende.</h1>
                        <p>Los mejores productos de ensueño, solo en ¡Cuidado con el Duende!</p>
                        <p>Una plataforma segura y confiable para llevar a delante tu negocio. Y si eres comprador, aquí encontraras lo que buscas al mejor precio.</p>
                        <p>Miles de personas están comprando y vendiendo en Cuidado con el Duende. Registrate y explora el mejor mercado en línea.</p>
                    </div>
                </div>
                <div class="form-container">
                    <div class="header">
                        <h2>Inicia sesión</h2>
                    </div>
                    <form class="form" id="form_login">
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="email" id="txt_correo" name="in_correo" placeholder="Correo electrónico">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-exclamation-circle"></i>
                            <small>Error</small>
                        </div>
                        <div class="form_control" requerido="true" state='empt'>
                            <input type="password" id="txt_password" name="in_password" placeholder="Contraseña" minlength="8">
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
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/jquery-3.6.1.js"></script>
    <script src="./js/validaciones.js"></script>
    <script src="./js/registro.js"></script>
</body>
</html>