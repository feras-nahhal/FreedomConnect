<?php
session_start();
//unset($_SESSION['user_id']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('Classes/user.php');
include_once('Classes/post.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['id'];
    $user = new User();
    $userData = $user->getUserById($id);
} else {
    header("Location: login.php"); 
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $updateData = [];

    if (!empty($_POST['first_name'])) {
        $updateData['first_name'] = $_POST['first_name'];
    }

    if (!empty($_POST['last_name'])) {
        $updateData['last_name'] = $_POST['last_name'];
    }

    if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            // Hash the password before storing it
            $updateData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            echo "Passwords do not match!";
            exit;
        }
    }

    // Update user data in the database
    if (!empty($updateData)) {
        $user->updateUserById($id, $updateData);
        header("Location: profile.php");
        exit();
    } else {
        echo "No changes detected.";
    }
}


//collect posts:

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mainpage for FerasBook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d0d8e4;
            margin: 0;
        }
        .header-bar {
            width: 100%;
            height: 50px;
            background-color: #3c5a99;
            display: flex;
            align-items: center;
            justify-content: space-between; /* Adjusted to space between items */
            padding: 0 20px; /* Added padding for inner spacing */
            color: white;
            font-size: 40px;
            font-family: 'Georgia', serif;
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
        }
  
        .search_box{
            width: 400px;
            height: 20px;
            border-radius: 10px;
            border: none;
            padding: 4px;
            font-size: 14px;
            background-image: url('images/image2.png'); 
            background-size: 15px;
            background-repeat: no-repeat; 
            background-position: calc(100% - 10px) center; 
           
        }
        .profilePhoto{
            width: 150px;
            margin-top: 20px;
            border-radius: 30px;
            border: solid 2px white;
          
        }
        .menuButton{
            width: 100px;
            display: inline-block;
            margin: 2px;

        }
        .photoBar{
         
            border: none;
            margin-top: 20px;
            color: #aaa;
           
            width: 200px;
            border-radius: 10px;

        }

        .signUp-container {
            background-color: white;
            padding: 16px;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 20px;
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
      

      

        
    </style>
</head>
<body>
    <!--topbar-->
    <br>
    <div class="header-bar">
        <div style="width: 800px; margin: auto; font-size: 30px;">
            <a style=" text-decoration: none;  color: white;" href="timeline.php">Feras Book &nbsp </a>     
            <form method="GET" action="search.php" style="display: inline;">
                <input type="text" name="query" id="searchbox" class="search_box" placeholder="Search in FerasBook" required>
                <button type="submit" style="display:none;"></button> <!-- Hidden button to allow Enter key to submit -->
            </form>
            <a
            <?php
                      $image = "images/f or m images/male.jpg";
                      if($userData['gender'] == "Female")
                      {
                          $image = "images/f or m images/female.jpg";
                      }
                if(file_exists($userData['profile_image'])){
                    $image = $userData['profile_image'];
                }
                ?>
             href="Profile.php"><img src="<?php echo $image ?>" style="width: 45px; height: 45px; float:right; border-radius: 10px;"> </a> 
            <a href="Classes/logout.php">
                <span style=" font-size:11px;  float: right; margin: 10px; color: white">Logout</span>
            </a>
            
        </div>
    </div>
    <!--cover area-->
    <div style=" width:800px; margin: auto;  min-height: 400px; margin-top:30px;">
        

        <div style=" display: flex;">
            <div style="min-height: 400px; flex: 1; display: flex; flex-direction: column; align-items: center;">
            <span style=" font-size: 12px">
                <?php
                      $image = "images/f or m images/male.jpg";
                      if($userData['gender'] == "Female")
                      {
                          $image = "images/f or m images/female.jpg";
                      }
                if(file_exists($userData['profile_image'])){
                    $image = $userData['profile_image'];
                }
                ?>
            <img src="<?php echo $image ?>" class="profilePhoto"><br/>
            
            </span>
                <label style=" font-size: 25px; font-weight: bold; color: #3c5a99; text-align: center;">
                <a href="Profile.php"> <div style="color:#3b5998;  align-items: center"  class="menuButton" > <?php echo $userData['first_name']." ". $userData['last_name']?> </div></a>
                </label>
            </div>
            <div style="min-height:400px;flex:2.5; padding:20px; padding-right: 0px;">
            <div class="signUp-container">
            <div class="header">Settings</div>
            
            
                <div class="input-group">
                    <label> Name: <?php echo $userData['first_name']." ". $userData['last_name']?></label>
            
                </div>

                <div class="input-group">
                    <label >Email: <?php echo $userData['email']?></label>
                </div>

                <div class="input-group">
                    <label >Gender: <?php echo $userData['gender']?></label>
                </div>
                <div class="input-group">
                    <label >Date Of Birth: <?php echo $userData['date']?></label>
                </div>

              
  
        </div>
               
                  
            </div>
        </div>

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
 