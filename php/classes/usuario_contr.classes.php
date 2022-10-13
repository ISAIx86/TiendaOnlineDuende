<?php

include ('../classes/usuario_dao.classes.php');

class UsuarioContr extends UsuarioDAO {

    private Usuario $usuario;

    public function __construct(Usuario $usu) {
        parent::__construct();
        $this->usuario = $usu;
    }
    
    // Métodos débiles
    private function matchPSW() {
        if ($this->usuario->getPassword() !== $this->usuario->getConfPass()) {
            return false;
        }
        else return true;
    }

    private function userCheck() {
        if ($this->us_checar_correo($this->usuario->getCorreo())) {
            return false;
        }
        else return true;
    }

    private function emptyInputR() {
        if (
            empty($this->usuario->getNombres()) |
            empty($this->usuario->getApellidos()) |
            empty($this->usuario->getUsername()) |
            empty($this->usuario->getFechaNac()) |
            empty($this->usuario->getSexo()) |
            empty($this->usuario->getRol()) |
            empty($this->usuario->getCorreo()) |
            empty($this->usuario->getPassword()) |
            empty($this->usuario->getConfPass())
        ) {
            return false;
        }
        else return true;
    }

    private function emptyInputL() {
        if (empty($this->usuario->getCorreo()) | empty($this->usuario->getPassword())) {
            return false;
        }
        else return true;
    }
    
    // Métodos fuertes
    public function registrarUsuario() {
        if (!$this->emptyInputR()) {
            header('location: ../index.html');
            exit();
        }
        if (!$this->matchPSW()) {
            header('location: ../index.html');
            exit();
        }
        if (!$this->userCheck()) {
            header('location: ../index.html');
            exit();
        }
        $this->us_registro($this->usuario);
    }

    public function ingresarUsuario() {
        if (!$this->emptyInputL()) {
            return "empty_inputs";
        }
        if ($this->userCheck()) {
            return "no_exists";
        }
        switch($this->us_login($this->usuario)) {
            case -1:
                return "not_found";
                break;
            case 0:
                return "wrong_password";
                break;
            case 1:
                return "user_logged";
                break;
        }
    }
    
    public function empezarSesion() {
        return array('ID'=>$this->usuario->getID(), 'Username'=>$this->usuario->getUsername(), 'Rol'=>$this->usuario->getRol(), 'Correo'=>$this->usuario->getCorreo());
    }

}

?>