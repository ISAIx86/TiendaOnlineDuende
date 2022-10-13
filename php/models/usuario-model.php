<?php

class Usuario {

    private $id_usuario = null;
    private $nombres = null;
    private $apellidos = null;
    private $username = null;
    private $fecha_nac = null;
    private $sexo = null;
    private $rol = null;
    private $correo = null;
    private $pass = null;
    private $confirm = null;
    private $avatar = null;
    private $avatar_dir = null;
    private $creador = null;
        
    // Building

    public static function create() {
        return new self();
    }

    // Getters

    public function getID() { return $this->id_usuario; }
    public function getNombres() { return $this->nombres; }
    public function getApellidos() { return $this->apellidos; }
    public function getUsername() { return $this->username; }
    public function getFechaNac() { return $this->fecha_nac; }
    public function getSexo() { return $this->sexo; }
    public function getRol() { return $this->rol; }
    public function getCorreo () { return $this->correo; }
    public function getPassword() { return $this->pass; }
    public function getHashedPassword() { return password_hash($this->pass, PASSWORD_DEFAULT); }
    public function getConfPass() { return $this->confirm; }
    public function getAvatar() { return $this->avatar; }
    public function getAvatarDir() { return $this->avatar_dir; }
    public function getCreador() { return $this->creador; }

    // Setters

    public function setID($_id) { $this->id_usuario = $_id; return $this; }
    public function setNombres($_nom) { $this->nombres = $_nom; return $this; }
    public function setApellidos($_ape) { $this->apellidos = $_ape; return $this; }
    public function setUsername($_usr) { $this->username = $_usr; return $this; }
    public function setFechaNac($_fec) { $this->fecha_nac = $_fec; return $this; }
    public function setSexo($_sex) { $this->sexo = $_sex; return $this; }
    public function setRol($_rol) { $this->rol = $_rol; return $this; }
    public function setCorreo($_corr) { $this->correo = $_corr; return $this; }
    public function setPassword($_pass) { $this->pass = $_pass; return $this; }
    public function setConfPass($_conf) { $this->confirm = $_conf; return $this; }
    public function setAvatar($_ava) { $this->avatar = $_ava; return $this; }
    public function setAvatarDir($_avadir) { $this->avatar_dir = $_avadir; return $this; }
    public function setCreador($_crea) { $this->creador = $_crea; return $this; }

    public function copy(Usuario $usu) {
        $this->id_usuario = $usu->getID();
        $this->nombres = $usu->getNombres();
        $this->apellidos = $usu->getApellidos();
        $this->username = $usu->getUsername();
        $this->fecha_nac = $usu->getFechaNac();
        $this->sexo = $usu->getSexo();
        $this->rol = $usu->getRol();
        $this->correo = $usu->getCorreo();
        $this->pass = $usu->getPassword();
        $this->confirm = $usu->getConfPass();
        $this->avatar = $usu->getAvatar();
        $this->avatar_dir = $usu->getAvatarDir();
        $this->creador = $usu->getCreador();
        return $this;
    }

}

?>