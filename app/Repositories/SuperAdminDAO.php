<?php

namespace App\Repositories;

use App\Classes\DBH;
use App\Models\SuperAdmin;

class SuperAdminDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_SuperAdmin('".$proc."', ?, ?, ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data->getID(),
            $data->id_usuario,
            $data->getNombres(),
            $data->getApellidos(),
            $data->getUsername(),
            $data->getCorreo(),
            $data->getPassword()
        ));
    }

    protected function sad_login($correo, $pass) {

        $this->prepareStatement('login');

        $sadm = SuperAdmin::create()->setCorreo($correo);

        $this->executeCall($sadm);

        $count = $this->countOfRows();
        $result = $this->fetchData()[0];

        $this->clearStatement();

        if (!$result["result"]) {
            return "not_found";
        }
        else {
            if (strcmp($pass, $result["out_pass"]))
                return "wrong_password";
            else {
                return array(
                    "ID"=>$result["out_id"],
                    "Username"=>$result["out_username"],
                    "Correo"=>$result["out_correo"]
                );
            }
        }
        
    }

    protected function sad_getadmins() {

        $this->prepareStatement('get_admins');

        $sadm = SuperAdmin::create();

        $this->executeCall($sadm);

        $result = $this->fetchData();

        $this->clearStatement();

        return $result;

    }
    
    protected function sad_authorize($id_sadmin, $id_usu) {

        $this->prepareStatement('auto_admin');

        $sadm = SuperAdmin::create()
            ->setID($id_sadmin);
        $sadm->id_usuario = $id_usu;

        $this->executeCall($sadm);

        $count = $this->countOfRows();

        $this->clearStatement();

        if ($count == 0) return false;
        else return true;

    }

}