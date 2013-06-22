<?php

    require_once '../conf/fileupload.conf.php';
    
    key_exists('tableData', $_POST) ? $tableData = json_decode($_POST['tableData']) : die('Missing data.');
    is_array($_FILES) ? $files = $_FILES : die('Missing data');
    
    if(     !defined('DB_TABLE_TO_UPLOAD') ||
            !defined('UPLOAD_PATH')) die ('Missing configuration.');
    
    
    
    $mysqli  = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB) or die('Verbindung zur Datenbank fehlgeschlagen');
    
    //Check whether the fields given by JS are the same as these given by the DB
    
    $validationSQL = "SHOW FIELDS FROM " . DB_TABLE_TO_UPLOAD;
    $result = $mysqli->query($validationSQL);
    while($field = $result->fetch_assoc()) {
        $fields[] = $field['Field'];
    };
    
    //First Field should be id and it was left out in JS; See multiUpload.js : includeTemplate()
    $i=1;
    foreach ($tableData[0] as $JSfield => $value) {
        if($fields[$i] != $JSfield) die('Unequal field names');
        $i++;
    }
    
    //check for the right ending...
    substr(UPLOAD_PATH, -1, 1) === "/" ? $uploadpath = "../".UPLOAD_PATH : $uploadpath = "../".UPLOAD_PATH . "/";
    
    //Try to upload the files!
    for ( $i = 0; $i < count($files); $i++) {
        $file = $files["file_".$i];
        
        $uploaddir = $uploadpath;
        
        //check whether field represents a special variable such as $subfolder
        $subfolder = null;
        $filename = null;
        $thmbname = null;
        
        foreach($tableData[$i] as $JSfield => $value) {
            if (key_exists($JSfield, $represents)) {
                switch ($represents[$JSfield]) {
                    case 'subfolder':
                        $subfolder = $value;
                        break;
                    case 'filename' :
                        $filename = $value;
                        break;
                    case 'thmbname' :
                        $thmbname = $value;
                        break;
                }
            }
        };
                
        if ($subfolder) {
            //check wheter the string contains illegal characters
            if (stristr($subfolder, '/') || stristr($subfolder, '.')) die('Subfolder contains illegal characters.');
            
            $uploaddir = $uploadpath . $subfolder . "/";
            //check whether the given subfolder exists and create it if not
            
            if(!is_dir($uploaddir)) mkdir($uploaddir);
            
        }
        
        if ( $filename ) {
            
        }
        
        if (!$filename ) {
            $filename = basename($file['name']);
        };
        
        $uploadfile = $uploaddir.$filename;
        
        if (move_uploaded_file($file['tmp_name'], $uploadfile))
            $uploadSucced = true;
        else
            die("ERROR - uploading file");
        
        if($uploadSucced) {
        // Create Thumbail if wished.
            if ($thmbname) {
                $thmbdir = $uploaddir;
                
                error_reporting(E_ALL);
                include_once("../classes/Picture.class.php");
                $thumbnail = new thumbnail();
                $thumbnail->create($uploadfile);
                $thumbnail->setQuality(90);
                $thumbnail->resize(200);
                $thumbnail->cube(200);
                $thumbnail->save($thmbdir.$thmbname);
                /*
                 * require_once 'mkthmb.php';
                if(!mkthumb($filename, 200, 200, $uploaddir, $thmbdir)) {
                    die("Error occured while creating the thumbnail.");
                };
                 * 
                 */
            }
            
        // Write data in the DB!!
            
            $values = null;
            $values = Array();
            
            //First field (id) 
            $values[] = 'NULL';
            foreach ($tableData[$i] as $key => $value) {
                $values[] = $value;
            }
            
        //Create a string like this (field, field, field, ...)
            $fieldsString = "(";
            foreach ($fields as $field) {
                $fieldsString .= $field.", ";
            }
            //cut the last `, ` away.
            $fieldsString = substr($fieldsString, 0, strlen($fieldsString) -2);
            $fieldsString .= ")";

        //Create a string like this (value, value, value, ...)
            $valuesString = "(";
            foreach ($values as $value) {
                if ($value != 'NULL') {
                    $valuesString .= "'".$value."', ";
                } else {
                    $valuesString .= $value.", ";
                }
                    
            }
            //cut the last `, ` away.
            $valuesString = substr($valuesString, 0, strlen($valuesString) -2);
            $valuesString .= ")";
            
            $querry = "INSERT INTO `" . DB_TABLE_TO_UPLOAD . "` " . $fieldsString . " VALUES " . $valuesString;
            
            if(!$mysqli->query($querry)) die("Fehler im Query!");
            
            
        }
    }
?>
