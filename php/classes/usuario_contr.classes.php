<?php

include (__DIR__.'/../classes/usuario_dao.classes.php');

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

    private function emptyInputM() {
        if (
            empty($this->usuario->getNombres()) |
            empty($this->usuario->getApellidos()) |
            empty($this->usuario->getUsername()) |
            empty($this->usuario->getFechaNac()) |
            empty($this->usuario->getSexo())
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

    private function emptyInputID() {
        if (empty($this->usuario->getID())) {
            return false;
        }
        else return true;
    }

    private function emptyInputE() {
        if (empty($this->usuario->getCorreo())) {
            return false;
        }
        else return true;
    }

    private function emptyInputPSW() {
        if (empty($this->usuario->getPassword()) | empty($this->usuario->getConfPass())) {
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
        return $this->us_registro($this->usuario);
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
            case -2:
                return "wrong_password";
                break;
            case -3:
                return "unauthorized_admin";
                break;
            case 0:
                return "user_logged";
                break;
        }
    }

    public function modificarUsuario() {
        if (!$this->emptyInputID()) {
            return "uncaptured_id";
        }
        if (!$this->emptyInputM()) {
            return "empty_inputs";
        }
        return $this->us_modificar($this->usuario);
    }

    public function modificarCorreo() {
        if (!$this->emptyInputID()) {
            return "uncaptured_id";
        }
        if (!$this->emptyInputE()) {
            return "empty_inputs";
        }
        if (!$this->userCheck()) {
            header('location: ../index.html');
            exit();
        }
        return $this->us_cambiar_correo($this->usuario);
    }

    public function modificarContra($curr_pass) {
        if (!$this->emptyInputID()) {
            return "uncaptured_id";
        }
        if (!$this->emptyInputE()) {
            return "uncaptured_email";
        }
        if (!$this->emptyInputPSW()) {
            return "empty_inputs";
        }
        if ($this->us_login($this->usuario) == 0) {
            return "wrong_password";
        }
        else {
            $this->usuario->setPassword($curr_pass);
            if (!$this->emptyInputPSW()) {
                return "empty_inputs";
            }
            if (!$this->matchPSW()) {
                return "unmatching_psw";
            }
            return $this->us_cambiar_contra($this->usuario);
        }
    }
    
    public function empezarSesion() {
        return array('ID'=>$this->usuario->getID(), 'Username'=>$this->usuario->getUsername(), 'Rol'=>$this->usuario->getRol(), 'Correo'=>$this->usuario->getCorreo());
    }

    public function obtenerDatos() {
        if (!$this->emptyInputID()) {
            header('location: ../index.html');
            exit();
        }
        if ($this->us_getdata($this->usuario))
            return array(
                'ID' => $this->usuario->getID(),
                'Nombres' => $this->usuario->getNombres(),
                'Apellidos' => $this->usuario->getApellidos(),
                'Username' => $this->usuario->getUsername(),
                'Correo' => $this->usuario->getCorreo(),
                'Fecha_nac' => $this->usuario->getFechaNac(),
                'Sexo' => $this->usuario->getSexo(),
                'Privacidad' => $this->usuario->getPrivacidad(),
                'Fecha_crea' => $this->usuario->getFechaCrea()
            );
    }

}

?>