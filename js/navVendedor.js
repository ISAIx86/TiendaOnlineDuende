document.write(`
<div class = "container" id="navegacion">
<nav class="navbar navbar-expand-lg bg-opacity-50">
<div class="container-fluid">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="v-registrarProducto.html">Registrar Producto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="v-crearCategoria.html">Registrar Categoria</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="v-cotizacion.html">Cotizaciones pendientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="v-perfilVendedor.html">Perfil Publico</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Consultas
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="v-existencia.html">Existencias</a></li>  
          <li><a class="dropdown-item" href="v-listaVentas.html">Ventas detalladas</a></li>
          <li><a class="dropdown-item" href="v-ventaAgrupada.html">Ventas Agrupadas</a></li>    
          <li><hr class="dropdown-divider"></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
</nav>
</div>
`);
