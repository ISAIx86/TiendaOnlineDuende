<?php

include (__DIR__.'/../classes/usuario_dao.classes.php');

class UsuarioContr extends UsuarioDAO {

    public function __construct() {
    }
    
    // Métodos débiles
    private function isMatchPassword($usu) {
        if ($usu->getPassword() !== $usu->getConfPass()) {
            return false;
        }
        else return true;
    }

    private function userCheck($email) {
        return $this->us_checar_correo($email);
    }

    private function hasEmptyInputForRegister(Usuario $usu) {
        if (
            empty($usu->getNombres()) |
            empty($usu->getApellidos()) |
            empty($usu->getUsername()) |
            empty($usu->getFechaNac()) |
            empty($usu->getSexo()) |
            empty($usu->getRol()) |
            empty($usu->getCorreo()) |
            empty($usu->getPassword()) |
            empty($usu->getConfPass())
        ) {
            return true;
        }
        else return false;
    }

    private function hasEmptyInputForModify(Usuario $usu) {
        if (
            empty($usu->getNombres()) |
            empty($usu->getApellidos()) |
            empty($usu->getUsername()) |
            empty($usu->getFechaNac()) |
            empty($usu->getSexo())
        ) {
            return true;
        }
        else return false;
    }
    
    // Métodos fuertes
    public function registrarUsuario(Usuario $nuevo_usu) {
        if ($this->hasEmptyInputForRegister($nuevo_usu)) {
            return "empty_inputs";
        }
        if (!$this->isMatchPassword()) {
            return "unmatch_confirm";
        }
        if ($this->userCheck()) {
            return "already_exists";
        }
        return $this->us_registro($nuevo_usu);
    }

    public function ingresarUsuario($email, $pass) {
        if (empty($email) | empty($pass)) {
            return "empty_inputs";
        }
        if (!$this->userCheck($email)) {
            return "no_exists";
        }
        return $this->us_login($email, $pass);
    }

    public function modificarUsuario(Usuario $datos) {
        if (empty($datos->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInputForModify($datos)) {
            return "empty_inputs";
        }
        return $this->us_modificar($this->usuario);
    }

    public function modificarCorreo($id, $email) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        if (empty($email)) {
            return "empty_inputs";
        }
        if ($this->userCheck($email)) {
            return "already_exists";
        }
        return $this->us_cambiar_correo($id, $email);
    }

    public function modificarContra($id, $email, $curr_pass, $nueva_pass, $conf_pass) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        if (empty($email) |empty($curr_pass) | empty($nueva_pass) | empty($conf_pass)) {
            return "empty_inputs";
        }
        if ($this->us_login($email, $curr_pass) == "wrong_password") {
            return "wrong_password";
        }
        if ($nueva_pass != $conf_pass) {
            return "unmatching_psw";
        }
        return $this->us_cambiar_contra($id, $nueva_pass);
    }

    public function obtenerDatos($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        $result = $this->us_getdata($id);
        if (!$result) {
            return "not_found";
        }
        return $result;
    }

}

?>