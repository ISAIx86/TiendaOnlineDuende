<?php

namespace App\Repositories;

use App\Classes\DBH;
use App\Models\Pedido;

class PedidosDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Pedidos('".$proc."', ?, ?, ?, ?, ?, ?, ?, ?)");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getUsuarioID(),
            $data->getDomicilioID(),
            $data->id_producto,
            $data->cantidad,
            $data->categos,
            $data->startdate,
            $data->enddate
        ));
    }

    // CRUD
    protected function ped_nuevo(Pedido $ped) {

        $this->prepareStatement('create');

        $this->executeCall($ped);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result[0]["result"];

    }

    protected function ped_addproducto($folio, $prod) {

        $this->prepareStatement('add_prod');

        $ped = Pedido::create()->setID($folio);
        $ped->id_producto = $prod['out_id'];
        $ped->cantidad = $prod['out_cantidad'];

        $this->executeCall($ped);

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

        $this->executeCall($ped);

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

        $this->executeCall($ped);

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    protected function ped_get_histo($id_usu, $catego, $start_date, $end_date) {

        $this->prepareStatement('get_histo_peds');

        $ped = Pedido::create()->setUsuarioID($id_usu);
        $ped->categos = $catego;
        $ped->startdate = $start_date;
        $ped->enddate = $end_date;

        $this->executeCall($ped);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function ped_ventas_det($id_usu, $catego, $start_date, $end_date) {

        $this->prepareStatement('get_v_detail');

        $ped = Pedido::create()->setUsuarioID($id_usu);
        $ped->categos = $catego;
        $ped->startdate = $start_date;
        $ped->enddate = $end_date;

        $this->executeCall($ped);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function ped_ventas_gro($id_usu, $catego, $start_date, $end_date) {

        $this->prepareStatement('get_v_group');

        $ped = Pedido::create()->setUsuarioID($id_usu);
        $ped->categos = $catego;
        $ped->startdate = $start_date;
        $ped->enddate = $end_date;

        $this->executeCall($ped);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

}

?>