<style>
    .post-actions a {
        margin-right: 5px; /* Adds space between all links */
    }

    .post-actions a:nth-child(2) {
        margin-right:15px; /* Adds more space after the 'Comment' link */
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
        <div class="timestamp"><?php echo $ROW['date']; ?></div>
        <div>
            <?php echo htmlspecialchars($ROW['post']); ?>
        </div>
        <div>
            <?php
                $image_class = new Image();

                // Check if post has an image
                if (file_exists($ROW['image'])) {
                    $post_image = $ROW['image'];
                    echo "<img src='$post_image' style='width:90%; height:85%' />";
                }
            ?>
        </div>
        
        <div>
            <?php
                $likes = ""; // Initialize the variable
                if ($ROW['likes'] == 0) {
                    $likes = ""; // Empty if no likes
                } else {
                    $likes = " you have ".$ROW['likes'] . " Likes"; // Concatenate likes with "Likes" text
                }
            ?>
        </div>
        
        <div class="post-actions">
    <?php echo $likes; ?><br>
    <a href="like.php?type=post&id=<?php echo $ROW['postid']; ?>">Like</a>
    <a href="coment.php?type=post&id=<?php echo $ROW['postid']; ?>&userid=<?php echo $ROW_user['user_id']; ?>">Comment</a>
 
</div>

    </div>
</div>
