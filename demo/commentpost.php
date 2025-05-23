<style>
    .post-actions a {
        margin-right: 5px; /* Adds space between all links */
    }

    .post-actions a:nth-child(2) {
        margin-right: 200px; /* Adds more space after the 'Comment' link */
    }
</style>

<div class="post">
        <a href="friend_profile.php?id=<?php echo $ROW_user['user_id']; ?>" >
            <div>
            
            <?php
                $image = "images/f or m images/male.jpg"; // Default image

                // Check for gender-specific image
                if ($ROW_user['gender'] == "Female") {
                    $image = "images/f or m images/female.jpg";
                }

                // Check if user has a profile image
                if ($ROW_user['profile_image']) {
                    $image = $ROW_user['profile_image'];
                }
            ?>
            <img src="<?php echo $image ?>" alt="User Photo">
            </div>
        </a>
 

    <div class="post-content">
        <div class="name"><?php echo $ROW_user['first_name'] . " " . $ROW_user['last_name']; ?></div>
        <div class="timestamp"><?php echo $comment_row['date']; ?></div>
        <div>
            <?php echo htmlspecialchars($comment_row['comment']); ?>
        </div>
        <div>
            <?php
                $image_class = new Image();

                // Check if post has an image
                if (file_exists($comment_row['image'])) {
                    $post_image = $comment_row['image'];
                    echo "<img src='$post_image' style='width:90%; height:85%' />";
                }
            ?>
        </div>
        
        <div>
   
        </div>
        
  
    </div>
</div>
