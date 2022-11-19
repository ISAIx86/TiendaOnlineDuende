<?php
require_once __ROOT."php/models/usuario-model.php";
require_once __ROOT."php/classes/usuarios/usuario_contr.classes.php";
$controller = new UsuarioController();
$carritoTot = $controller->totalCarrito($loggedUser['ID']);
?>

<div id = "encabezado">
  <header>
  <div class="container text-center">
    <div class="row">
      <div class="col-sm-8">
        <a href="../usuarios/c-home.php">
          <img src='../../resources/logo02.PNG' class='logotipo'/>
        </a>
      </div>
      <div class="col-sm-4" id = "ico-header" >
        <div class = "row">
          <div class = "col-6">
            <div class="dropdown">
              <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src='../../resources/carrito.PNG' class='imgCuadrada' />
                <?php if ($carritoTot) { ?> 
                <h5 id="hdr_carrito"><?php echo "$$carritoTot" ?></h5>
                <?php } else { ?>
                  <h5 id="hdr_carrito">$0</h5>
                <?php } ?>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../comprador/c-carrito.php">Ver carrito</a></li>
                <li><a class="dropdown-item" href="../listas/c-listas.php">Guardar Lista</a></li>
              </ul>
            </div>
          </div>
          <div class = "col-6">
            <div class="dropdown">
              <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($loggedUser["Avatar"] == null) { ?>
                <img src='../../resources/default_user.jpg' class='imgRedonda'/>
                <?php } else { $imageSrc = '"data:image/jpg;base64,'.base64_encode($loggedUser["Avatar"]).'"'; ?>
                <img src=<?php echo $imageSrc ?> class='imgRedonda'/>
                <?php } ?>
                <h5 id="txt_usertag"><?php echo $loggedUser['Username'] ?></h5>
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
</header>

<div class = "container" id = "divBusqueda">          
    <form class="row" id = "buscador">
      <div class="col-9" id = "txt-busqueda">    
        <input class="form-control" id="txt_search" name="in_search" list="datalistOptions" placeholder="Ingrese una categoria...">
        <datalist id="datalistOptions">
          <option value="Electronica">
          <option value="Ropa">
          <option value="Anime">
          <option value="Oficina">
          <option value="Jardineria">
        </datalist>
      </div>
      <div class="col-3" id = "txt-busqueda">
        <button type="submit" class="btn btn-warning mb-3">
          <img src='../../resources/busqueda.png' class='imgCuadrada30' href="../producto/c-busqueda.php"/>
        </button>
      </div>
    </form>
</div>
<div class = "container" id = "navegacion">
<nav class="navbar navbar-expand-lg bg-opacity-50">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../producto/c-busqueda.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../listas/c-listas.php">Regalar</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Recomendados</a></li>
            <li><a class="dropdown-item" href="#">Más populares</a></li>
            <li><a class="dropdown-item" href="#">Más Vendidos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Vender</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
</div>
