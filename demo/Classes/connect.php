<?php

class DataBase {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "ferasBook_db";
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            // Correct the database name reference here
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function prepare($query) {
        if ($this->conn === null) {
            $this->connect();  // Connect if not already connected
        }
        return $this->conn->prepare($query);
    }


    public function execute($query, $params = []) {
        if ($this->conn === null) {
            $this->connect();  // Reconnect if the connection is null
        }
        try {
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute($params);

            return $result;
        } catch (PDOException $e) {
            echo "Execution error: " . $e->getMessage();
            return false;
        }
    }

    public function read($query, $params = []) {
        if ($this->conn === null) {
            $this->connect();  // Reconnect if the connection is null
        }
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            echo "Read error: " . $e->getMessage();
            return false;
        }
    }
}

?>
