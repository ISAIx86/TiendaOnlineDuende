<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class PedidosDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Pedidos('".$proc."', ?, ?, ?, ?, ?)");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getUsuarioID(),
            $data->getDomicilioID(),
            $data->id_producto,
            $data->cantidad
        ));
    }

    // CRUD
    protected function ped_nuevo(Pedido $ped) {

        $this->prepareStatement('create');

        if (!$this->executeCall($ped)) {
            return "query_error";
        }

        $result = $this->fetchData();

        $this->clearStatement();

        return $result[0]["result"];

    }

    protected function ped_addproducto($folio, $prod) {

        $this->prepareStatement('add_prod');

        $ped = Pedido::create()->setID($folio);
        $ped->id_producto = $prod['rs_id'];
        $ped->cantidad = $prod['rs_cantidad'];

        if (!$this->executeCall($ped)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    // Consultas
    protected function ped_checar_prod($prodid) {

        $this->prepareStatement('checkP');

        $ped = Pedido::create();
        $ped->id_producto = $prodid;

        if (!$this->executeCall($ped)) {
            return "query_error";
        }

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function ped_checar_exis($prodid) {

        $this->prepareStatement('checkEx');

        $ped = Pedido::create();
        $ped->id_producto = $prodid;

        if (!$this->executeCall($ped)) {
            return "query_error";
        }

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

}

?>