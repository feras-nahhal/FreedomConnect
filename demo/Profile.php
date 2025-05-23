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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $post = new Post();
    $result= $post->create_post($user_id,$_POST,$_FILES);

    if (empty($result)) {
        header("Location: Profile.php");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        $_SESSION['post_error'] = $result;
        header("Location: Profile.php");
        exit();
    }

    if (isset($_SESSION['post_error'])) {
        echo "<div>" . $_SESSION['post_error'] . "</div>";
        unset($_SESSION['post_error']);
    }
   
}

//collect posts:

$user_id = $_SESSION['user_id'];
$post = new Post();
$posts= $post->get_post($user_id);

//collect FRIENDS:

$user = new User();
$user_id = $_SESSION['user_id'];
$friends= $user->get_friends($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile for Freedombook</title>
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
        .profilePhoto{
            width: 150px;
            margin-top: -200px;
            border-radius: 30px;
            border: solid 2px white;
        }
        .menuButton{
            width: 100px;
            display: inline-block;
            margin: 2px;
        }
        .friendBar {
            background-color: white;
            border-radius: 10px;
            margin-top: 20px;
            color: #3b5998;
            padding: 8px;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            flex-direction: column;
        }
        .friend-card {
            display: flex;
            align-items: center;
            background-color: #f0f2f5;
           border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin: 8px 0;
            text-decoration: none;
            color: black;
            transition: background-color 0.3s ease;
        }
        .friend-card:hover {
            background-color: #e9ebee;
        }
        .friendsPhoto{
            width: 75px;
            border-radius: 10px;
            margin-right: 10px;
        }
        .friend-card label {
            font-size: 12px;
            font-weight: bold
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
            <a style=" text-decoration: none;  color: white;" href="timeline.php">Freedombook &nbsp </a>
            
            <form method="GET" action="search.php" style="display: inline;">
                <input type="text" name="query" id="searchbox" class="search_box" placeholder="Search in Freedombook" required>
                <button type="submit" style="display:none;"></button> <!-- Hidden button to allow Enter key to submit -->
            </form>

            <a
            <?php
                      $image = "images/f or m images/male.jpg";
                      if($userData['gender'] == "Female")
                      {
                          $image = "images/f or m images/female.jpg";
                      }
                      if (!empty($userData['profile_image']) && file_exists($userData['profile_image'])) {
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
    <div style="width:800px; margin: auto; min-height: 400px;">
        <div style="background-color: white; text-align: center; color: #405d9b">
            
        <?php
             $image = "images/f or m images/cover_image.jpg";
             if (!empty($userData['cover_image']) && file_exists($userData['cover_image'])) {
                 $image = $userData['cover_image'];
             }
             
                ?>
            <img src="<?php echo $image ?>" style="width: 100%;">
  
            <span style=" font-size: 12px">
                <?php
                 
                       $image = "images/f or m images/male.jpg";
                       if($userData['gender'] == "Female")
                       {
                           $image = "images/f or m images/female.jpg";
                       }
                       if(!empty($userData['profile_image']) && file_exists($userData['profile_image'])){
                        $image = $userData['profile_image'];
                    }
                    
                ?>
            <img src="<?php echo $image ?>" class="profilePhoto"><br/>
            <a style=" text-decoration: none; color: #f0h;" href="change_profile_img.php?change=profile">Change Profile Image</a> ||
            <a style=" text-decoration: none; color: #f0h;" href="change_profile_img.php?change=cover">Change Cover Image</a>
            </span>
           

            <br>
            <label style="font-size: 25px; font-weight:bold" ><?php echo $userData['first_name']." ".$userData['last_name']?></label>
            <br>
            <a href="timeline.php"> <div style="color:#3b5998 " class="menuButton" > Home </div></a>
            <a href="Settings.php"> <div style="color:#3b5998 " class="menuButton" > Settings </div></a>
            <a href="about.php"> <div style="color:#3b5998 " class="menuButton" > About </div></a>
           
        </div>

        <div style="display: flex;">
            <div style="min-height:400px;flex:1;">
                <div class="friendBar">
                    Friends
                    <br>

                    <?php

                    if($friends){
                        foreach ($friends as $FRIEND_ROW) {
                           

                            # code...
                            include ("user.php");
                        }

                    }

                    ?>

                </div>
            </div>
            
            <div style="min-height:400px;flex:2.5; padding:20px; padding-right: 0px;">
                <div class="post-box">
                    <form method="post" enctype="multipart/form-data">
                    <textarea name="post" placeholder="What's on your mind, Feras?"></textarea>
           
                   
                    
                    <input type="file" name="file" style="margin-right: 200px;">
                    <button type="submit">Post</button>
                    </form>
                </div>
               
                <div class="post-bar">

                <?php

                    if($posts){
                        foreach ($posts as $ROW) {
                            $user = new User();
                            $ROW_user = $user->get_user($ROW['user_id']);

                            # code...
                            include ("post.php");
                        }

                    }
                    
                ?>
                </div>
            </div>

        </div>
    </div>
  
<script>
   
    function validatePostForm() {
        let postContent = document.querySelector("textarea[name='post']").value.trim();
        if (postContent === "") {
            alert("Post content cannot be empty!");
            return false;
        }


        if (postContent.length < 10) {
            alert("Post content must be at least 10 characters long.");
            return false;
        }

        return true;
    }


    document.getElementById("postForm").addEventListener("submit", function(event) {
      
        if (!validatePostForm()) {
            event.preventDefault(); 
        }
    });
</script>

</body>
</html>
