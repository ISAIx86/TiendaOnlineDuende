<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cuidado con el Duende - <?php echo $loggedUser['Username'] ?></title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <link rel="stylesheet" href="./css/Nuevo.css"> -->
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

        require_once __ROOT."php/models/usuario-model.php";
        require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";

        if (isset($_SESSION['user'])) {
            $controller = new UsuarioController();
            $userData = $controller->obtenerDatos($_SESSION['user']['ID']);
            if (gettype($userData) == "string") {
                switch ($userData) {
                    case "uncaptured_id":
                        header("Location: ../../index.php");
                        break;
                }
            } else if (!isset($userData)) {
                header("Location: ../../index.php");
            }
        }
    ?>
    <!-- Container -->
    <div class = "container" id = "pagina">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div class = "row">
                            <div class = "col-4">
                                <?php if ($loggedUser["Avatar"] == null) { ?>
                                <img src='../../resources/default_user.jpg' class='imgRedonda'/>
                                <?php } else { $imageSrc = '"data:image/jpg;base64,'.base64_encode($loggedUser["Avatar"]).'"'; ?>
                                <img src=<?php echo $imageSrc ?> class='imgRedonda'/>
                                <?php } ?>
                            </div>
                            <div class = "col-4">
                                <h2><?php echo $loggedUser['Username'] ?></h2>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class = "row">
                            <h4>Mis datos</h4>
                            <a href="c-updateDatos.php">
                                <button type="button" class="btn btn-warning">Actualizar mis datos</button>
                            </a>       
                        </div>
                        <div class = "row">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5>Usuario</h5>
                                    <h8><?php echo $userData['out_username'] ?></h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>E-mail</h5>
                                    <h8><?php echo $userData['out_correo'] ?></h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Nombre y Apellido</h5>
                                    <h8><?php echo $userData['out_nombres'] . " " . $userData['out_apellidos']  ?></h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Fecha de nacimiento</h5>
                                    <h8><?php echo $userData['out_fechanac'] ?></h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Genero</h5>
                                    <h8>
                                        <?php
                                            switch ($userData['out_sexo']) {
                                                case 'H':
                                                    echo "Hombre";
                                                    break;
                                                case 'M':
                                                    echo "Mujer";
                                                    break;
                                                default:
                                                    echo "Otro";
                                                    break;
                                            }
                                        ?>
                                    </h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Privacidad de la cuenta</h5>
                                    <h8>
                                        <?php 
                                            if ($userData['out_privacidad']) {
                                                echo "Privado";
                                            }
                                            else {
                                                echo "Público";
                                            }
                                        ?>
                                    </h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Fecha de registro</h5>
                                    <h8><?php echo $userData['out_feccre'] ?></h8>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($loggedUser['Rol'] == "comprador") { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class = "row">
                            <div class = "col-4">
                                <img src='../../resources/metodoPago.PNG' class='imgRedonda' />
                            </div>
                            <div class = "col-8">
                                <h2>Metodos de pago</h2>
                            </div>       
                        </div>       
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class = "row">
                            <h4>Metodos de pago registrados</h4>
                            <a href = "c-RegMetodoPago.html">
                                <button type="button" class="btn btn-warning">Registrar metodo de pago</button>
                            </a>
                        </div>
                        <div class = "row" >
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class = "row">
                                        <div class = "col-8">
                                            <h5>Tarjeta Credito</h5>
                                            <h8>XXXX XXXX XXXX X386</h8>
                                        </div>
                                        <div class = "col-4">
                                            <span class="btn rounded-pill text-bg-danger">Quitar</span>
                                        </div>
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class = "row">
                                        <div class = "col-8">
                                            <h5>Tarjeta Debito</h5>
                                            <h8>XXXX XXXX XXXX X256</h8>
                                        </div>
                                        <div class = "col-4">
                                            <span class="btn rounded-pill text-bg-danger">Quitar</span>
                                        </div>
                                    </div>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <div class = "row">
                            <div class = "col-4">
                                <img src='../../resources/home.PNG' class='imgRedonda' />
                            </div>
                            <div class = "col-8">
                                <h2>Direcion</h2>
                            </div>       
                        </div>    
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class = "row">
                            <h4>Direcion registrada</h4>
                            <a href = "c-dirección.html">
                                <button type="button" class="btn btn-warning">Actualizar mi Direcion</button>
                            </a>
                        </div>
                        <div class = "row" >
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5>Estado</h5>
                                    <h8>Nuevo León</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Municipio</h5>
                                    <h8>Monterrey</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Codigo Postal</h5>
                                    <h8>64000</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Colonia</h5>
                                    <h8>Centro</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>Calle</h5>
                                    <h8>Juan Ignacio Ramon</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>No Exterior</h5>
                                    <h8>1400B</h8>
                                </li>
                                <li class="list-group-item">
                                    <h5>No Interior</h5>
                                    <h8>4D</h8>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>   
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- Footer -->
    <?php include __ROOT."html/templates/footer.php" ?>

    <script src="../../js/lib/bootstrap.bundle.js"></script>

</body>
</html>