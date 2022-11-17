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

        $count = $this->countOfRows();
        $rt_data = $this->fetchData();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else {
            return array(
                "rs_id"=>$rt_data[0]['out_id'],
                "rs_titulo"=>$rt_data[0]['out_titulo'],
                "rs_descripcion"=>$rt_data[0]['out_descripcion'],
                "rs_cotiz"=>$rt_data[0]['out_cotiz'],
                "rs_precio"=>$rt_data[0]['out_precio'],
                "rs_dispo"=>$rt_data[0]['out_dispo'],
                "rs_calif"=>$rt_data[0]['out_calif']
            );
        }

    }

}

?>