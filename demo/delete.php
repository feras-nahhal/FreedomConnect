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

$error=" ";
if(isset($_GET['id'])){

   $Post = new Post();
   $postrow = $Post->get_one_post($_GET['id']);
   if(!$postrow){
    $error = "there is no post found !";
   }

}else{
    $error = " there is no post found!";
}




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['postid'])) {
    $post = new Post();
    $result = $post->delete_post($_POST['postid']); // Pass only the postid
    if ($result) {
        header("Location: Profile.php");
        exit();
    } else {
        $error = "Error deleting the post.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deletepage for FerasBook</title>
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
  
     
        
      
         .post-box {
            background-color: white;
            padding: 10px;
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
            border: 1px solid#d0d8e4; /* Adding a border */
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
            <div style=" min-height:400px;flex:2.5; padding:20px; padding-right: 0px;">
        
            <!--post box area-->
            <form method="POST">
    <div class="post-box">
        <h2>Delete Post</h2>
        Are you sure you want to delete this post?<br><br>

        <!-- Post Content -->
        <div class="post">
            <div>
                <img src="<?php echo $image ?>" alt="User Photo">
            </div>
            <div class="post-content">
                <div class="name"><?php echo $userData['first_name'] . " " . $userData['last_name'] ?></div>
                <div class="timestamp"><?php echo $postrow['date'] ?></div>
                <div><?php echo htmlspecialchars($postrow['post']) ?></div>
                <div>
                    <?php
                    if (file_exists($postrow['image'])) {
                        $post_image = $postrow['image'];
                        echo "<img src='$post_image' style='width:90%; height:85%' />";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Pass the postid -->
        <input type="hidden" name="postid" value="<?php echo $postrow['postid']; ?>">

        <button id="Post_button" type="submit" value="Delete">Delete</button>
        <br>
    </div>
</form>


            </div>
        </div>

    </div>
       
</body>
</html>
 