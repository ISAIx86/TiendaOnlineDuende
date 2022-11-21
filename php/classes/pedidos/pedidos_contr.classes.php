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

}

?>