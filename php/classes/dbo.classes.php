<?php

class DBH {

    private $server = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "tienda_online";

    protected function connect() {
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->database;", $this->username, $this->password);
            return $conn;
        }
        catch (PDOException $error) {
            die ("Connection failed" . $error->getMessage());
        }
    }
    
}

?>