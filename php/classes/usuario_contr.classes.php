<?php

include ('../classes/usuario_view.classes.php');

class UsuarioContr extends UsuarioView {

    private Usuario $usuario;

    public function __construct(Usuario $usu) {
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
        if (!$this->us_checar_correo($this->usuario->getCorreo())) {
            return false;
        }
        else return true;
    }

    private function emptyInput() {
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
    
    // Métodos fuertes
    public function registrarUsuario() {
        if ($this->emptyInput() == false) {
            header('location: ../index.html');
            exit();
        }
        if ($this->matchPSW() == false) {
            header('location: ../index.html');
            exit();
        }
        if ($this->userCheck()) {
            header('location: ../index.html');
            exit();
        }
        $this->us_registro($this->usuario);
    }

}

?>