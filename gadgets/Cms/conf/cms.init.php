<?php
    error_reporting(E_ALL);
    
    require_once 'conf/cms.conf.php';
    
    //$setup is given by cms.conf.php!
    if ( !isset( $setup ) || !is_array($setup)) die('Fatal Error: Missing configuration data!');
    
   
?>
