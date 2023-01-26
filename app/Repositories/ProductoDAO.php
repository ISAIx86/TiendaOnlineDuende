<?php 

namespace App\Repositories;

use App\Classes\DBH;
use App\Models\Producto;

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

        $this->executeCall($prod);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result[0]["result"];

    }

    protected function pro_modificar(Producto $prod) {

        $this->prepareStatement('modify');

        $this->executeCall($prod);

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

        $this->executeCall($prod);

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

        $this->executeCall($prod);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function pro_autho($id_prod, $id_autho) {

        $this->prepareStatement('autho');

        $prod = Producto::create()
            ->setID($id_prod)
            ->setPublicador($id_autho);

        $this->executeCall($prod);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function pro_deny($id_prod, $id_autho) {

        $this->prepareStatement('deny');

        $prod = Producto::create()
            ->setID($id_prod)
            ->setPublicador($id_autho);

        $this->executeCall($prod);

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

        $this->executeCall($prod);

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

        $this->executeCall($prod);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function rcat_getcat($id_prod) {

        $this->prepareStatement('get_categos');

        $prod = Producto::create()
            ->setID($id_prod);

        $this->executeCall($prod);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    // Consultas
    protected function pro_getdata($id) {

        $this->prepareStatement('get_data');

        $prod = Producto::create()->setID($id);

        $this->executeCall($prod);

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    // Consultas
    protected function pro_getdataunauth($id) {

        $this->prepareStatement('get_data_unautho');

        $prod = Producto::create()->setID($id);

        $this->executeCall($prod);

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    protected function pro_getexist($id_publ, $categos) {

        $this->prepareStatement('get_exist');

        $prod = Producto::create()
            ->setPublicador($id_publ)
            ->setDescripcion($categos);

        $this->executeCall($prod);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function pro_getstock($id) {

        $this->prepareStatement('get_data');

        $prod = Producto::create()->setID($id);

        $this->executeCall($prod);

        $result = $this->fetchData()[0]['out_dispo'];

        $this->clearStatement();

        return $result;
        
    }

    protected function pro_getautho() {

        $this->prepareStatement('get_toautho');

        $prod = Producto::create();

        $this->executeCall($prod);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

}

?>