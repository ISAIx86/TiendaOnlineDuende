<?php

include (__DIR__.'/../classes/dbo.classes.php');

class UsuarioDAO extends DBH {

    private $stmt = null;
    private Usuario $usuario;

    public function __construct() {
        $this->usuario = Usuario::create();
    }

    private function prepareStatement($proc) {
        $this->stmt = $this->connect()->prepare('call sp_Usuarios("'.$proc.'", ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    }

    private function clearStatement() {
        $this->stmt = null;
    }

    private function executeQuery() {
        if (!$this->stmt->execute(array(
            $this->usuario->getID(),
            $this->usuario->getNombres(),
            $this->usuario->getApellidos(),
            $this->usuario->getUsername(),
            $this->usuario->getFechaNac(),
            $this->usuario->getSexo(),
            $this->usuario->getRol(),
            $this->usuario->getCorreo(),
            $this->usuario->getHashedPassword(),
            $this->usuario->getAvatar(),
            $this->usuario->getAvatarDir(),
            $this->usuario->getCreador()
        ))) {
            $this->clearStatement();
            header("location: ../../landingPage.html");
            exit();
        }
    }

    private function setData(Usuario $usu) {
        $this->usuario->copy($usu);
    }

    private function fetchData() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function countOfRows() {
        return $this->stmt->rowCount();
    }

    // Metodos débiles
    protected function us_checar_correo($correo) {

        $this->prepareStatement('checkE');

        $this->setData(Usuario::create()->setCorreo($correo));
        $this->executeQuery();

        $count = $this->fetchData()[0]["result"];

        $this->clearStatement();

        if ($count < 1){
            return false;
        }
        else return true;

    }

    // Métodos fuertes
    protected function us_registro(Usuario $usu) {

        $this->prepareStatement('create');

        $this->setData($usu);
        $this->executeQuery();
        
        $this->clearStatement();

    }

    protected function us_modificar(Usuario $usu) {

        $this->prepareStatement('modify');

        $this->setData($usu);
        $this->executeQuery();

        $this->clearStatement();

    }

    protected function us_baja(Usuario $usu) {

        $this->prepareStatement('delete');

        $this->setData($usu);
        $this->executeQuery();

        $this->clearStatement();
        
    }

    protected function us_cambiar_correo(Usuario $usu) {

        $this->prepareStatement('changeE');

        $this->setData($usu);
        $this->executeQuery();

        $this->clearStatement();

    }

    protected function us_cambiar_contra(Usuario $usu) {

        $this->prepareStatement('changeP');

        $this->setData($usu);
        $this->executeQuery();

        $this->clearStatement();

    }

    protected function us_login(Usuario &$usu) {

        $this->prepareStatement('login');

        $this->setData($usu);
        $this->executeQuery();

        $logged = $this->fetchData();

        $this->clearStatement();

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

    protected function us_getdata(Usuario &$usu) {

        $this->prepareStatement('get_data');

        $this->setData($usu);
        $this->executeQuery();

        $count = $this->countOfRows();
        $rt_data = $this->fetchData();

        $this->clearStatement();

        if ($count == 0) {
            return 0;
        }
        else {
            $usu->setNombres($rt_data[0]['out_nombres'])
                ->setApellidos($rt_data[0]['out_apellidos'])
                ->setUsername($rt_data[0]['out_username'])
                ->setCorreo($rt_data[0]['out_correo'])
                ->setFechaNac($rt_data[0]['out_fechanac'])
                ->setSexo($rt_data[0]['out_sexo'])
                ->setFechaCrea($rt_data[0]['out_feccre']);
            return 1;
        }

    }

}

?>