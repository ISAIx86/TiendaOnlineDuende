<?php

namespace App\Classes;

use PDO;

class DBH {

    private $conn = null;
    private $stmt = null;
    private $server = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "tienda_online";

    private function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->database;", $this->username, $this->password);
        }
        catch (PDOException $error) {
            die ("Connection failed" . $error->getMessage());
        }
    }

    private function disconnect() {
        $this->conn = null;
    }

    protected function setPrepareStatement($state) {
        $this->connect();
        $this->stmt = $this->conn->prepare($state);
    }

    protected function executeQuery($data_arr) {
        if (!$this->stmt->execute($data_arr)) {
            $info = $this->stmt->errorInfo();
            if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
                echo json_encode(array('result'=>"error", 'reason'=>"query_error", 'details'=>$this->stmt->errorInfo())); 
            } else {
                header("Location:".__RHOST."html/templates/something_went_wrong.php?context='Error en la consulta'&message='Hay un error en la estructura de la consulta de la base de datos.'&details=".$this->stmt->errorInfo()."");
            }
            $this->clearStatement();
            exit();
        }
        return true;
    }

    protected function countOfRows() {
        return $this->stmt->rowCount();
    }

    protected function fetchData() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function clearStatement() {
        $this->stmt = null;
        $this->disconnect();
    }

}

?>