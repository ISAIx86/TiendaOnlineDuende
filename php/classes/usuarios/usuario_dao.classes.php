<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class UsuarioDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Usuarios('".$proc."', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->getNombres(),
            $data->getApellidos(),
            $data->getUsername(),
            $data->getFechaNac(),
            $data->getSexo(),
            $data->getPrivacidad(),
            $data->getRol(),
            $data->getCorreo(),
            $data->getHashedPassword(),
            $data->getAvatar(),
            $data->getAvatarDir(),
            $data->getCreador()
        ));
    }

    // CRUD
    protected function us_registro(Usuario $usu) {

        $this->prepareStatement('create');

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_modificar(Usuario $usu) {

        $this->prepareStatement('modify');

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_baja($id) {

        $this->prepareStatement('delete');

        $usu = Usuario::create()->setID($id);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;
        
    }

    // Consultas
    protected function us_checar_correo($correo) {

        $this->prepareStatement('checkE');

        $usu = Usuario::create()->setCorreo($correo);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_login($correo, $pass) {

        $this->prepareStatement('login');

        $usu = Usuario::create()->setCorreo($correo);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();
        $result = $this->fetchData()[0];

        $this->clearStatement();

        if ($count < 1) {
            return "unauthorized_admin";
        }
        else {
            if (!$result["result"]) {
                return "not_found";
            }
            else {
                if (!password_verify($pass, $result["out_pass"]))
                    return "wrong_password";
                else {
                    return array(
                        "ID"=>$result["out_id"],
                        "Username"=>$result["out_username"],
                        "Rol"=>$result["out_rol"],
                        "Correo"=>$result["out_correo"],
                        "Avatar"=>$result["out_img"]
                    );
                }
            }
        }
        
    }

    protected function us_getdata($id) {

        $this->prepareStatement('get_data');

        $usu = Usuario::create()->setID($id);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $result = $this->fetchData()[0];

        $this->clearStatement();

        return $result;

    }

    // Modificaciones individuales
    protected function us_cambiar_correo($id, $correo) {

        $this->prepareStatement('changeE');

        $usu = Usuario::create()->setID($id)->setCorreo($correo);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_cambiar_contra($id, $pass) {

        $this->prepareStatement('changeP');

        $usu = Usuario::create()->setID($id)->setPassword($pass);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

}

?>