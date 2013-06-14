<?php
    // Diese Funktion gibt es im Original unter [url]www.codeschnipsel.net[/url]
    // Modifizierte Version unter [url]http://www.developers-guide.net/c/149-thumbnails-erstellen-kleine-funktion.html[/url]
    // Author: Jann Hendrik
    // Modified: Martin Möhler

    function mkthumb($img_src,      // Dateiname
        $img_width  = "400",        // max. Größe in x-Richtung
        $img_height = "400",        // max. Größe in y-Richtung
        $folder_scr = "pictures",   // Ordner der normalen Bilder
        $des_src    = "thumbs",     // Ordner der Thumbs
        $thmb_type = ".png",        // MimeType des Thumbs          
        $img_square = true )        // Bild auf Quadratische Form zuschneiden
    {
        
        // Größe und Typ ermitteln
        list($src_width, $src_height, $src_typ) = getimagesize($folder_scr."/".$img_src);
        
        // Thumb Namen erstellen
        $thmb_name = substr($img_src, 0, strpos($img_src, ".")- strlen($img_src)) . $thmb_type;
        
        // neue Größe bestimmen
        if($src_width >= $src_height)
        {
            $new_image_width = $img_width;
            $new_image_height = $src_height * $img_width / $src_width;
        }
        if($src_width < $src_height)
        {
            $new_image_height = $img_width;
            $new_image_width = $src_width * $img_height / $src_height;
        }

        if($src_typ == 1)         // GIF
        {
            $image = imagecreatefromgif($folder_scr."/".$img_src);
            $new_image = imagecreate($new_image_width, $new_image_height);
            
            imagecopyresampled(
                $new_image, 
                $image, 
                0, 
                0, 
                $src_width - $new_image_width, 
                $src_height - $new_image_height, 
                $new_image_width,
                $new_image_height, 
                $src_width, 
                $src_height
            );
            
            switch ($thmb_type) {
                case '.png' :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
                case '.jpg' :
                    imagejpeg($new_image, $des_src."/".$thmb_name, 100);
                    break;
                case '.gif' :
                    imagegif($new_image, $des_src."/".$thmb_name, 100);
                    break;
                default :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
            }
            imagedestroy($image);
            imagedestroy($new_image);
            return true;
        }
        elseif($src_typ == 2) // JPG
        {
            $image = imagecreatefromjpeg($folder_scr."/".$img_src);
            $new_image = imagecreatetruecolor($new_image_width, $new_image_height);
            
            imagecopyresampled(
                $new_image,$image, 0, 0, 0, 0, $new_image_width, $new_image_height, $src_width, $src_height
            );
            
            switch ($thmb_type) {
                case '.png' :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
                case '.jpg' :
                    imagejpeg($new_image, $des_src."/".$thmb_name, 100);
                    break;
                case '.gif' :
                    imagegif($new_image, $des_src."/".$thmb_name, 100);
                    break;
                default :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
            }
            imagedestroy($image);
            imagedestroy($new_image);
            return true;
        }
        elseif($src_typ == 3) // PNG
        {
            $image = imagecreatefrompng($folder_scr."/".$img_src);
            $new_image = imagecreatetruecolor($new_image_width, $new_image_height);
            
            imagecopyresampled(
                $new_image,$image, 0, 0, 0, 0, $new_image_width, $new_image_height, $src_width, $src_height
            );
            
            
            switch ($thmb_type) {
                case '.png' :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
                case '.jpg' :
                    imagejpeg($new_image, $des_src."/".$thmb_name, 100);
                    break;
                case '.gif' :
                    imagegif($new_image, $des_src."/".$thmb_name, 100);
                    break;
                default :
                    imagepng($new_image, $des_src."/".$thmb_name);
                    break;
            }
            imagedestroy($image);
            imagedestroy($new_image);
            return true;
        }
        else
        {
            return false;
        }
    }
    ?>        