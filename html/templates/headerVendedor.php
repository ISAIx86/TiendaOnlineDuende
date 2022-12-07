<header>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-8">
            <img src='../../resources/logo02.PNG' class='logotipo'/>
        </div>
        <div class="col-sm-4">
            <div class = "row">
                <div class = "col-6">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if ($loggedUser["Avatar"] == null) { ?>
                            <img src='../../resources/default_user.jpg' class='imgRedonda'/>
                            <?php } else { $imageSrc = '"data:image/jpg;base64,'.base64_encode($loggedUser["Avatar"]).'"';?>
                            <img src=<?php echo $imageSrc ?> class='imgRedonda'/>
                            <?php } ?>
                            <h5 id="txt_usertag"><?php echo $loggedUser['Username']?></h5>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../usuarios/c-profile.php">Mi cuenta</a></li>
                            <li><a class="dropdown-item" href="../../php/includes/usuarios/close_session_inc.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class = "container-sm">
    <form class="row" id = "buscador">
        <div class="col-9">
            <input class="form-control" id="txt_search" name="in_search" list="datalistOptions" placeholder="Ingrese una categoria...">
            <datalist id="datalistOptions">
                <option value="Electronica">
                <option value="Ropa">
                <option value="Anime">
                <option value="Oficina">
                <option value="Jardineria">
            </datalist>
        </div>
        <div class="col-3">
            <button type="submit" class="btn btn-warning mb-3">
                <a href="../producto/c-busqueda.html">Buscar</a>
            </button>
        </div>
    </form>
</div>
</header>
<nav class="navbar navbar-expand-lg bg-opacity-50">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../vendedor/v-registrarProducto.php">Registrar producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vendedor/v-crearCategoria.php">Registrar categoria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../vendedor/v-cotizaciones.php">Cotizaciones pendientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consultas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../vendedor/v-existencia.php">Existencias</a></li>
                        <li><a class="dropdown-item" href="../vendedor/v-listaVentas.php">Ventas detalladas</a></li>
                        <li><a class="dropdown-item" href="../vendedor/v-ventaAgrupada.php">Ventas agrupadas</a></li>
                        <li><hr class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    </div>

</div>

