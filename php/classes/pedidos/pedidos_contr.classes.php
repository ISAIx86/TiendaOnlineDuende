<?php

require_once "pedidos_dao.classes.php";

class PedidosController extends PedidosDAO {
    
    // Métodos débiles
    private function hasEmptyInputs(Pedido $ped) {
        if (
            empty($ped->getUsuarioID()) // | empty($ped->getDomicilioID())
        ) {
            return true;
        } else return false;
    }

    private function prodExisCheck($produs) {
        foreach ($produs as &$prod) {
            if (!$this->ped_checar_prod($prod['rs_id'])) {
                return "product_no_exists";
            }
            if (!$this->ped_checar_exis($prod['rs_id'])) {
                return "product_no_disp";
            }
        }
        return true;
    }

    // Métodos fuertes
    public function registrarPedido(Pedido $ped, $produs) {
        $exist_result = $this->prodExisCheck($produs);
        if(gettype($exist_result) == "string") {
            return $exist_result;
        }
        if ($this->hasEmptyInputs($ped)) {
            return "empty_inputs";
        }
        $pedid = $this->ped_nuevo($ped);
        foreach ($produs as &$prod) {
            $this->ped_addproducto($pedid, $prod);
        }
        return true;
    }

    public function histoPedidos($id_usu, $catego, $start_date, $end_date) {
        if (empty($id_usu)) {
            return null;
        }
        return $this->ped_get_histo($id_usu, $catego, $start_date, $end_date);
    }

    public function ventasDetallada($id_usu, $catego, $start_date, $end_date) {
        if (empty($id_usu)) {
            return null;
        }
        return $this->ped_ventas_det($id_usu, $catego, $start_date, $end_date);
    }

    public function ventasAgrupada($id_usu, $catego, $start_date, $end_date) {
        if (empty($id_usu)) {
            return null;
        }
        return $this->ped_ventas_gro($id_usu, $catego, $start_date, $end_date);
    }

}

?>