<?php

namespace App\Controllers;

use App\Repositories\CotizacionDAO;

class CotizacionController extends CotizacionDAO {

    public function crearCotizacion($iduser, $idprod, $cant, $subtot) {
        if (empty($iduser)) {
            return "uncaptured_user";
        }
        if (empty($idprod)) {
            return "uncaptured_prod";
        }
        if (empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_crear($iduser, $idprod, $cant, $subtot);
    }

    public function ofertaComprador($idcot, $subtot, $cant) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        if (empty($subtot) | empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_setcomp($idcot, $subtot, $cant);
    }

    public function ofertaVendedor($idcot, $subtot, $cant) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        if (empty($subtot) | empty($cant)) {
            return "empty_inputs";
        }
        return $this->cot_setvend($idcot, $subtot, $cant);
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
        if (!$this->cot_checkv($idcot)) {
            return "no_vend_offer";
        }
        return $this->cot_aceptar($idcot);
    }

    public function obtenerCotizacion($idcot) {
        if (empty($idcot)) {
            return "uncaptured_id";
        }
        return $this->cot_info($idcot);
    }

    public function listaVendedor($idusu) {
        if (empty($idusu)) {
            return "uncaptured_id";
        }
        return $this->cotv_lista($idusu);
    }

    public function listaComprador($idusu) {
        if (empty($idusu)) {
            return "uncaptured_id";
        }
        return $this->cotc_lista($idusu);
    }
    
}

?>