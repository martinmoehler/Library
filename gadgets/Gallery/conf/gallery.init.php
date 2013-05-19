<?php
    
    require_once 'conf/gallery.conf.php';
    require_once 'gadgets/DynamicTable/classes/dynamicTable.class.php';
    
    // DATENBANK KREIEREN:
    
    if (GALLERY_CREATE_DB) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if(!$mysqli->query("DROP TABLE IF EXISTS `".DB_TABLE_GALLERY."`") ||
           
           !$mysqli->query("CREATE TABLE IF NOT EXISTS `".DB_TABLE_GALLERY."` (
            `id` INT(11) AUTO_INCREMENT primary key NOT NULL,
            `fullImg` TEXT NOT NULL,
            `thmbImg` TEXT,
            `gallery` TEXT NOT NULL,
            `title` TEXT,
            `description` TEXT,
            `photographer` TEXT NOT NULL,
            `copyright` TEXT NOT NULL,
            `persons` TEXT)") ||
                
           !$mysqli->query("INSERT INTO `".DB_TABLE_GALLERY."` (id, fullImg, thmbImg, gallery, title, description, photographer, copyright, persons) VALUES 
               (NULL,'Autumn Leaves.jpg', '', 'Example', '', 'Herbstbild', 'unknown', 'no copyright', NULL),
               (NULL,'Creek.jpg', '', 'Example','', 'Flusslauf', 'unknown', 'no copyright', NULL),
               (NULL,'Desert Landscape.jpg', '', 'Example', '', 'Wüste', 'unknown', 'no copyright', NULL),
               (NULL,'Dock.jpg', '', 'Example', '', 'Hafen', 'unknown', 'no copyright', NULL)"
                   
            )){
            echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }
    
    // READ THE DATABASE AND STORE ITS DATA IN $galleryData
   $galleryData = null;
    
    if (GALLERY_READ_DB) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if($result = $mysqli->query("SELECT * FROM `".DB_TABLE_GALLERY."`")){
            while ($row = $result->fetch_assoc()) {
                $galleryData[$row['gallery']][] = $row;
            }
        } else {
            echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }
    
    
?>
