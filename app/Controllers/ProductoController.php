<?php

namespace App\Controllers;

use App\Repositories\ProductoDAO;

class ProductoController extends ProductoDAO {

    // Métodos débiles
    private function hasEmptyInput(Producto $prod) {
        if (
            empty($prod->getTitulo()) |
            empty($prod->getDescripcion()) |
            empty($prod->getDisponibilidad()) |
            empty($prod->getPrecio())
        ) {
            return true;
        } else return false;
    }

    private function hasEmptyInputForModify(Producto $prod) {
        if (
            empty($prod->getTitulo()) |
            empty($prod->getDescripcion()) |
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

    public function modificarProducto(Producto &$prod, $categos) {
        if (empty($prod->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInputForModify($prod)) {
            return "empty_inputs";
        }
        if (!$this->rcat_restart($prod->getID())) {
            return "failed_restart_categos";
        }
        if (!$this->pro_modificar($prod)) {
            return false;
        }
        foreach ($categos as &$cat) {
            $this->rcat_add($prod->getID(), $cat->id);
        }
        return true;
    }

    public function bajaProducto($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_baja($id);
    }

    public function autorizarProducto($id_prod, $id_admin) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        if (empty($id_admin)) {
            return "uncaptured_admin";
        }
        return $this->pro_autho($id_prod, $id_admin);
    }

    public function denegarProducto($id_prod, $id_admin) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        if (empty($id_admin)) {
            return "uncaptured_admin";
        }
        return $this->pro_deny($id_prod, $id_admin);
    }

    public function añadirStock($id_prod, $cant) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        if (empty($cant)) {
            return "empty_inputs";
        }
        return $this->pro_restock($id_prod, $cant);
    }

    public function existencias($id_publicador, $categos) {
        if (empty($id_publicador)) {
            return "uncaptured_id";
        }
        return $this->pro_getexist($id_publicador, $categos);
    }

    public function obtenerProducto($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_getdata($id);
    }

    public function obtenerProductoAutorizar($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_getdataunauth($id);
    }

    public function obtenerCategorias($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->rcat_getcat($id);
    }

    public function obtenerStock($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->pro_getstock($id);
    }

    public function obtenerPeticiones() {
        return $this->pro_getautho();
    }

}

?>