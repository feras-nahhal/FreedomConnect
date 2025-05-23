<?php
include_once('connect.php');

class User {
    private $conn;

    public function __construct() {
        $database = new DataBase();
        $this->conn = $database->connect();
    }

    public function updateUserById($id, $data) {
        $sql = "UPDATE users SET ";
        foreach ($data as $key => $value) {
            $sql .= "$key = :$key, ";
        }
        $sql = rtrim($sql, ", ") . " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function getUserById($user_id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_user($user_id) {
        $query = "SELECT * FROM users WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result ? $result[0] : false;
    }

    public function get_friends($user_id) {
        $query = "
            SELECT u.first_name, u.last_name, u.profile_image, u.user_id, u.gender
            FROM users u
            JOIN friends f ON u.user_id = f.user_id_friend
            WHERE f.user_id = :user_id;
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: false;
    }

    public function create_friend($user_id, $friend_id) {
        if ($user_id == $friend_id) {
            echo "You cannot add yourself as a friend.";
            return;
        }
        $query = "INSERT INTO friends (user_id, user_id_friend) VALUES (:user_id, :friend_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':friend_id', $friend_id);
        $stmt->execute();
    }

    public function search_users($searchQuery) {
        $query = "SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ?";
        $stmt = $this->conn->prepare($query);
        $like = "%" . $searchQuery . "%";
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
}
?>
