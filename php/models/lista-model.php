<?php

class Lista {

    private $id_lista = null;
    private $id_usuario = null;
    private $nombre = null;
    private $descripcion = null;
    private $privacidad = null;
    private $imagen = null;
    private $imagen_dir = null;
    private $img_info = null;

    // Building

    public static function create() {
        return new self();
    }

    // Getters
    public function getID() { return $this->id_lista; }
    public function getCreador() { return $this->id_usuario; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getPrivacidad() { return $this->privacidad; }
    public function getImagen() { return $this->imagen; }
    public function getImagenDir() { return $this->imagen_dir; }
    public function getImagenInfo() { return $this->img_info; }

    // Setters
    public function setID($_id) { $this->id_lista = $_id; return $this; }
    public function setCreador($_crea) { $this->id_usuario = $_crea; return $this; }
    public function setNombre($_nom) { $this->nombre = $_nom; return $this; }
    public function setDescripcion($_desc) { $this->descripcion = $_desc; return $this; }
    public function setPrivacidad($_priv) { $this->privacidad = $_priv; return $this; }
    public function setImagen($_img) { $this->imagen = $_img; return $this; }
    public function setImagenDir($_imgdir) { $this->imagen_dir = $_imgdir; return $this; }
    public function setImagenInfo($_imginfo) { $this->img_info = $_imginfo; return $this; }

}

?>