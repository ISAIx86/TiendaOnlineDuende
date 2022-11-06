<?php

abstract class DBH {

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
            $this->clearStatement();
            if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
                return false;
            } else {
                header("Location: ".__ROOT."index.php");
                exit();
            }
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