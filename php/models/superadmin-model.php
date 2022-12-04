<?php

class SuperAdmin {

    private $id_sadmin = null;
    private $nombres = null;
    private $apellidos = null;
    private $username = null;
    private $correo = null;
    private $pass = null;

    public $id_usuario = null;

    // Building

    public static function create() {
        return new self();
    }

    // Getters

    public function getID() { return $this->id_sadmin; }
    public function getNombres() { return $this->nombres; }
    public function getApellidos() { return $this->apellidos; }
    public function getUsername() { return $this->username; }
    public function getCorreo () { return $this->correo; }
    public function getPassword() { return $this->pass; }

    // Setters

    public function setID($_id) { $this->id_sadmin = $_id; return $this; }
    public function setNombres($_nom) { $this->nombres = $_nom; return $this; }
    public function setApellidos($_ape) { $this->apellidos = $_ape; return $this; }
    public function setUsername($_usr) { $this->username = $_usr; return $this; }
    public function setCorreo($_corr) { $this->correo = $_corr; return $this; }
    public function setPassword($_pass) { $this->pass = $_pass; return $this; }

}