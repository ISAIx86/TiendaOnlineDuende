<?php

require_once "usuario_dao.classes.php";

class UsuarioController extends UsuarioDAO {
    
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
        } else return false;
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

    private function checkImageAndSet(Usuario &$usu) {
        $img_info = $usu->getAvatarInfo();
        $img_ex = strtolower(pathinfo($img_info["name"], PATHINFO_EXTENSION));
        $allowed_exs = array("jpg", "jpeg", "png");
        if ($img_info["name"] == "") {
            $usu->setAvatarDir(null)
                ->setAvatar(null);
            return "img_ok";
        }
        if ($img_info["error"] != 0) {
            return "img_error";
        } else if ($img_info["size"] > 8388608) {
            return "img_oversize";
        }
        else if (!in_array($img_ex, $allowed_exs)) {
            return "img_wrongext";
        }
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex;
        $img_upload_path = "/resources/users/$new_img_name";
        $usu->setAvatarDir($img_upload_path)
            ->setAvatar(file_get_contents($img_info["tmp_name"]));
        $result = move_uploaded_file($img_info["tmp_name"], __ROOT.$img_upload_path);
        return "img_ok";
    }
    
    // Métodos fuertes
    public function registrarUsuario(Usuario $nuevo_usu) {
        if ($this->hasEmptyInputForRegister($nuevo_usu)) {
            return "empty_inputs";
        }
        if (!$this->isMatchPassword($nuevo_usu)) {
            return "unmatch_confirm";
        }
        if ($this->userCheck($nuevo_usu->getCorreo())) {
            return "already_exists";
        }
        $img_result = $this->checkImageAndSet($nuevo_usu);
        if ($img_result != "img_ok") {
            return $img_result;
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

    public function modificarUsuario(Usuario &$datos) {
        if (empty($datos->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInputForModify($datos)) {
            return "empty_inputs";
        }
        $img_result = $this->checkImageAndSet($datos);
        if ($img_result != "img_ok") {
            return $img_result;
        }
        return $this->us_modificar($datos);
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
        return $this->us_getdata($id);
    }

}

?>