<?php

include ('../classes/dbo.classes.php');

class UsuarioDAO extends DBH {

    // Metodos débiles
    protected function us_checar_correo($correo) {
        $stmt = $this->connect()->prepare('call us_checar_correo(?)');
        if (!$stmt->execute(array($correo))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }

        $count = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["result"];
        $stmt = null;

        if ($count < 1){
            return false;
        }
        else return true;

    }

    // Métodos fuertes
    protected function us_registro(Usuario $usu) {
        $stmt = $this->connect()->prepare('call us_registro(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        if (!$stmt->execute(array(
            $usu->getNombres(),
            $usu->getApellidos(),
            $usu->getUsername(),
            $usu->getFechaNac(),
            $usu->getSexo(),
            $usu->getRol(),
            $usu->getCorreo(),
            $usu->getHashedPassword(),
            null,
            null,
            null
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }
        $stmt = null;
    }

    protected function us_modificar(Usuario $usu) {
        $stmt = $this->connect()->prepare('call us_modificar(?, ?, ?, ?, ?, ?, ?, ?)');
        if (!$stmt->execute(array(
            $usu->getID(),
            $usu->getNombres(),
            $usu->getApellidos(),
            $usu->getUsername(),
            $usu->getFechaNac(),
            $usu->getSexo(),
            null,
            null
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }
        $stmt = null;
    }

    protected function us_baja(Usuario $usu) {
        $stmt = $this->connect()->prepare('call us_modificar(?)');
        if (!$stmt->execute(array(
            $usu->getID()
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }
        $stmt = null;
    }

    protected function us_cambiar_correo(Usuario $usu) {
        $stmt = $this->connect()->prepare('call us_cambiar_correo(?, ?)');
        if (!$stmt->execute(array(
            $usu->getID(),
            $usu->getCorreo()
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }
        $stmt = null;
    }

    protected function us_cambiar_contra(Usuario $usu) {
        $stmt = $this->connect()->prepare('call us_cambiar_contra(?, ?)');
        if (!$stmt->execute(array(
            $usu->getID(),
            $usu->getPassword()
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }
        $stmt = null;
    }

    protected function us_login(Usuario &$usu) {
        $stmt = $this->connect()->prepare('call us_login(?)');
        if (!$stmt->execute(array(
            $usu->getCorreo()
        ))) {
            $stmt = null;
            header("location: ../index.html");
            exit();
        }

        $logged = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if (!$logged[0]["result"]) {
            return -1;
        }
        else {
            if (!password_verify($usu->getPassword(), $logged[0]["Pass"]))
                return 0;
            else {
                $usu->setID($logged[0]["ID"])
                    ->setUsername($logged[0]["Username"])
                    ->setRol($logged[0]["Rol"])
                    ->setCorreo($logged[0]["Correo"]);
                return 1;
            }
        }
    }

}

?>