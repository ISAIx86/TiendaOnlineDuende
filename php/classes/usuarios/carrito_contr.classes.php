<?php

require_once "carrito_dao.classes.php";

class CarritoController extends CarritoDAO {

    // Métodos fuertes
    public function añadirACarrito($userid, $prodid, $cantidad, $sub) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        if (
            empty($prodid) |
            empty($cantidad)
        ) {
            return "empty_inputs";
        }
        return $this->car_add($userid, $prodid, $cantidad, $sub);
    }

    public function modifCantCarrito($userid, $prodid, $cantidad) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        if (
            empty($prodid) |
            empty($cantidad)
        ) {
            return "empty_inputs";
        }
        return $this->car_set($userid, $prodid, $cantidad);
    }

    public function quitarCarrito($userid, $prodid) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        if (empty($prodid)) {
            return "empty_inputs";
        }
        return $this->car_pop($userid, $prodid);
    }

    public function limpiarCarrito($userid) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        return $this->car_clean($userid);
    }

    public function listaCarrito($userid) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        return $this->car_get($userid);
    }

    public function totalCarrito($userid) {
        if (empty($userid)) {
            return "uncaptured_id";
        }
        return $this->car_gettot($userid);
    }

}