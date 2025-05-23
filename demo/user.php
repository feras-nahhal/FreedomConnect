<a href="friend_profile.php?id=<?php echo $FRIEND_ROW['user_id']; ?>" class="friend-card">

<?php

     $image = "images/f or m images/male.jpg";
     if($FRIEND_ROW['gender'] == "Female")
     {
         $image = "images/f or m images/female.jpg";
     }
    if($FRIEND_ROW['profile_image'] )
    {
        $image = $FRIEND_ROW['profile_image'] ;
    }
?>
<img src="<?php echo $image ?>" class="friendsPhoto">
<label>
    <?php
    echo $FRIEND_ROW['first_name'] . " ". $FRIEND_ROW['last_name'] 
    ?>
</label>
</a>

