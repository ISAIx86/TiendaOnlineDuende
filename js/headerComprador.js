document.write(`
<div class="container text-center"">
<div class="row">
  <div class="col-sm-8">
    <img src='resources/logo02.PNG' class='logotipo'/>
  </div>
  <div class="col-sm-4">
    <div class = "row">
        <div class = "col-6">
            <div class="dropdown">
                <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src='resources/carrito.PNG' class='imgRedonda' />
                    <h5>$1,500</h5> 
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="c-carrito.html">Comprar</a></li>
                  <li><a class="dropdown-item" href="c-listas.html">Guardar Lista</a></li>
                  <li><a class="dropdown-item" href="#">Limpiar</a></li>
                </ul>
              </div>
        </div>
        <div class = "col-6">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src='resources/dongato.PNG' class='imgRedonda' />
                    <h5>DonGatox16</h5>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="c-perfilPrivado.html">Mi Perfil</a></li>
                  <li><a class="dropdown-item" href="c-profile.html">Mi cuenta</a></li>
                  <li><a class="dropdown-item" href="landingPage.html">Cerrar sesión</a></li>
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
        <input class="form-control" id="txt_nombre" name="in_nombre" list="datalistOptions" placeholder="Ingrese una categoria...">
        <datalist id="datalistOptions">
        <option value="Electronica">
        <option value="Ropa">
        <option value="Anime">
        <option value="Oficina">
        <option value="Jardineria">
        </datalist>
    </div>
    <div class="col-3" align = "left">
      <button type="submit" class="btn btn-warning mb-3">
        <a href="c-busqueda.html">
          Buscar
        </a>
      </button>
    </div>
  </form>
</div>
`);
