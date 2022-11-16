<?php 

require_once __ROOT."/php/classes/dbo.classes.php";

class ProductoDAO extends DBH {

    // Statement
    protected function prepareStatement() {
        $this->setPrepareStatement("call sp_Productos('".$proc."', ?, ?, ?, ?, ?, ?, ?)");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getPublicador(),
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

        return $result[0];

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

    // Consultas
    

}

?>