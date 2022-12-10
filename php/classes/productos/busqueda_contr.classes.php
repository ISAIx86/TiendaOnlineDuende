<?php

require_once "busqueda_dao.classes.php";

class BusquedaProdController extends BusquedaProdDAO {

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

    public function busquedaAvanzada($title) {
        return $this->adv_search($title, null, null, null, null);
    }

}

?>