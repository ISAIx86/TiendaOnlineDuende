<?php

    class Usuario {

        private $id_usuario;
        private $nombres;
        private $apellidos;
        private $username;
        private $fecha_nac;
        private $sexo;
        private $rol;
        private $correo;
        private $pass;
        private $confirm;

        // Building

        public function __construct() { }

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

    }

?>