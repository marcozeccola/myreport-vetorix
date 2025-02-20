<?php /*
 function compressImage($source, $destination, $quality) { 
        
        if($source != ""){
            $imgInfo = getimagesize($source); 
            $mime = $imgInfo['mime']; 
            
            switch($mime){ 
                case 'image/jpg': 
                    $image = imagecreatefromjpeg($source); 
                    break; 
                case 'image/jpeg': 
                    $image = imagecreatefromjpeg($source); 
                    break; 
                case 'image/png': 
                    $image = imagecreatefrompng($source); 
                    break; 
                case 'image/gif': 
                    $image = imagecreatefromgif($source); 
                    break; 
                default: 
                    $image = imagecreatefromjpeg($source); 
            } 
            
            // Save image 
            imagejpeg($image, $destination, $quality);
    
            // Return compressed image 
            return $destination; 
        }
        
    }
   */
?>