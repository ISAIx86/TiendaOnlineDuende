<?php

namespace App\Models;

class Pedido {

    private $folio = null;
    private $id_usuario = null;
    private $domicilio = null;
    private $fecha_compra = null;
    private $total = null;
    public $id_producto = null;
    public $cantidad = null;
    public $precio = null;
    public $subtotal = null;
    public $categos = null;
    public $startdate = null;
    public $enddate = null;

    // Building
    public static function create() {
        return new self();
    }

    // Getters
    public function getID() { return $this->folio; }
    public function getUsuarioID() { return $this->id_usuario; }
    public function getDomicilioID() { return $this->domicilio; }
    public function getFechaCompra() { return $this->fecha_compra; }
    public function getTotal() { return $this->total; }

    // Setters
    public function setID($_folio) { $this->folio = $_folio; return $this; }
    public function setUsuarioID($_usu) { $this->id_usuario = $_usu; return $this; }
    public function setDomicilioID($_dom) { $this->domicilio = $_dom; return $this; }
    public function setFechaCompra($_fecom) { $this->fecha_compra = $_fecom; return $this; }
    public function setTotal($_tot) { $this->total = $_tot; return $this; }

}

?>