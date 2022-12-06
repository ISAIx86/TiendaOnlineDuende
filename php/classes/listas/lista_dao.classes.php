<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class ListaDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Listas('".$proc."', ?, ?, ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getCreador(),
            $data->getNombre(),
            $data->getDescripcion(),
            $data->getPrivacidad(),
            $data->getImagen(),
            $data->getImagenDir()
        ));
    }

    // CRUD
    protected function lst_crear(Lista $lst) {

        $this->prepareStatement('create');

        $this->executeCall($lst);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function lst_modificar(Lista $lst) {

        $this->prepareStatement('modify');

        $this->executeCall($lst);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function lst_baja($id_lst, $id_usu) {

        $this->prepareStatement('delete');

        $lst = Lista::create()
            ->setID($id_lst)
            ->setCreador($id_usu);

        $this->executeCall($lst);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    // Consultas

    protected function lst_getcards($id_user) {

        $this->prepareStatement('get_cards');

        $lst = Lista::create()->setCreador($id_user);

        $this->executeCall($lst);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function lst_getcardsuser($id_user) {

        $this->prepareStatement('get_cards_user');

        $lst = Lista::create()->setCreador($id_user);

        $this->executeCall($lst);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function lst_get($id_list, $id_user) {

        $this->prepareStatement('get_data');

        $lst = Lista::create()
            ->setID($id_list)
            ->setCreador($id_user);

        $this->executeCall($lst);

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    protected function lst_getitems($id_list) {

        $this->prepareStatement('get_items');

        $lst = Lista::create()
            ->setID($id_list);

        $this->executeCall($lst);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

}

?>