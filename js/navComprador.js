document.write(`
<nav class="navbar navbar-expand-lg bg-opacity-50">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="c-busqueda.html">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="c-listaPublica.html">Regalar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="c-perfilPublico.html">Perfil Publico</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Productos
            </a>
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
`);

