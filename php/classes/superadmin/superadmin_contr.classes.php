<?php

require_once "superadmin_dao.classes.php";

class SuperAdminController extends SuperAdminDAO {

    public function ingresarAdmin($correo, $password) {
        if (empty($correo) | empty($password)) {
            return "empty_inputs";
        }
        return $this->sad_login($correo, $password);
    }

    public function peticionesUsuarios() {
        return $this->sad_getadmins();
    }

    public function autorizar($id_sadmin, $id_usuario) {
        if (empty($id_sadmin)) {
            return "uncaptured_id";
        }
        if (empty($id_usuario)) {
            return "empty_inputs";
        }
        return $this->sad_authorize($id_sadmin, $id_usuario);
    }

}