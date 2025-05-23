<?php
include_once('connect.php');

class Signup {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function createUser($data) {
        try {
            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $gender = $data['gender'];
            $date = $data['date'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT);
            $user_id= $this->createUserId();

            $url_adress = strtolower($first_name) . "." . strtolower($last_name);

            $query = "INSERT INTO users (first_name, last_name, email, gender, date, password,user_id,url_adress) 
                      VALUES (:first_name, :last_name, :email, :gender, :date, :password,:user_id,:url_adress)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':url_adress', $url_adress);
            if ($stmt->execute()) {
                echo "User registered successfully!";
            } else {
                echo "Error: Could not register user.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    private function createUserId() {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }
}
?>
