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
  <?php
    require_once __ROOT."html/templates/headerVendedor.php";
    require_once __ROOT."php/models/multimedia-model.php";
    require_once __ROOT."php/models/producto-model.php";
    require_once __ROOT."php/classes/multimedia/multimedia_contr.classes.php";
    require_once __ROOT."php/classes/productos/producto_contr.classes.php";
    $prodfiles = array();
    $prodcategos = array();
    $prodInfo = array();
    if ($_GET['prod']) {
        $multcontroller = new MultimediaController();
        $prodcontroller = new ProductoController();
        $prodfiles = $multcontroller->obtenerArchivos($_GET['prod']);
        $prodcategos = $prodcontroller->obtenerCategorias($_GET['prod']);
        $prodInfo = $prodcontroller->obtenerProducto($_GET['prod']);
    } else {
        header("Location: v-existencia.php");
        exit();
    }
  ?>
  <!-- Container -->
  <div class = "container" id = "pagina">
    <div class = "row">
      <div class = "col-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div id="mda_carousel" class="carousel-inner">
            <div class="carousel-inner">
              <?php
                foreach ($prodfiles as &$file) {
                  if ($file['out_tipo'] == 'i') {
                    $imageSrc = '"data:image/jpg;base64,'.base64_encode($file["out_cont"]).'"';
              ?>
                  <div class="carousel-item active">
                    <img src=<?php echo $imageSrc ?> class="d-block w-100" alt="...">
                  </div>
                <?php 
                  } else if ($file['out_tipo'] == 'v') {
                ?>
                    <div class="carousel-item">
                      <video src="../../<?php echo $file['out_dir']?>" controls autoplay> Vídeo no es soportado... </video>
                    </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#mda_carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#mda_carousel" data-bs-slide="next">
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
        <form id="form_producto_upd" enctype='multiple/form-data'>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <label for="txt_nombre" class="form-label">Producto</label>
              <input type="text" class="form-control" id="txt_nombre" name="in_nombre" maxlength="64" placeholder="Ingrese nombre del producto" value="<?php echo $prodInfo['out_titulo']?>">
              <small>Error</small>
            </div>
          </div>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <label for="txt_descrip" class="form-label">Descripcion</label>
              <textarea class="form-control" id="txt_descrip" name="in_descrip" maxlength="256" rows="3" style="resize: none;"><?php echo $prodInfo['out_descripcion']?></textarea>
              <small>Error</small>
            </div>
          </div>
          <div class="form_control" requerido="false" state='empt'>
            <div class="mb-3">
              <label for="img_fotos" class="form-label">Fotografias del producto</label>
              <input class="form-control" type="file" id="fle_media" name="in_files[]" multiple>
              <small>Error</small>
            </div>
          </div>
          <div class="mb-3">
            <label for="in_catego" class="form-label">Categorias</label>
            <select id="lbx_catego" name="in_catego" size="5">
              <?php foreach($prodcategos as &$categos) { ?>
              <option id="item_catego_list" catego_id=<?php echo $categos['out_id']?> value="<?php echo $categos['out_nombre']?>"><?php echo $categos['out_nombre']?></option>
              <?php } ?>
            </select>
            <small>Error</small>
          </div>
          <div class="form_control" requerido="true" state='empt'>
            <div class="mb-3">
              <div class = "row">
                <div class = "col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="in_tipoprecio" id="rdb_precio" value="PF" <?php if(!$prodInfo['out_cotiz']) {?>checked<?php }?>>
                      <label class="form-check-label" for="rdb_precio">
                        Precio Fijo
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="in_tipoprecio" id="rdb_cotiz" value="CT" <?php if($prodInfo['out_cotiz']) {?>checked<?php }?>>
                      <label class="form-check-label" for="rdb_cotiz">
                        Cotización
                      </label>
                    </div>    
                </div>
                <div class = "col-6">
                  <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" id="txt_precio" name="in_precio" class="form-control" maxlength="8" aria-label="Amount (to the nearest dollar)" value=<?php echo $prodInfo['out_precio']?>>
                    <span class="input-group-text">.00</span>
                    <small>Error</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Editar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include __ROOT."html/templates/footer.php"?>

  <script src="../../js/lib/bootstrap.bundle.js"></script>
  <script src="../../js/lib/jquery-3.6.1.js"></script>
  <script src="../../js/utilities/validaciones.js"></script>
  <script src="../../js/vendedor/registroProducto.js"></script>
  <script src="../../js/vendedor/editarProducto.js"></script>
  
</body>
</html>