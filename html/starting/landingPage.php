<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuidado con el duende</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/Nuevo.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <header>
        <div class = "container-fluid" class="superior">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-sm-8">
                        <a href="../usuarios/c-home.php">
                            <img src='../../resources/logo02.PNG' class='logotipo'/>
                        </a>
                    </div>
                    <div class="col-sm-4" id = "ico-header" >
                        <div class = "row">
                            <div class = "col-6">
                                <button onclick='location.href="registro.html"' type="button" class="btn btn-outline-success" data-toggle="button" aria-pressed="false" autocomplete="off">Registrarse</button>
                            </div>
                            <div class = "col-6">
                                <button type="button" class="btn btn-outline-success" data-toggle="button" aria-pressed="false" autocomplete="off">Ayuda</button>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </header>
    <main>
        <div class = "container-fluid">
            <div class = "cointainer-xxl">
                <div class = "row">
                    <div class="col-sm-8">
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
                                            <img src="../../resources/producto01.PNG" class="d-block w-100">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../../resources/producto02.PNG" class="d-block w-100">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../../resources/producto03.PNG" class="d-block w-100">
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
                    </div>
                    <div class="col-sm-4">
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
            </div>
        </div>
    </main>
    <!--Footer-->
    <div class="container-footer">
        <footer>
            <h4>Todos los derechos Reservados 2022</h4>
        </footer>
    </div>
    <script src="../../js/bootstrap.bundle.js"></script>
    <script src="../../js/jquery-3.6.1.js"></script>
    <script src="../../js/validaciones.js"></script>
    <script src="../../js/registro.js"></script>
</body>
</html>