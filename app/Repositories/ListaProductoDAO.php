<?php

namespace App\Repositories;

use App\Classes\DBH;

class ListaProductoDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_RelListProd('".$proc."', ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['id_lista'],
            $data['id_producto']
        ));
    }

    // CRUD
    protected function rlp_add($id_lst, $id_prod) {

        $this->prepareStatement('create');

        $data = array(
            'id_lista' => $id_lst,
            'id_producto' => $id_prod
        );

        $this->executeCall($data);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function rlp_del($id_lst, $id_prod) {

        $this->prepareStatement('delete');

        $data = array(
            'id_lista' => $id_lst,
            'id_producto' => $id_prod
        );

        $this->executeCall($data);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

}

?>