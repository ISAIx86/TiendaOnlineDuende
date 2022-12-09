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
    protected function cot_crear($iduser, $idprod, $cant, $subtot) {

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

    protected function cot_aceptar($id) {

        $this->prepareStatement('accept');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
        );

        $this->executeCall($data);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
    }

    protected function cot_denegar($id) {
        $this->prepareStatement('deny');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
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
    
    protected function cot_checkv($id) {

        $this->prepareStatement('checkV');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData()[0]['result'];

        if ($result == "0")
            return false;
        else return true;

    }

    protected function cotv_lista($id_publ) {

        $this->prepareStatement('get_cards_v');

        $data = array(
            'id_cotiz'=>null,
            'id_publ'=>$id_publ,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function cotc_lista($id_comp) {

        $this->prepareStatement('get_cards_c');

        $data = array(
            'id_cotiz'=>null,
            'id_publ'=>null,
            'id_compr'=>$id_comp,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }

    protected function cot_info($id) {

        $this->prepareStatement('get_data');

        $data = array(
            'id_cotiz'=>$id,
            'id_publ'=>null,
            'id_compr'=>null,
            'id_prod'=>null,
            'precio'=>null,
            'cantidad'=>null
        );

        $this->executeCall($data);

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

}

?>
