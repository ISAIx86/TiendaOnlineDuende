<?php

require_once "cotizacion_dao.classes.php";

class CotizacionController extends CotizacionDAO {

    public function crearCotizacion($iduser, $idprod, $cant) {
        if (empty($iduser)) {
            return "uncaptured_user";
        }
        if (empty($idprod)) {
            return "uncaptured_prod";
        }
        if (empty($subtot) | empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_crear($iduser, $idprod, $subtot, $cant);
    }

    public function ofertaComprador($idcot, $subtot, $cant) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        if (empty($subtot) | $empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_setvend($idcot, $subtot, $cant);
    }

    public function ofertaVendedor($idcot, $subtot, $cant) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        if (empty($subtot) | $empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_setcomp($idcot, $subtot, $cant);
    }

    public function denegar($idcot) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        return $this->cot_denegar($idcot);
    }

    public function aceptar($idcot) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        return $this->cot_aceptar($idcot);
    }

    public function obtenerCotizacion($idcot) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->cot_info($idcot);
    }

    public function listaVendedor($idusu) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->cotv_lista($idusu);
    }

    public function listaComprador($idusu) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->cotc_lista($idusu);
    }
    
}

?>