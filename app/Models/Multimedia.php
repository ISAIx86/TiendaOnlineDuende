<?php

namespace App\Models;

class Multimedia {

    private $id_mult = null;
    private $id_prod = null;
    private $contenido = null;
    private $contenido_dir = null;
    private $tipo = null;
    private $file_data = null;

    // Building
    public static function create() {
        return new self();
    }

    // Getters
    public function getID() { return $this->id_mult; }
    public function getProductoID() { return $this->id_prod; }
    public function getContenido() { return $this->contenido; }
    public function getContenidoDir() { return $this->contenido_dir; }
    public function getTipo() { return $this->tipo; }
    public function getMultiInfo() { return $this->file_data; }

    // Setters
    public function setID($_id) { $this->id_mult = $_id; return $this; }
    public function setProductoID($_prod) { $this->id_prod = $_prod; return $this; }
    public function setContenido($_cont) { $this->contenido = $_cont; return $this; }
    public function setContenidoDir($_contdir) { $this->contenido_dir = $_contdir; return $this; }
    public function setTipo($_tipo) { $this->tipo = $_tipo; return $this; }
    public function setMultiInfo($_data) { $this->file_data = $_data; return $this; }

}

?>