<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class CategoriaDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Categorias('".$proc."', ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getCreador(),
            $data->getNombre(),
            $data->getDescripcion()
        ));
    }

    // CRUD
    protected function cat_crear(Categoria $cat) {

        $this->prepareStatement('create');

        $this->executeCall($cat);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cat_modificar(Categoria $cat) {

        $this->prepareStatement('modify');

        $this->executeCall($cat);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cat_baja($id) {

        $this->prepareStatement('delete');

        $cat = Categoria::create()->setID($id);

        $this->executeCall($cat);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    // Consultas

    protected function cat_checar_nombre($name) {

        $this->prepareStatement('check');

        $cat = Categoria::create()->setNombre($name);

        $this->executeCall($cat);

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cat_authorize($id, $auto) {

        $this->prepareStatement('autho');
        
        $cat = Categoria::create()
            ->setID($id)
            ->setCreador($auto);

        $this->executeCall($cat);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    protected function cat_deny($id, $auto) {

        $this->prepareStatement('deny');
        
        $cat = Categoria::create()
            ->setID($id)
            ->setCreador($auto);

        $this->executeCall($cat);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    protected function cat_all() {

        $this->prepareStatement('all_cat');

        $cat = Categoria::create();

        $this->executeCall($cat);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function cat_busqueda($text) {

        $this->prepareStatement('search_text');

        $cat = Categoria::create()->setNombre($text);
        
        $this->executeCall($cat);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function cat_getautho() {

        $this->prepareStatement('get_toautho');

        $cat = Categoria::create();

        $this->executeCall($cat);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

}

?>

