<?php

require_once "busqueda_dao.classes.php";

class BusquedaProdController extends BusquedaProdDAO {

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
    public function masVendidos() {
        return $this->get_vendidos();
    }

    public function masVistos() {
        return $this->get_vendidos();
    }

    public function masRecomendados(){
        return $this->get_vistos();
    }

    public function busquedaAvanzada() {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->adv_search();
    }

}

?>