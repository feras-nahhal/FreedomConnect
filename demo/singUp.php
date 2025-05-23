<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('Classes/singup.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signup = new Signup();
    $signup->createUser($_POST);
    header ("Location:login.php ");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('images/image1.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .signUp-container {
            width: 360px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            position: absolute; 
            left: 150px; 
            top: 50%; 
            transform: translateY(-50%); 
        }

        .header {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #3c5a99;
        }

        .header1 {
            margin-bottom: 20px;
            font-size: 65px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            color: #3c5a99;
            text-align: center;
            position: absolute;
            right: 250px; 
            top: 30%;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
            align-items: center;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-group input,
        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #dddfe2;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .signUp-button {
            width: 100%;
            padding: 10px;
            background-color: #3c5a99;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .signUp-button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .signUp-button:hover:not(:disabled) {
            background-color: #365899;
        }
        .password-match {
            color: green;
            display: none;
            margin-left: 10px;
            font-size: 20px;
        }
        .age-error {
            color: red;
            display: none;
            font-size: 14px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="header1">Freedombook</div>
        <div class="signUp-container">
            <div class="header">SignUp</div>
            
            <form id="signUpForm" method="post" action="">
                <div class="input-group">
                    <label for="first_name">First Name</label>
                    <input name="first_name" type="text" id="first_name" required>
                </div>

                <div class="input-group">
                    <label for="last_name">Last Name</label>
                    <input name="last_name" type="text" id="last_name" required>
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="date">Date of Birth</label>
                    <input name="date" type="date" id="date">
                    <span id="ageError" class="age-error">You must be at least 12 years old.</span>
                </div>

                <div class="input-group">
                    <label for="email">Email or Phone</label>
                    <input name="email" type="text" id="email">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" id="password">
                </div>

                <div class="input-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input name="confirmPassword" type="password" id="confirmPassword">
                    <span id="passwordMatch" class="password-match">✔</span>
                </div>
                
                <div class="input-group">
                    <button type="submit" class="signUp-button" id="signUpButton">Sign Up</button>
                </div>
            </form>
        </div>

    <script>
        const signUpForm = document.getElementById('signUpForm');
        const signUpButton = document.getElementById('signUpButton');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatch = document.getElementById('passwordMatch');
        const dobInput = document.getElementById('date');
        const ageError = document.getElementById('ageError');

        function validateForm() {
            const allFilled = Array.from(signUpForm.elements).filter(input => input.type !== 'submit').every(input => input.value);
            const passwordsMatch = passwordInput.value === confirmPasswordInput.value;
            const isOldEnough = dobInput.value ? checkAge(dobInput.value) : true;

            signUpButton.disabled = !allFilled || !passwordsMatch || (dobInput.value && !isOldEnough);
            passwordMatch.style.display = (passwordInput.value && confirmPasswordInput.value && passwordsMatch) ? 'inline' : 'none';
            ageError.style.display = (dobInput.value && !isOldEnough) ? 'inline' : 'none';
        }

        function checkAge(date) {
            const today = new Date();
            const birthDate = new Date(date);
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();
            const dayDifference = today.getDate() - birthDate.getDate();
            if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
                age--;
            }
            return age >= 12;
        }

        signUpForm.addEventListener('input', validateForm);
    </script>
</body>
</html>


