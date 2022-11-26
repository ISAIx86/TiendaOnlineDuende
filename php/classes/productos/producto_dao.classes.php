<?php 

require_once __ROOT."/php/classes/dbo.classes.php";

class ProductoDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Productos('".$proc."', ?, ?, ?, ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getPublicador(),
            $data->getCategoria(),
            $data->getTitulo(),
            $data->getDescripcion(),
            $data->getDisponibilidad(),
            $data->getCotizacion(),
            $data->getPrecio()
        ));
    }

    // CRUD
    protected function pro_crear(Producto $prod) {

        $this->prepareStatement('create');

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $result = $this->fetchData();

        $this->clearStatement();

        return $result[0]["result"];

    }

    protected function pro_modificar(Producto $prod) {

        $this->prepareStatement('modify');

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function pro_baja($id) {

        $this->prepareStatement('delete');

        $prod = Producto::create()->setID($id);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function pro_restock($id, $cant) {

        $this->prepareStatement('restock');

        $prod = Producto::create()
            ->setID($id)
            ->setDisponibilidad($cant);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    // Cagetorias
    protected function rcat_add($id_prod, $id_catego) {

        $this->prepareStatement('add_cat');

        $prod = Producto::create()
            ->setID($id_prod)
            ->setCategoria($id_catego);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function rcat_restart($id_prod) {

        $this->prepareStatement('restart_cat');

        $prod = Producto::create()
            ->setID($id_prod);

        if (!$this->executeCall($prod)) {
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
    protected function pro_getdata($id) {

        $this->prepareStatement('get_data');

        $prod = Producto::create()->setID($id);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    protected function pro_getexist($id_publ, $categos) {

        $this->prepareStatement('get_exist');

        $prod = Producto::create()
            ->setPublicador($id_publ)
            ->setDescripcion($categos);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function pro_getstock($id) {

        $this->prepareStatement('get_data');

        $prod = Producto::create()->setID($id);

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $result = $this->fetchData()[0]['out_dispo'];

        $this->clearStatement();

        return $result;
        
    }

}

?>