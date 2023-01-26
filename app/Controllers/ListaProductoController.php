<?php

namespace App\Controllers;

use App\Repositories\ListaProductoDAO;

class ListaProductoController extends ListaProductoDAO {

    // Métodos fuertes
    public function añadirProducto($id_list, $id_prod) {
        if (empty($id_list)) {
            return "uncaptured_list";
        }
        if (empty($id_prod)) {
            return "uncaptured_prod";
        }
        return $this->rlp_add($id_list, $id_prod);
    }

    public function quitarProducto($id_list, $id_prod) {
        if (empty($id_list)) {
            return "uncaptured_list";
        }
        if (empty($id_prod)) {
            return "uncaptured_prod";
        }
        return $this->rlp_del($id_list, $id_prod);
    }
    
}

?>