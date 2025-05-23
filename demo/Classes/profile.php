<?php

class Profile{
    function get_profile($user_id){
        $DB = new DataBase();
        $query="SELECT * FROM users WHERE user_id = '$user_id' LIMIT 1";
        return $DB->read($query);

    }
}