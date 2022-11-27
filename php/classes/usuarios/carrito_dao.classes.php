<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class CarritoDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Carrito('".$proc."', ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['in_userid'],
            $data['in_prodid'],
            $data['in_cantidad']
        ));
    }

    // Carrito
    protected function car_add($userid, $prodid, $cant) {

        $this->prepareStatement('add');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>$prodid,
            'in_cantidad'=>$cant
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return "not_aviable";
        }
        else return true;

    }

    protected function car_set($userid, $prodid, $cant) {

        $this->prepareStatement('set');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>$prodid,
            'in_cantidad'=>$cant
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return "not_aviable";
        }
        else return true;

    }

    protected function car_pop($userid, $prodid) {

        $this->prepareStatement('pop');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>$prodid,
            'in_cantidad'=>null
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function car_clean($userid) {

        $this->prepareStatement('clean');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>null,
            'in_cantidad'=>null
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function car_get($userid) {

        $this->prepareStatement('get');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>null,
            'in_cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function car_gettot($userid) {

        $this->prepareStatement('get_tot');

        $data = array(
            'in_userid'=>$userid,
            'in_prodid'=>null,
            'in_cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData()[0]['out_total'];

        $this->clearStatement();

        return $result;

    }

}