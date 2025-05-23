<?php



include_once('Classes/post.php');
include('Profile.php');

//unset($_SESSION['user_id']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['id'];
    $user = new User();
    $userData = $user->getUserById($id);
} else {
    header("Location: login.php"); 
    exit();
}

if(isset ($_SERVER[ 'HTTP_REFERER' ]))
{

$return_to = $_SERVER['HTTP_REFERER'];

}else
{

$return_to = "profile.php";

}
if(isset($_GET[ 'type']) && isset($_GET['id'])){

    if(is_numeric($_GET['id'])){
        $allowed [] = 'post';
        $allowed [] = 'user';
        $allowed [] = ' comment';
        if(in_array($_GET[ 'type'], $allowed))
        {
        $post = new Post();
        $post->like_post($_GET['id'],$_GET['type'], $_SESSION['id']);
        
        }
    }
    

}




header ("Location: ". $return_to);
die;

