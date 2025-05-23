<?php


session_start();
//unset($_SESSION['user_id']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('Classes/user.php');
include_once('Classes/post.php');
include_once('Classes/profile.php');

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['id'];
    $user = new User();
    $userData = $user->getUserById($id);
    $userData_og = $userData;
} else {
    header("Location: login.php"); 
    exit();
}


//new code!

$profile = new Profile();
$profile_data=$profile->get_profile($_GET['id']);
$userData= $profile_data[0];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orginal_user_id = $_SESSION['user_id'];
    $friend_user_id = $userData['user_id'];
    $user = new User() ;
    $result= $user->create_friend($orginal_user_id,$friend_user_id);

}

//new code!
//collect posts:

$user_id = $userData['user_id'];
$post = new Post();
$posts= $post->get_post($user_id);

//collect FRIENDS:

$user = new User();
$user_id = $userData['user_id'];
$friends= $user->get_friends($user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Friend profile for FerasBook</title>
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

            padding: 5px;
            border-radius: 10px;
            margin-right: 700px;
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
            background-color: #3b8f59;
            border: none;
            color: white;
            padding: 8px 25px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }
        .post-bar{
            background-color: #d0d8e4e;
            margin-top: 10px;
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
            <a style=" text-decoration: none;  color: white;" href="timeline.php">Feras Book &nbsp </a> 
            <form method="GET" action="search.php" style="display: inline;">
                <input type="text" name="query" id="searchbox" class="search_box" placeholder="Search in FerasBook" required>
                <button type="submit" style="display:none;"></button> <!-- Hidden button to allow Enter key to submit -->
            </form>
            <a
            <?php
                      $image = "images/f or m images/male.jpg";
                      if($userData_og['gender'] == "Female")
                      {
                          $image = "images/f or m images/female.jpg";
                      }
                if(file_exists(filename: $userData_og['profile_image'])){
                    $image = $userData_og['profile_image'];
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
                if(file_exists($userData['cover_image'])){
                    $image = $userData['cover_image'];
                }
                ?>
            <img src="<?php echo $image ?>" style="width: 100%;">


                <?php
                    // Assuming $user_id is the ID of the logged-in user and $friend_id is the ID of the user they are viewing
                    $DB = new DataBase();
                    $orginal_user_id = $_SESSION['user_id'];
                    $friend_user_id = $userData['user_id'];
                    // Check if they are already friends
                    $query = "SELECT * FROM friends WHERE user_id = '$orginal_user_id ' AND user_id_friend = '$friend_user_id'";
                    $result = $DB->read($query);

                ?>
                <div class="post-box">
                    <form method="post">
                        <?php
                        if ($result) {
                            // If they are already friends, show "We are friends"
                            echo "<p>We are friends</p>";
                        } else {
                            // If they are not friends, show the "Add Friends" button
                            echo '<button type="submit">Add Friends</button>';
                        }
                        ?>
                    </form>
                </div>



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
       
      
            <label style="font-size: 25px; font-weight:bold" ><?php echo $userData['first_name']." ".$userData['last_name']?></label>
            
            <br>
            <a href="timeline.php"> <div style="color:#3b5998 " class="menuButton" > Home </div></a>
           
            <a href="about_friend.php?id=<?php echo $userData['user_id'] ?>"> <div style="color:#3b5998 " class="menuButton" > About </div></a>
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
            
            <div style="min-height:400px;flex:2.5; ">
               
                <div class="post-bar">

                <?php

                    if($posts){
                        foreach ($posts as $ROW) {
                            $user = new User();
                            $ROW_user = $user->get_user($ROW['user_id']);

                            # code...
                            include ("newpost.php");
                        }

                    }
                    
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
