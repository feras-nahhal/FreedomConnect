<?php
include_once('Classes/image.php'); 
include_once('connect.php'); 
class Post{



    private $error = "";
    public function create_post($user_id, $data, $files) {
        if (!empty($data['post']) || !empty($files['file']['name'])) {
            $myimage = "";
            $has_image = 0;
    
            if (!empty($files['file']['name'])) {
                $image_class = new Image();
                $folder = "uploads/" . $user_id . "/";
    
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "");
                }
    
                $myimage = $folder . basename($files['file']['name']);
                if (move_uploaded_file($files['file']['tmp_name'], $myimage)) {
                    if (file_exists($myimage)) {
                        $image_class->crop_image($myimage, $myimage, 1000, 1000);
                    } else {
                        $this->error .= "File does not exist or is not valid.<br>";
                    }
                } else {
                    $this->error .= "Failed to upload file.<br>";
                }
                $has_image = 1;
            }
    
            $post = addslashes($data['post']);
            $post_id = $this->createpostId();
    
            $query = "INSERT INTO posts (user_id, postid, post, image, has_image) VALUES ('$user_id', '$post_id', '$post', '$myimage', '$has_image')";
            
            $DB = new DataBase();
            $result = $DB->execute($query);
            if (!$result) {
                $this->error .= "Failed to insert post into database: " . mysqli_error($DB->getConnection()) . "<br>";
            }
        } else {
            $this->error .= "Please type something to post!<br>";
        }
    
        return $this->error; // Return any errors
    }
    

    public function edit_post($postid, $new_content) {

        if (!is_numeric($postid)) {
            return false;
        }
    
        $query = "UPDATE posts SET post = '$new_content' WHERE postid = '$postid'";
    
        $DB = new DataBase();
        return $DB->execute($query); 
    
    }
    public function get_all_posts() {
        // Query to get posts from all users, ordered by latest posts (descending)
        $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 10";
    
        // Instantiate the database connection
        $DB = new DataBase();
        $result = $DB->read($query);
    
        // Return the result if there are posts, otherwise return false
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    
    public function get_post($user_id){

        $query = "select * from posts where user_id = '$user_id' order by id desc limit 10";

        $DB = new DataBase();
        $result= $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function get_comments($post_id){

        $query = "select * from comments where postid= '$post_id' order by id asc limit 10";

        $DB = new DataBase();
        $result= $DB->read($query);

        if($result){
            return $result;
        }else{
            return false;
        }
    }


    public function search_posts($query) {
        $stmt = "SELECT posts.*, users.first_name, users.last_name FROM posts 
                                    JOIN users ON posts.user_id = users.id 
                                    WHERE posts.post ='$query'";
           $DB = new DataBase();
           return $DB->read( $stmt);
           if($result){
               return $result;
           }else{
               return false;
           }
    }

    

    public function like_post($post_id, $type, $ferasbook_user_id) {
        $DB = new DataBase;
    
        if ($type == "post") {
            // Retrieve existing likes from the 'likes' table
            $query = "SELECT likes FROM likes WHERE type='post' AND contentid = '$post_id' LIMIT 1";
            $result = $DB->read($query);
    
            if (is_array($result) && isset($result[0])) {
                // Likes exist, check if user has already liked the post
                $likes = json_decode($result[0]['likes'], true);  // Decoding JSON into array
                
                if (is_array($likes)) {
                    $user_ids = array_column($likes, "user_id");
    
                    // Check if the user has already liked the post
                    if (!in_array($ferasbook_user_id, $user_ids)) {
                        // User has not liked the post, proceed with liking
                        $arr = ["user_id" => $ferasbook_user_id, "date" => date("Y-m-d H:i:s")];
                        $likes[] = $arr;  // Add new like to the array
    
                        // Update the likes count in the 'posts' table
                        $query = "UPDATE posts SET `likes` = likes + 1 WHERE postid = '$post_id' LIMIT 1";
                        $DB->execute($query);
    
                        // Encode updated likes and update the 'likes' table
                        $like_string = json_encode($likes);
                        $query = "UPDATE likes SET likes = '$like_string' WHERE type='post' AND contentid = '$post_id' LIMIT 1";
                        $DB->execute($query);
                    }
                }
            } else {
                // If no likes exist, create a new record for the first like
                $arr = ["user_id" => $ferasbook_user_id, "date" => date("Y-m-d H:i:s")];
                $likes = json_encode([$arr]);
    
                // Insert into 'likes' table
                $query = "INSERT INTO likes(type, contentid, likes) VALUES ('$type', '$post_id', '$likes')";
                $DB->execute($query);
    
                // Also update the post's likes count in the 'posts' table
                $query = "UPDATE posts SET `likes` = likes + 1 WHERE postid = '$post_id' LIMIT 1";
                $DB->execute($query);
            }
        }
    }
 
    private function createpostId() {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }
    public function get_one_post($postid){
        if(!is_numeric($postid)){
            return false;
        }

        $query = "select * from posts where postid = '$postid'  limit 1";

        $DB = new DataBase();
        $result= $DB->read($query);

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function create_comment($user_id,$data,$files,$post_id){

        if(!empty($data['post']) || !empty($files['file']['name']))
        {
            $myimage="";
            $has_image = 0;
            if(!empty($files['file']['name'])){
    
                $image_class = new Image();
    
    
    
                $folder = "uploads/" . $user_id . "/";
                //create folder
                if(!fiLe_exists($folder)){
    
                    mkdir ($folder, 0777, true);
                    file_put_contents($folder."index.php","");
    
                }
                $image_class = new Image();
                $myimage = $folder . basename($files['file']['name']); // Correct file path
                if (move_uploaded_file($files['file']['tmp_name'], $myimage)) {
                    if (file_exists($myimage)) {
                        $image_class->crop_image($myimage, $myimage, 1000, 1000);
                    } else {
                        echo "File does not exist or is not valid.";
                    }
                } else {
                    echo "Failed to upload file.";
                }
                $has_image = 1;
    
            }
            $post = addslashes($data['post']);
            
         
    
            $query = "insert into comments (user_id,postid,comment,has_image,image) values ('$user_id','$post_id','$post','$has_image','$myimage')";
    
            $DB = new DataBase();
            $DB->execute($query);
    
         
    
        }else{
    
            $this->error .= "please type any thig to post!<br>";
    
        }
    
        return $this->error;
    
    }
    

    public function delete_post($postid) {
        if (!is_numeric($postid)) {
            return false;
        }
    
        $query = "DELETE FROM posts WHERE postid = '$postid' LIMIT 1";
    
        $DB = new DataBase();
        return $DB->execute($query); // Return the result of the delete operation
    }
    
}





?>
