<?php
    
    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_USER')) define ( 'DB_USER', 'root' );
    if(!defined('DB_PW')) define ( 'DB_PW', 'ricoreserve3.5');
    
    if(!defined('DB_DB')) define ( 'DB_DB', 'library');
    if(!defined('DB_TABLE_CALENDAR')) define ( 'DB_TABLE_CALENDAR', 'calendar');
    
    
    /**
     * @var boolean If set to true the existing `calendar` Database will be 
     * deleted and a new one will be set up with some example dates. This Variable 
     * should should not set to true or you will reset your DB!
     */
    define ('CREATE_DB', true);
    
    /**
     * @var String Path to the Template-File for new dates.
     */
    define ('CLNDR_TMPL_NEW', '../templates/calendarNew.tpl.php');
    
    /**
     * @var String Path to the Template-File for old dates.
     */
    define ('CLNDR_TMPL_OLD', '../templates/calendarOld.tpl.php');
    
    /**
     * @var String Format of the Date printed in the Templates.
     */
    define ('CLNDR_TMPL_DATEFORMAT_NEW', 'j. M. y');
    
    /**
     * @var String Format of the Date printed in the Templates.
     */
    define ('CLNDR_TMPL_DATEFORMAT_OLD', 'd.m.Y');
    
    /**
     *  Path to the Controlepictures in two different colors
     */
    define ('CLNDR_CNTR_LEFT_WHITE', 'gfx/previous_white.png');
    define ('CLNDR_CNTR_LEFT_BLACK', 'gfx/previous_black.png');
    define ('CLNDR_CNTR_RIGHT_WHITE', 'gfx/next_white.png');
    define ('CLNDR_CNTR_RIGHT_BLACK', 'gfx/next_black.png');
    
?>
