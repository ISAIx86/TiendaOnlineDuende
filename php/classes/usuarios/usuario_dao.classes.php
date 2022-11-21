<?php

require_once __ROOT."/php/classes/dbo.classes.php";

class UsuarioDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_Usuarios('".$proc."', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
            $data->getCreador(),
            $data->prodid,
            $data->cantidad
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
                        "Correo"=>$rt_data[0]["out_correo"],
                        "Avatar"=>$rt_data[0]["out_img"]
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

    // Carrito
    protected function us_addcarrito($id, $prod, $cant) {

        $this->prepareStatement('add_carrito');

        $usu = Usuario::create()->setID($id);
        $usu->prodid = $prod;
        $usu->cantidad = $cant;

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_modcantcarr($id, $prod, $cant) {

        $this->prepareStatement('set_carrito');

        $usu = Usuario::create()->setID($id);
        $usu->prodid = $prod;
        $usu->cantidad = $cant;

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_popcarrito($id, $prod) {

        $this->prepareStatement('pop_carrito');

        $usu = Usuario::create()->setID($id);
        $usu->prodid = $prod;

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_cleancarrito($id) {

        $this->prepareStatement('clean_carrito');

        $usu = Usuario::create()->setID($id);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();

        if ($count == 0) {
            return false;
        }
        else return true;

    }

    protected function us_getcarrito($id) {

        $this->prepareStatement('get_carrito');

        $usu = Usuario::create()->setID($id);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $rt_data = $this->fetchData();
        $result = array();

        $this->clearStatement();

        foreach ($rt_data as &$row) {
            array_push($result, array(
                "rs_id"=>$row['out_id'],
                "rs_titulo"=>$row['out_titulo'],
                "rs_precio"=>$row['out_precio'],
                "rs_cantidad"=>$row['out_cantidad'],
                "rs_dispo"=>$row['out_dispo'],
                "rs_total"=>$row['out_total']
            ));
        }

        return $result;

    }

    protected function us_gettot_carrito($id) {

        $this->prepareStatement('get_carr_tot');

        $usu = Usuario::create()->setID($id);

        if (!$this->executeCall($usu)) {
            return "query_error";
        }

        $count = $this->countOfRows();
        $result = false;
        if ($count != 0) {
            $result = $this->fetchData()[0]['out_total'];
        }

        $this->clearStatement();

        return $result;

    }

}

?>