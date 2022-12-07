<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class CotizacionDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Cotizaciones('".$proc."', ?, ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['id_cotiz'],
            $data['id_publ'],
            $data['id_compr'],
            $data['id_prod'],
            $data['precio'],
            $data['cantidad']
        ));
    }
    // CRUD
    protected function cot_crear($iduser, $idprod, $subtot, $cant) {

        $this->prepareStatement('create');

        $data = array(
            'id_cotiz'=>null,
            'id_publ'=>null,
            'id_compr'=>$iduser,
            'id_prod'=>$idprod,
            'precio'=>$subtot,
            'cantidad'=>$cant
        );

        $this->executeCall($data);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cot_setvend($id, $subtot, $cant) {

        $this->prepareStatement('set_vendor');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>$subtot,
            'cantidad'=>$cant
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function cot_setcomp($id, $subtot, $cant) {

        $this->prepareStatement('set_compr');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>$subtot,
            'cantidad'=>$cant
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
