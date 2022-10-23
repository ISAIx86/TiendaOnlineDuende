<?php

include (__DIR__.'/../classes/dbo.classes.php');

class UsuarioDAO extends DBH {
   
    /*
    public function __construct() {
        
    }
    */

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Usuarios('".$proc."', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    }

    private function executeCall($data) {
        $this->executeQuery(array(
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

        $this->executeCall($usu);

        $count = $this->countOfRows();
        
        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_modificar(Usuario $usu) {

        $this->prepareStatement('modify');

        $this->executeCall($usu);

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

        $this->executeCall($usu);

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

        $this->executeCall($usu);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_login($correo, $pass) {

        $this->prepareStatement('login');

        $usu = Usuario::create()->setCorreo($correo);

        $this->executeCall($usu);

        $count = $this->countOfRows();
        $rt_data = $this->fetchData();

        $this->clearStatement();

        if ($count < 1) {
            return "unauthorized_admin";
        }
        else {
            if (!$rt_data[0]["result"]) {
                return "not_found";
            }
            else {
                if (!password_verify($pass, $rt_data[0]["out_pass"]))
                    return "wrong_password";
                else {
                    return array(
                        "ID"=>$rt_data[0]["out_id"],
                        "Username"=>$rt_data[0]["out_username"],
                        "Rol"=>$rt_data[0]["out_rol"],
                        "Correo"=>$rt_data[0]["out_correo"]
                    );
                }
            }
        }
        
    }

    protected function us_getdata($id) {

        $this->prepareStatement('get_data');

        $usu = Usuario::create()->setID($id);

        $this->executeCall($usu);

        $count = $this->countOfRows();
        $rt_data = $this->fetchData();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else {
            return array(
                "rs_nombres"=>$rt_data[0]['out_nombres'],
                "rs_apellidos"=>$rt_data[0]['out_apellidos'],
                "rs_username"=>$rt_data[0]['out_username'],
                "rs_correo"=>$rt_data[0]['out_correo'],
                "rs_fecha_nac"=>$rt_data[0]['out_fechanac'],
                "rs_sexo"=>$rt_data[0]['out_sexo'],
                "rs_privacidad"=>$rt_data[0]['out_privacidad'],
                "rs_fecha_crea"=>$rt_data[0]['out_feccre']
            );
        }

    }

    // Modificaciones individuales
    protected function us_cambiar_correo($id, $correo) {

        $this->prepareStatement('changeE');

        $usu = Usuario::create()->setID($id)->setCorreo($correo);

        $this->executeCall($usu);

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

        $this->executeCall($usu);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

}

?>