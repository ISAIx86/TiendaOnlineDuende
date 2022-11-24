<?php

require_once "producto_dao.classes.php";

class ProductoController extends ProductoDAO {

    // Métodos débiles
    private function hasEmptyInput(Producto $prod) {
        if (
            empty($prod->getTitulo()) |
            empty($prod->getDescripcion()) |
            empty($prod->getDisponibilidad()) |
            $prod->getCotizacion() != null |
            empty($prod->getPrecio())
        ) {
            return true;
        } else return false;
    }

    // Métodos fuertes
    public function crearProducto(Producto &$prod, $categos) {
        if (empty($prod->getPublicador())) {
            return "missing_owner";
        }
        if ($this->hasEmptyInput($prod)) {
            return "empty_inputs";
        }
        if (count($categos) == 0) {
            return "no_categos";
        }
        $prodid = $this->pro_crear($prod);
        if ($prodid == "query_error") {
            return "query_error";
        }
        if ($prodid == "insertion_failed") {
            return "insertion_failed";
        }
        $prod->setID($prodid);
        foreach ($categos as &$cat) {
            $this->rcat_add($prodid, $cat->id);
        }
        return true;
    }

    public function modificarProducto(Producto &$prod) {
        if (empty($prod->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInput($prod)) {
            return "empty_inputs";
        }
        if (!$this->pro_modificar($prod)) {
            return false;
        }
        $rl_cat_dao = new RelCatDAO();
        if (!$rl_cat_dao->rcat_restart($prod->getID())) {
            return "failed_restart_categos";
        }
        foreach ($categos as &$cat) {
            $rl_cat_dao->rcat_crear($proid, $cat['ID']);
        }
        return true;
    }

    public function bajaProducto($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->cat_baja($id);
    }

    public function obtenerProducto($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_getdata($id);
    }

    public function obtenerStock($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_getstock($id);
    }

}

?>