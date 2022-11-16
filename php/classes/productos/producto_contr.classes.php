<?php

require_once "producto_dao.classes.php";
require_once __ROOT."/php/classes/assocs/rel_cat_dao.classes.php";

class ProductoController extends ProductoDAO {

    // Métodos débiles
    private function hasEmptyInput(Producto $prod) {
        if (
            empty($prod->getTitulo()) |
            empty($prod->getDescripcion()) |
            empty($prod->getDisponibilidad()) |
            empty($prod->getCotizacion()) |
            empty($prod->getPrecio())
        ) {
            return true;
        } else return false;
    }

    // Métodos fuertes
    public function crearProducto(Producto $prod, $categos) {
        if (empty($prod->getPublicador)) {
            return "missing_owner";
        }
        if ($this->hasEmptyInput($prod)) {
            return "empty_inputs";
        }
        if (count($categos) == 0) {
            return "no_categos";
        }
        $prodid = $this->pro_crear($prod);
        if (gettype($proid) == "string") {
            return "query_error";
        }
        $rl_cat_dao = new RelCatDAO();
        foreach ($categos as &$cat) {
            $rl_cat_dao->rcat_crear($proid, $cat['ID']);
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

}

?>