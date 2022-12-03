<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class CalificacionesDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Reviews('".$proc."', ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['in_userid'],
            $data['in_prodid'],
            $data['in_calif'],
            $data['in_comment']
        ));
    }

    // CRUD
    protected function rev_create($id_user, $id_prod, $calif, $comment) {

        $this->prepareStatement('create');

        $data = array(
            'in_userid' => $id_user,
            'in_prodid' => $id_prod,
            'in_calif' => $calif,
            'in_comment' => $comment
        );

        $this->executeCall($data);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }
    
    // Consultas
    protected function rev_getbyprod($id_prod) {

        $this->prepareStatement('get_by_prod');

        $data = array(
            'in_userid' => null,
            'in_prodid' => $id_prod,
            'in_calif' => null,
            'in_comment' => null
        );

        $this->executeCall($data);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }
    
}

?>