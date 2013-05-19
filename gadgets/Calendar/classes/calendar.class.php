<?php

//require_once '../calendar.conf.php';

class Calendar {
    
    /**
     *
     * @var mysqliObject Holds the mysqliObject used to read the DataBase 
     */
    private $_mysqli;
    
    /**
     *
     * @var Array Holds the dates and their values. 
     */
    private $_dates;
    
    /**
     *
     * @var Array Holds coming dates and their values. 
     */
    private $_newDates;
    
    /**
     *
     * @var Array Holds old dates and their values. 
     */
    private $_oldDates;
    
    
    public function __construct() {
        
        $this->initDates();
    }
    
    /**
     * Reads the Database an saves the result into $this->dates.
     */
    private function readDB() {
        $mysqli =  new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        
        
        if (!$result = $mysqli->query("SELECT * FROM ".DB_TABLE_CALENDAR." ORDER BY date")) {
            echo "Failed to read Database: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            die();
        }
        $this->_mysqli = $mysqli;
        
        $index = 0;
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                $this->_dates[$index][$key] = $value;
            }
            $index++;
        }
    }
    
    private function initDates() {
        
        $this->readDB();
        
        $dates = $this->_dates;
        $newDates;
        $oldDates;
        
        $today = date("Y-m-d");
        
        for ($i = 0; $i < count($dates); $i++) {
            if ($dates[$i]['date'] < $today) {
                $oldDates[] = $dates[$i];
            } else {
                $newDates[] = $dates[$i];
            }
        }
        
        $this->_oldDates = $oldDates;
        $this->_newDates = $newDates;
        
    }
    
    
}

?>
