<?php

class Producto {

    private $id_producto = null;
    private $id_publicador = null;
    private $id_autorizador = null;
    private $titulo = null;
    private $descripcion = null;
    private $cotizacion = null;
    private $precio = null;
    private $disponibilidad = null;
    private $calificacion = null;

    // Building

    public static function create() {
        return new self();
    }

    // Getters
    public function getID() { return $this->id_producto; }
    public function getPublicador() { return $this->id_publicador; }
    public function getAutorizador() { return $this->id_autorizador; }
    public function getTitulo() { return $this->titulo; }
    public function getDescripcion() { return $this->descripcion; }
    public function getCotizacion() { return $this->cotizacion; }
    public function getPrecio() { return $this->precio; }
    public function getDisponibilidad() { return $this->disponibilidad; }
    public function getCalificacion() { return $this->calificacion; }

    // Setters
    public function setID($_id) { $this->id_producto = $_id; return $this; }
    public function setPublicador($_publi) { $this->id_publicador = $_publi; return $this; }
    public function setAutorizador($_auto) { $this->id_autorizador = $_auto; return $this; }
    public function setTitulo($_tit) { $this->titulo = $_tit; return $this; }
    public function setDescripcion($_desc) { $this->descripcion = $_desc; return $this; }
    public function setCotizacion($_coti) { $this->cotizacion = $_coti; return $this; }
    public function setPrecio($_pre) { $this->precio = $_pre; return $this; }
    public function setDisponibilidad($_disp) { $this->disponibilidad = $_disp; return $this; }
    public function setCalificacion($_calif) { $this->calificacion = $_calif; return $this; }

    public function copy(Producto $prod) {
        $this->id_producto = $prod->getID();
        $this->id_publicador = $prod->getPublicador();
        $this->id_autorizador = $prod->getAutorizador();
        $this->titulo = $prod->getTitulo();
        $this->descripcion = $prod->getDescripcion();
        $this->cotizacion = $prod->getCotizacion();
        $this->precio = $prod->getPrecio();
        $this->disponibilidad = $prod->getDisponibilidad();
        $this->calificacion = $prod->getCalificacion();
        return $this;
    }

}

?>