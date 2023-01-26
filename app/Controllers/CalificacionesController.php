<?php

namespace App\Controllers;

use App\Repositories\CalificacionesDAO;

class CalificacionesController extends CalificacionesDAO {

    // Métodos fuertes
    public function insertarNuevoReview($id_user, $id_prod, $calif, $comment) {
        if (empty($id_user) | empty($id_prod)) {
            return "uncaptured_id";
        }
        if (empty($calif)) {
            return "empty_inputs";
        }
        return $this->rev_create($id_user, $id_prod, $calif, $comment);
    }

    public function obtenerCalificaciones($id_prod) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        return $this->rev_getbyprod($id_prod);
    }

}

?>