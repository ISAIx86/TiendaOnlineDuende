<?php
define("__ROOT", $_SERVER["DOCUMENT_ROOT"]."/TiendaOnlineDuende/");
include_once __ROOT."html/templates/get_session.php";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cuidado con el Duende - Registrar Producto</title>
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
  <!-- Header -->
  <?php include_once __ROOT."html/templates/headerVendedor.php"?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../../resources/p01.PNG" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
          <div class="mb-3">
            <div class="col-auto">
              <label for="txt_incatego" class="form-label">Categoria</label>
              <input class="form-control" id="txt_incatego" placeholder="Ingrese una categoria...">
              <ul id="search-list" class="searchul">
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class = "col-6">
        <form id="form_producto">
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <label for="txt_nombre" class="form-label">Producto</label>
              <input type="text" class="form-control" id="txt_nombre" name="in_nombre" maxlength="64" placeholder="Ingrese nombre del producto">
            </div>
          </div>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <label for="txt_descrip" class="form-label">Descripcion</label>
              <textarea class="form-control" id="txt_descrip" name="in_descrip" maxlength="256" rows="3" style="resize: none;"></textarea>
            </div>
          </div>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <label for="txt_descrip" class="form-label">Cantidad disponible</label>
              <input type="number" class="form-control" id="txt_dispo" name="in_dispo" max="256", min="1"></input>
            </div>
          </div>
          <div class="form_control" requerido="false" state='empt'>
            <div class="mb-3">
              <label for="img_fotos" class="form-label">Fotografias del producto</label>
              <input class="form-control" type="file" id="img_fotos" name="in_files" multiple>
            </div>
          </div>
          <div class="mb-3">
            <label for="in_catego" class="form-label">Categorias</label>
            <select id="lbx_catego" name="in_catego" size="5">
              <option>Sin categorías</option>
            </select>
          </div>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <div class = "row">
                <div class = "col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="in_tipoprecio" id="rdb_precio" value="PF" checked>
                      <label class="form-check-label" for="rdb_precio">
                        Precio Fijo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="in_tipoprecio" id="rdb_cotiz" value="CT">
                      <label class="form-check-label" for="rdb_cotiz">
                        Cotización
                      </label>
                    </div>    
                </div>
                <div class = "col-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" id="txt_precio" name="in_precio" class="form-control" maxlength="8" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/bootstrap.bundle.js"></script>
  <script src="../../js/jquery-3.6.1.js"></script>
  <script src="../../js/validaciones.js"></script>
  <script src="../../js/registroProducto.js"></script>
</body>
</html>