<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class RelCatDAO extends DBH {

    // Statement
    protected function prepareStatement() {
        $this->setPrepareStatement("call sp_RelCat('".$proc."', ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['id_prod'],
            $data['id_cat']
        ));
    }

    // CRUD
    public function rcat_crear($id_prod, $id_catego) {

        $this->prepareStatement('create');

        if (!$this->executeCall(array('id_prod' => $id_prod, 'id_cat' => $id_catego))) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    public function rcat_restart($id_prod) {

        $this->prepareStatement('restart');

        if (!$this->executeCall(array('id_prod' => $id_prod, 'id_cat' => null))) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

}

?>