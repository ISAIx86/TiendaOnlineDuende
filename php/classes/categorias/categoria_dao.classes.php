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

        if (!$this->executeCall($cat)) {
            return "query_error";
        }

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cat_modificar(Categoria $cat) {

        $this->prepareStatement('modify');

        if (!$this->executeCall($cat)) {
            return "query_error";
        }

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

        if (!$this->executeCall($cat)) {
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

    protected function cat_checar_nombre($name) {

        $this->prepareStatement('check');

        $usu = Categoria::create()->setNombre($name);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cat_authorize($id, $auto) {

        $this->prepareStatement('authorize');
        
        $cat = Categoria::create()
            ->setID($id)
            ->setCreador($auto);

        if(!$this->executeCall($cat)) {
            return "query_error";
        }

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

        if(!$this->executeCall($cat)) {
            return "query_error";
        }

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function cat_busqueda($text) {

        $this->prepareStatement('search_text');

        $cat = Categoria::create()
            ->setNombre($text);
        
        if(!$this->executeCall($cat)) {
            return "query_error";
        }

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

}

?>

