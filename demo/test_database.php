<?php
include('Classes/connect.php'); // Update this path as necessary
class Signup1 {

    public function createUser1() {
    $db = new DataBase();

    // Define test data
    $first_name = 'John';
    $last_name = 'Doe';
    $email = 'john.doe@example.com';
    $gender = 'Male';
    $date = '1990-01-01';
    $password = 'password123'; // Note: In a real application, handle passwords securely

    // Generate URL address
    $url_address = strtolower($first_name) . "." . strtolower($last_name);

    // Create a user
    $createQuery = "INSERT INTO users (user_id, first_name, last_name, email, gender, date, password, url_adress) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $userId = $this->createUserId();
    $createParams = [
        $userId,
        $first_name,
        $last_name,
        $email,
        $gender,
        $date,
        password_hash($password, PASSWORD_BCRYPT),
        $url_address // Include url_address
    ];

    $db->execute($createQuery, $createParams);
    echo "User created successfully.<br>";

    // Retrieve the user to verify creation
    $selectQuery = "SELECT * FROM users WHERE email = ?";
    $selectParams = [$email];
    $result = $db->fetch($selectQuery, $selectParams);

    if ($result) {
        echo "User retrieved successfully:<br>";
        print_r($result); // Display the retrieved data
    } else {
        echo "User not found.<br>";
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

$signup2 = new Signup1();
$result = $signup2->createUser1();



?>
