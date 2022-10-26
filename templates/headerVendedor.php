<header>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-8">
            <img src='../resources/logo02.PNG' class='logotipo'/>
        </div>
        <div class="col-sm-4">
            <div class = "row">
                <div class = "col-6">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src='../resources/dongato.PNG' class='imgRedonda' />
                            <h5 id="txt_usertag"><?php echo $loggedUser['Username']?></h5>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./c-profile.php">Mi cuenta</a></li>
                            <li><a class="dropdown-item" href="../php/includes/usuarios/close_session_inc.php">Cerrar sesión</a></li>
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
                <a href="../c-busqueda.html">Buscar</a>
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
                    <a class="nav-link active" aria-current="page" href="../v-registrarProducto.html">Registrar producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../v-crearCategoria.html">Registrar categoria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../v-cotizacion.html">Cotizaciones pendientes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Consultas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../v-existencia.html">Existencias</a></li>  
                        <li><a class="dropdown-item" href="../v-listaVentas.html">Ventas detalladas</a></li>
                        <li><a class="dropdown-item" href="../v-ventaAgrupada.html">Ventas agrupadas</a></li>    
                        <li><hr class="dropdown-divider"></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>