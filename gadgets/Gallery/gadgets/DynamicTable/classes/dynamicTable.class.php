<?php

    class DynamicTable {
        
        /**
         *
         * @var string Logdaten der Klasse
         */
        private $_logString;
        
        /**
         *
         * @var Array Data for Templates from Database  
         */
        private $_templatesData;
        
        /**
         *
         * @var int Anzahl der Template-Data-Sätze in der Datenbank 
         */
        private $_numberOfTemplates;
        
        /**
         * 
         * @var array Variablen zur richtigen Darstellung der Templates
         */
        private $_templateVars;
        
        public function __construct(array $init, array $_templatesData = null) {
            foreach ($init as $key => $value) {
                if (strstr($key, "tmpl_")) {
                    $this->_templateVars[$key] = $value;
                }
            }
            if (!$_templatesData) {
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
                if ($mysqli->errno) {
                    $this->_log('Error', $mysqli->connect_error,__FUNCTION__,__LINE__);
                    die('Error. Check Log.');
                }
                $this->_log('.', 'Datenbank geöffnet.');

                $sql = "SELECT * FROM ".DB_TABLE;
                $this->_log('$sql', $sql);

                $result = $mysqli->query($sql);

                if(!$result) {
                    $this->_log('Error', $mysqli->error,__FUNCTION__,__LINE__);
                    die('Error. Check Log.');
                }

                while ($row = $result->fetch_assoc()) {
                    $this->_templatesData[$row['title']] = $row;
                }
                $this->_log('.Datenbank gelesen', $this->_templatesData);

                $mysqli->close($mysqli);
            } else {
                //Check $_templatesData
                
                foreach ($_templatesData as $key => $value) {
                    if (!is_string($key) || !is_array($value) || !count($value)>0){
                        $this->_log('Error','Parameter $_templatesData has wrong content.', __FUNCTION__, __LINE__);
                        die();
                    }
                }
                
                $this->_templatesData = $_templatesData;
                
                $this->_log('.Daten gelesen', $this->_templatesData);
            }
            // -----------------------------------------------------------
            
            $this->_countReleases();
        }
        
        
        public function printDataAsJSObject(){
            $JSObjectString = "{";
            
            foreach ($this->_templatesData as $objName => $templateData) {
                if(!is_array($templateData)) {
                    $this->_log('Fehler', 'Fehlende Daten.', __FUNCTION__,__LINE__);
                    return FALSE;
                }
                $JSObjectString .= "'".str_replace(" ", "_", $objName) ."' : {";
                foreach ($templateData as $key => $value) {
                    $JSObjectString .= "'$key' : '$value', ";
                }
                
                $JSObjectString = substr($JSObjectString, 0, -2);
                $JSObjectString .= "}, ";
            }
            $JSObjectString = substr($JSObjectString, 0, -2);
            $JSObjectString .= "}";
            return $JSObjectString;
             
        }
        public function printTemplate($_templatePath, $gallery, $index ,$_bool = FALSE) {
            if(!is_string($index)) $index = "" . $index;
            if(!file_exists($_templatePath)) {
                $_msg = "Fehlerhafte Anganben in ".__FILE__." in line ".__LINE__.".";
                return $_msg;
            }
            
            ob_start();
            
            extract($this->_templateVars);
            
            $i=$index;
            $templateData =$this->_templatesData[$gallery][$index];
            {
                foreach ($templateData as $key => $value) {
                    $templateData[PREFIX.$key] = $value;
                    unset($templateData[$key]);
                }
                $tmpl_row = intval( $i / $tmpl_columns );
                $tmpl_position = ($i % $tmpl_columns);
                
                extract($templateData);
                
                $i++;
                
                include $_templatePath;
            }
            
            $printText = ob_get_contents();
            ob_end_clean();
            
            if ($_bool === FALSE) {
                echo  $printText;
            } else {
                return $printText;
            }
        }
        
        public function printTemplates($_templatePath, $_bool = FALSE) {
            
            if(!file_exists($_templatePath)) {
                $_msg = "Fehlerhafte Anganben in ".__FILE__." in line ".__LINE__.".";
                return $_msg;
            }
            
            ob_start();
            
            extract($this->_templateVars);
            
            $i=0;
            foreach ($this->_templatesData as $templateData) { 
                foreach ($templateData as $key => $value) {
                    $templateData['tmpl_'.$key] = $value;
                    unset($templateData[$key]);
                }
                $tmpl_row = intval( $i / $tmpl_columns );
                $tmpl_position = ($i % $tmpl_columns);
                
                extract($templateData);
                
                $i++;
                
                include $_templatePath;
            }
            
            $printText = ob_get_contents();
            ob_end_clean();
            
            if ($_bool === FALSE) {
                echo  $printText;
            } else {
                return $printText;
            }
        }

        private function _countReleases(){
            
            $number = count($this->_templatesData);
            $this->_numberOfTemplates = $number;
            return $number;
        }

        private function _log ($methode = NULL, $log_string = NULL, $function = NULL, $line = NULL) {
            
            
            if($function) { $log_function = " in $function";} else {$log_function = "";}
            if($function) { $log_line = " in line $line";} else {$log_line = "";}
            
            $log_methode = $methode .$log_function.$log_line. ": ";
            if (is_array($log_string)) {
                $log_string = var_export ($log_string, true);
            }
            $this->_logString .= $log_methode.$log_string."<br>\n";

        }
        
        public function getLog(){
            return $this->_logString;
        }
        
        public function deleteLog(){
            $this->_logString = "";
            return true;
        }
        
        public function getHeight(){
            
            $rows = intval($this->_countReleases() / $this->_templateVars['tmpl_columns']);
            if ( ($this->_countReleases() % $this->_templateVars['tmpl_columns']) > 0) {
                $rows += 1;
            }
            return $rows * $this->_templateVars['tmpl_rowHeight'];
        }
        
        
        public function getWidth(){
            
            return $this->_templateVars['tmpl_columns'] * $this->_templateVars['tmpl_columnWidth'];
        }
        
    }
?>
