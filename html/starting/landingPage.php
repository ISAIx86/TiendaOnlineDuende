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
        <div class="container_menu">
            <div class="logo">
                <img src="../../resources/logo02.png" alt="">
            </div>
            <div class="menu">
                <nav id="nav">
                    <ul>
                        <li><button onclick='location.href="registro.html"' type="button" class="btn btn-outline-success" data-toggle="button" aria-pressed="false" autocomplete="off">Registrarse</button></li>
                        <li><button type="button" class="btn btn-outline-success" data-toggle="button" aria-pressed="false" autocomplete="off">Ayuda</button></li>
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
                        <button class = "btn btn-outline-success">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>   
    </main>
    <!--Footer-->
    <footer>
  <div class = "container" id="footer-gray">
    <div class="footer-custom">
      <div class="footer-lists">
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr">Linea de soporte</h6>
          <ul class="ftr-links-sub">
            <li>800-8186-6666</li>
          </ul>
        </div>
        <!--/.footer-list-wrap-->
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr">Servicio a Cliente</h6>
          <ul class="ftr-links-sub">
            <li><a href="">Contactanos</a></li>
            <li><a href="">Ordena</a></li>
            <li><a href="">Metodos de pago</a></li>
            <li><a href="">FAQs</a></li>
          </ul>
        </div>
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr">Sobre Nosotros</h6>
          <ul class="ftr-links-sub">
            <li><a href="">Nuestra Empresa</a></li>
            <li><a href="">Trabaja con nosotros</a></li>
            
            <li><a href="/catalog" rel="nofollow">Nuestros productos</a></li>
          </ul>
        </div>
        <!--/.footer-list-wrap-->
        <div class="footer-list-wrap">
          <h6 class="ftr-hdr"></h6>
          <ul class="ftr-links-sub">
              <li class="ftr-Login"><a href="../usuarios/c-profile.php"></a></li>
              <li><a href="../comprador/c-misPedidos.php"></a></li>
              <li><a href="../comprador/c-carrito.php"></a></li>
              <li><a href="../../php/includes/usuarios/close_session_inc.php"></a></li>       
          </ul>
        </div>
        <!--/.footer-list-wrap-->
      </div>
      <!--/.footer-lists-->

      <!--/.footer-email-->
      <div class="footer-social">
        <h6 class="ftr-hdr">Siguenos</h6>
        <ul>
          <li>
            <a href="" title="Facebook">
                <span title="Facebook"> <img src='../../resources/logos/facebook.png' class='imgRedonda'/></span>
            </a>
          </li>
          <li>
            <a href="" title="Instagram">
                <span title="Instragam"> <img src='../../resources/logos/instagram.png' class='imgRedonda'/></span>
            </a>
          </li>
          <li>
            <a href="" title="WhatsApp">
                <span> <img src='../../resources/logos/whatsapp.png' class='imgRedonda'/></span>
            </a>
          </li>
          <li>  
            <a href=""  title="Youtube">
                <span> <img src='../../resources/logos/youtube.jpg' class='imgRedonda'/></span>
            </a>
          </li>
        </ul>
      </div>
      <!--/.footer-social-->
      <div class="footer-legal">
        <p>
            &copy; CUIDADO CON EL DUENDE, Todos los derechos reservados 2022 | 
            <a href="">Politica de privacidad</a> | 
            <a href="">Términos de uso</a> 

        </p>
        <p>CUIDADO CON EL DUENDE es una marca registrada de CUIDADO CON EL DUENDE SA DE CV</p>
        <p>Este sitio web contiene material con derechos de autor cuyo uso no ha sido autorizado por los propietarios de los derechos de autor. Creemos que este uso educativo sin fines de lucro en la Web constituye un uso justo del material con derechos de autor (según lo estipulado en la sección 107 de la Ley de derechos de autor de EE.UU.).</p>
      </div>
      <!--/.footer-legal-->
      <div class="footer-payment">
        <ul>
          <li>
          <span title="Pay Pal"> <img src='../../resources/logos/paypal-logo.jpg' class='imgCuadrada'/></span>
          </li>
          <li>
          <span title="Master Card"> <img src='../../resources/logos/Mastercard-Simbolo.jpg' class='imgCuadrada'/></span>
          </li>
          <li>
            <span title="Visa"> <img src='../../resources/logos/Visa-Emblem.jpg' class='imgCuadrada'/></span>
          </li>
        </ul>
      </div>
      <!--/.footer-payment-->
    </div>
    <!--/.footer-custom-->
  </div>
  <!--/.footer-gray-->
</footer>
<div class = "container-flex" id = "color2">
    <h12>.</h12>
  </div>
  <div class = "container-flex" id = "color1">
    <h12>.</h12>
  </div>
  <div class = "container-flex" id = "color3">
    <h12>.</h12>
  </div>
  <div class = "container-flex" id = "color4">
    <h12>.</h12>
  </div>
    <script src="../../js/lib/bootstrap.bundle.js"></script>
    <script src="../../js/lib/jquery-3.6.1.js"></script>
    <script src="../../js/utilities/validaciones.js"></script>
    <script src="../../js/usuarios/checarCampos.js"></script>
    <script src="../../js/usuarios/registro.js"></script>
</body>
</html>