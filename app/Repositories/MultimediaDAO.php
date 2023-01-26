<?php 

namespace App\Repositories;

use App\Classes\DBH;
use App\Models\Multiemdia;

class MultimediaDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Multimedia('".$proc."', ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getProductoID(),
            $data->getContenido(),
            $data->getContenidoDir(),
            $data->getTipo()
        ));
    }

    // CRUD
    protected function mult_create(Multimedia $mult) {

        $this->prepareStatement('create');

        $this->executeCall($mult);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }
    
    // Consultas
    protected function mult_getimg($id_prod) {

        $this->prepareStatement('get_img');

        $mult = Multimedia::create()->setProductoID($id_prod);

        $this->executeCall($mult);

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    protected function mult_getfiles($id_prod) {

        $this->prepareStatement('get_files');

        $mult = Multimedia::create()->setProductoID($id_prod);

        $this->executeCall($mult);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function mult_clean($id_prod) {

        $this->prepareStatement('clean_files');

        $mult = Multimedia::create()->setProductoID($id_prod);

        $this->executeCall($mult);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0)
            return false;
        else return true;

    }
    
}

?>