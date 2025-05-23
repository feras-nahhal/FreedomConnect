<?php

class Image{

    public function crop_image($OG_file,$CB_file,$max_width,$max_height)
    {

        if(file_exists($OG_file))
        {
            $OG_image= imagecreatefromjpeg($OG_file);
            $OG_width= imagesx($OG_image);
            $OG_heigth= imagesy($OG_image);

            if($OG_heigth> $OG_width){
                $ratio= $max_width/$OG_width;
                $new_width= $max_width;
                $new_height = $OG_heigth * $ratio;

            }else{
                $ratio= $max_height/$OG_heigth;
                $new_height= $max_height;
                $new_width = $OG_width * $ratio;
            }

        }

        if($max_width != $max_height)
        {
            if($max_height > $new_width)
            {

                if($max_height > $new_height){
                    $adjesment= ($max_height/ $new_height);
                }else{
                    $adjesment= ($new_height/ $max_height);
                }
                $new_width = $new_width * $adjesment;
                $new_height=$new_height*$adjesment;

            }
            else
            {
                if($max_width > $new_width){
                    $adjesment= ($max_width/ $new_width);
                }else{
                    $adjesment= ($new_width/ $max_width);
                }
                $new_width = $new_width * $adjesment;
                $new_height=$new_height*$adjesment;

            }

        }
        
        $new_image = imagecreatetruecolor($new_width,$new_height);
        imagecopyresampled($new_image,$OG_image,0, 0, 0,0, $new_width, $new_height,$OG_width, $OG_heigth);

        imagedestroy($OG_image);

        if($max_width != $max_height)
        {

            if($max_width>$max_height){

                $diff =($new_height - $max_height);
                if($diff<0){
                    $diff = $diff * -1;
                }
               
                $y = round($diff/2);
                $x = 0;

            }else{

                $diff =($new_width - $max_height);
                if($diff<0){
                    $diff = $diff * -1;
                }
               
                $x = round($diff/2);
                $y = 0;

            }

        }
        else
        {

            if($new_height>$new_width){

                $diff =($new_height - $new_width);
                $y = round($diff/2);
                $x = 0;

            }else{

                $diff =($new_width - $new_height);
                $x = round($diff/2);
                $y = 0;

            }

        }

   

        $new_cropped_image = imagecreatetruecolor($max_width,$max_height);

        imagecopyresampled($new_cropped_image,$new_image,0, 0, $x,$y, $max_width, $max_height,$max_width, $max_height);


        imagedestroy($new_image);


        imagejpeg($new_cropped_image ,$CB_file,90);

        imagedestroy($new_cropped_image);

    }
}