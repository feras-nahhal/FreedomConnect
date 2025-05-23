<?php
session_start();
//unset($_SESSION['user_id']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('Classes/user.php');
include_once('Classes/post.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($query)) {
    // Initialize User and Post classes
    $user = new User();
    $post = new Post();

    // Search for users by first name or last name
    $users = $user->search_users($query);

    // Search for posts that match the query
    $posts = $post->search_posts($query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .result-section {
            margin: 20px;
        }
        .result-section h2 {
            color: #3b5998;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .user-card, .post-card {
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .user-card a {
            text-decoration: none;
            font-weight: bold;
            color: #3b5998;
        }
        .post-card {
            display: flex;
            flex-direction: column;
        }
        .post-card p {
            font-size: 14px;
            margin: 5px 0;
        }
        .post-card small {
            color: #555;
        }
    </style>
</head>
<body>

<h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>

<div class="result-section">
    <!-- Display user results -->
    <h2>Users</h2>
<?php if (!empty($users)) { ?>
    <?php foreach ($users as $user) { ?>
        <div class="user-card" style="display: flex; align-items: center; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
            <a href="friend_profile.php?id=<?php echo $user['user_id']; ?>" style="text-decoration: none; color: #3b5998; flex: 1; display: flex; align-items: center;">
                <?php
                    $image = "images/f or m images/male.jpg";
                    if($user['gender'] == "Female") {
                        $image = "images/f or m images/female.jpg";
                    }
                    if(file_exists($user['profile_image'])) {
                        $image = $user['profile_image'];
                    }
                ?>
                <img src="<?php echo $image ?>" style="width: 50px; height: 50px; border-radius: 10px; margin-right: 10px;">
                <span><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
            </a>
        </div>
    <?php } ?>
<?php } else { ?>
    <p>No users found.</p>
<?php } ?>
</div>

</body>
</html>
