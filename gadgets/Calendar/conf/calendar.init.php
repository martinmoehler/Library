<?php
    
    require_once 'calendar.conf.php';
    
    //require_once '../classes/calendar.class.php';
    
    
    // DATENBANK KREIEREN:
    
    if (CREATE_DB) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        if(!$mysqli->query("DROP TABLE IF EXISTS `".DB_TABLE_CALENDAR."`") ||
           
           !$mysqli->query("CREATE TABLE IF NOT EXISTS `".DB_TABLE_CALENDAR."` (
            `id` INT(11) AUTO_INCREMENT primary key NOT NULL,
            `date` DATE NOT NULL,
            `time` TIME,
            `title` TEXT NOT NULL,
            `description` TEXT NOT NULL)") ||
                
           !$mysqli->query("INSERT INTO `".DB_TABLE_CALENDAR."` (id, date, time, title, description) VALUES 
               (NULL,'2012-06-01', '12:00', 'Archiv 1', 'description'),
               (NULL,'2012-06-02', '12:00', 'Archiv 2', 'description'),
               (NULL,'2012-06-01', '12:00', 'Archiv 3', 'description'),
               (NULL,'2012-06-02', '12:00', 'Archiv 4', 'description'),
               (NULL,'2012-06-01', '12:00', 'Archiv 5', 'description'),
               (NULL,'2012-06-02', '12:00', 'Archiv 6', 'description'),
               (NULL,'2012-06-01', '12:00', 'Archiv 7', 'description'),
               (NULL,'2012-06-02', '12:00', 'Archiv 8', 'description'),
               (NULL,'2013-06-01', '12:00', 'Aktuell 1', 'description'),
               (NULL,'2013-06-02', '12:00', 'Aktuell 2', 'description'),
               (NULL,'2013-06-03', '12:00', 'Aktuell 3', 'description'),
               (NULL,'2013-06-04', '12:00', 'Aktuell 4', 'description'),
               (NULL,'2013-06-05', '12:00', 'Aktuell 5', 'description'),
               (NULL,'2013-06-06', '12:00', 'Aktuell 6', 'description'),
               (NULL,'2013-06-07', '12:00', 'Aktuell 7', 'description'),
               (NULL,'2013-06-08', '12:00', 'Aktuell 8', 'description'),
               (NULL,'2013-06-09', '12:00', 'Aktuell 9', 'description'),
               (NULL,'2013-06-10', '12:00', 'Aktuell 10', 'description')"
                   
            )){
            echo "Table creation failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }
?>
