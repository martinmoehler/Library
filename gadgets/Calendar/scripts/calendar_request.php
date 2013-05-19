<?php

    require '../conf/calendar.conf.php';
    
        
    /**
     * @todo $query auf bösartige Inhalte prüfen.
     */
    if (key_exists('query', $_POST)) {
        $query = $_POST['query'];
    }
    if (key_exists('query', $_GET)) {
        $query = $_GET['query'];
    }
    
    
    $clndr_req_mysqli =  new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
    if ($clndr_req_mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $clndr_req_mysqli->connect_errno . ") " . $clndr_req_mysqli->connect_error;
    }
    
    
    if (strstr($query, "-")) {
        //Split Querystring 
        $querys = preg_split("/\-/", $query);

        //Index 0 has to be the Type
        $type = $querys[0];
        // Set to default
        $from = -1;
        $to = -1;
        
        //var_dump($querys);
        
        //If Array has more then Type
        if (key_exists(1, $querys)) {
            for ($i = 1; $i < count($querys); $i++ ){
                $pattern = substr($querys[$i], 0, 3);
                
                //echo $querys[$i] . "-".$pattern . ", ";
                switch ($pattern) {
                    
                    case "FRM" :
                        $from = substr($querys[$i], 3, strlen($querys[$i]) - 3);
                        break;
                    case "TO*" :
                        $to = substr($querys[$i], 3, strlen($querys[$i]) - 3);
                        break;
                    case "CLR" :
                        $contr_color = substr($querys[$i], 3, strlen($querys[$i]) - 3);
                        break;
                    case "TYP" :
                        $contr_type = substr($querys[$i], 3, strlen($querys[$i]) - 3);
                        break;
                    case "INS" :
                        $classCalendarInst = substr($querys[$i], 3, strlen($querys[$i]) - 3);
                        break;
                    default:
                        echo "1Fehler im Request-Query. Query nicht erkannt.";
                        die();
                        break;
                }
            }
        }
    } else {
        $type = $query;
    }
    switch ($type) {
        case "PCC" :
            printCalendarControles( $contr_color, $classCalendarInst, $contr_type );
            break;
        case "PND" :
            printNewDates($from, $to);
            break;
        case "POD" :
            printOldDates($from, $to);
            break;
        case "PAD" :
            printAllDates($from, $to);
            break;
        case "CND" :
            echo countNewDates();
            break;
        case "COD" :
            echo countOldDates();
            break;
        case "CAD" :
            echo countAllDates();
            break;
        case "CPX" :
            echo countCpx();
            break;
        default:
            echo "Fehler im Request-Query. Query nicht erkannt: " . $type;
            die();
            break;
    }   
    
    /**
     * 
     * @return Mixed Returns FALSE on failure. Returns an Array on Success. 
     */
    function getAll() {
        global $clndr_req_mysqli;
        $result = $clndr_req_mysqli->query("SELECT * FROM `".DB_TABLE_CALENDAR."` ORDER BY date");
        if (!$result) {
            echo "Failed to read Database: (" . $clndr_req_mysqli->connect_errno . ") " . $clndr_req_mysqli->connect_error;
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $termine[] = $row;
        }
        return $termine;
    }
    
    function getNew() {
        $termine = getAll();
        $new = NULL;
        $today = date("Y-m-d");
        
        foreach ($termine as $index => $values) {
            if ($values['date'] > $today) {
                $new[] = $values;
            }
        }
        return $new;
    }
    
    function getOld() {
        $termine = getAll();
        $old = NULL;
        $today = date("Y-m-d");
        
        foreach ($termine as $index => $values) {
            if ($values['date'] < $today) {
                $old[] = $values;
            }
        }
        return $old;
    }
    
    
    
    function countNewDates() {
        return count(getNew());
    }
    
    function countOldDates() {
        return count(getOld());
    }
    
    function countAllDates() {
        return count(getAll());
    }
    
    function countCpx() {
        $arr["new"] = countNewDates();
        $arr["old"] = countOldDates();
        $arr["all"] = countAllDates();
        
        return json_encode($arr);
    }
    
    function printNewDates($_from , $_to) {
        $dates = getNew();
        for ($i = $_from; $i < $_to; $i++) {
            if (key_exists($i, $dates)) {
                //Format the date to given type (conf)
                $dates[$i]['date'] =  formatDate( $dates[$i]['date'], CLNDR_TMPL_DATEFORMAT_NEW );
                
                extract($dates[$i]);
                include CLNDR_TMPL_NEW;
            }
        }
    }
    
    function printOldDates($_from , $_to) {
        $dates = getOld();
        for ($i = $_from; $i < $_to; $i++) {
            if (key_exists($i, $dates)) {
                //Format the date to given type (conf)
                $dates[$i]['date'] =  formatDate( $dates[$i]['date'], CLNDR_TMPL_DATEFORMAT_OLD );
                extract($dates[$i]);
                include CLNDR_TMPL_OLD;
            }
        }
    }
    
    function printAllDates($_from , $_to) {
        $dates = getAll();
        for ($i = $_from; $i < $_to; $i++) {
            if (key_exists($i, $dates)) {
                //Format the date to given type (conf)
                $dates[$i]['date'] =  formatDate( $dates[$i]['date'], CLNDR_TMPL_DATEFORMAT_NEW );
                extract($dates[$i]);
                include CLNDR_TMPL_NEW;
            }
        }
    }
    
    function printCalendarControles ( $_color, $_instance, $_type ) {
        switch ($_color) {
            case "black" :
                $pathLeft = CLNDR_CNTR_LEFT_BLACK;
                $pathRight = CLNDR_CNTR_RIGHT_BLACK;
                break;
            case "white" :
                $pathLeft = CLNDR_CNTR_LEFT_WHITE;
                $pathRight = CLNDR_CNTR_RIGHT_WHITE;
            default:
                echo "Unerwarteter Fehler. Fehlendes Argument in printCalendarControles.";
                die();
        }
        $instance = $_instance;
        $type = $_type;
        
        include_once '../templates/calendarControle.tpl.php';
    }
    
    function formatDate( $_date, $_format) {
        $format = $_format;
        $arr = preg_split("/\-/", $_date);
        $_date = date($format, mktime(0, 0, 0, $arr[1], $arr[2], $arr[0]));
        return $_date;
    }
    
?>
