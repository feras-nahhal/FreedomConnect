<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('Classes/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }

    $database = new DataBase();
    $db = $database->connect();

    if ($db) {
        try {
            // Prepare the SQL statement
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and password is correct
            if ($user && password_verify($password, $user['password'])) {
                // Start session and save user info
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_name'] = $user['url_adress'];

                // Redirect to the profile page
                header("Location: /demo/Profile.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login for Freedombook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/image1.jpg'); 
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Centers the image */
            background-repeat: no-repeat; /* Prevents the image from repeating */
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .header-bar {
            width: 100%;
            height: 100px;
            background-color: #3c5a99;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: white;
            font-size: 40px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
        }
        .header-bar button {
            background-color: #4CAF50; /* Green background */
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: auto; /* Pushes the button to the right */
            cursor: pointer;
            margin-right: 40px; /* Added right margin */
        }
        .header-bar button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        .login-container {
            width: 360px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            margin-top: 90px; /* Added margin to push down from header */
        }
        .header {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #3c5a99;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 5px;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #3c5a99;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .login-button:hover {
            background-color: #365899;
        }
        .footer {
            margin-top: 20px;
        }
        .footer a {
            color: #3c5a99;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header-bar">Freedombook
        <button onclick="window.location.href='/demo/singUp.php'">Sign Up</button> <!-- Green Sign Up button -->
    </div>
    <div class="login-container">
        <div class="header">Login</div>
        <form action="/demo/login.php" method="POST"> <!-- Pointing to login processing script -->
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Log In</button>
            <div class="footer">
                <a href="forgetpassword.php" class="forgot-password-button">Forgotten password?</a>
            </div>
        </form>
    </div>
</body>
</html>
