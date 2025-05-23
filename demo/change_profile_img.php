<?php
session_start();
//unset($_SESSION['user_id']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('Classes/user.php');
include_once('Classes/post.php');
include_once('Classes/image.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['id'];
    $user = new User();
    $userData = $user->getUserById($id);
} else {
    header("Location: login.php"); 
    exit();
}

// Post area
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if a file was uploaded
   // Check if a file was uploaded
   if (isset($_FILES['file1']['name']) && $_FILES['file1']['name'] != "") {

    // Validate file type
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/heic'];
    $file_type = $_FILES['file1']['type'];

    if (in_array($file_type, $allowed_types)) {

        // Validate file size (should be less than 3MB)
        $size_limit = 3 * 1024 * 1024;
        $file_size = $_FILES['file1']['size'];

        if ($file_size <= $size_limit) {

            // Set the destination path
            $filename = $_FILES['file1']['name'];
            $destination = "uploads/" . $filename;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES['file1']['tmp_name'], $destination)) {
                echo "File uploaded successfully!";
                
                $change= "profile";
                if(isset($_GET['change']))
                {
                    $change = $_GET['change'];
                }

                $image_crop = new Image();
                if ($change == "cover"){

                    $image_crop->crop_image($destination,$destination,1400,500);

                }else{
                    $image_crop->crop_image($destination,$destination,800,800);
                }

                // Check if the file exists and update the database
                if (file_exists($destination)) {
                    $user_id = $userData['user_id'];

                  

                        if ($change == "cover"){

                            $query = "UPDATE users SET cover_image = '$destination' WHERE user_id = '$user_id' LIMIT 1";

                        }else{
                            $query = "UPDATE users SET profile_image = '$destination' WHERE user_id = '$user_id' LIMIT 1"; 
                        }

                    $DB = new DataBase();
                    $DB->execute($query);
                    header("Location: Profile.php");
                    die;
                } else {
                    echo "There is a problem with the image in the DB.";
                }

            } else {
                echo "Failed to upload file.";
            }

        } else {
            echo "The file size should be less than 3MB!";
        }

    } else {
        echo "The file should be an image (JPEG, PNG, JPG, or HEIC)!";
    }

} else {
    echo "No file was uploaded.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Image for FerasBook</title>
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
      
   
        .post-box {
            background-color: white;
            padding: 16px;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .post-box textarea {
            width: 100%;
            border: none;
            resize: none;
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .post-box button {
            background-color: #3b5998;
            border: none;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        .post-bar{
            background-color: #d0d8e4e;
            margin-top: 20px;
            padding: 8px;
        }
        .post {
            display: flex;
            margin-bottom: 20px;
            padding: 16px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #d0d8e4;
            overflow: hidden;
        }
        .post img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin-right: 10px;
        }
        .post-content {
            flex: 1;
        }
        .post-content .name {
            font-weight: bold;
            color: #3b5998;
        }
        .post-content .timestamp {
            color: #90949c;
            font-size: 12px;
        }
        .post-actions {
            margin-top: 10px;
            color: #90949c;
            font-size: 14px;
        }
        .post-actions a {
            margin-right: 10px;
            color: #3b5998;
            text-decoration: none;
        }
  
    </style>
</head>
<body>
       <!--topbar-->
       <br>
       <div class="header-bar">
        <div style="width: 800px; margin: auto; font-size: 30px;">
            <a style=" text-decoration: none;  color: white;" href="timeline.php">Feras Book &nbsp </a><input type="text" id="searchbox" class="search_box" placeholder="Search in FerasBook">
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

    <!-- Cover area -->
    <div style="width:800px; margin: auto; min-height: 400px;">
        <div style="text-align: center; color: #405d9b">
            <br>
            <br>
        </div>

        <div style="display: flex;">
            <div style="min-height:400px; flex:1; padding:20px; padding-right: 0px;">
                <div class="post-box" style="display: flex; flex-direction: column; align-items: center;">
                    <form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center;">
                        <input type="file" name="file1" style="margin-bottom: 20px;">
                        <button type="submit" style="width: 100px;">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
