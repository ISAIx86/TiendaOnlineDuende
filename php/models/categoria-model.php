<?php

class Categoria {

    private $id_catego = null;
    private $id_creador = null;
    private $nombre = null;
    private $descripcion = null;

    // Building

    public static function create() {
        return new self();
    }

    // Getters
    public function getID() { return $this->id_catego; }
    public function getCreador() { return $this->id_creador; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }

    // Setters
    public function setID($_id) { $this->id_catego = $_id; return $this; }
    public function setCreador($_crea) { $this->id_creador = $_crea; return $this; }
    public function setNombre($_nom) { $this->nombre = $_nom; return $this; }
    public function setDescripcion($_desc) { $this->descripcion = $_desc; return $this; }

}

?>