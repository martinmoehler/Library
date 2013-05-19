<?php

    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_BENUTZER')) define ( 'DB_BENUTZER', 'root' );
    if(!defined('DB_KENNWORT')) define ( 'DB_KENNWORT', 'ricoreserve3.5');
    
    if(!defined('DB_DATENBANK')) define ( 'DB_DATENBANK', 'library');
    if(!defined('DB_TABLE_RELEASES')) define ( 'DB_TABLE_RELEASES', 'dynamictable');
    
    /**
     * @todo Not fully supportet yet! Changing prefix could lead to crashes of the gadget. Check dynamicTable.class.php for all prefixes!!
     * 
     */
    define('PREFIX', 'tmpl_');
    
    $init = array(
        PREFIX.'columns'=>2,              //Anzahl der Spalten der Tabelle
        PREFIX.'width'=>400,              //Breite eines Templates
        PREFIX.'height'=>200,             //Höhe eines Templates
        PREFIX.'picSize'=>200,            //Größe des Bildes (quadratisch)
        PREFIX.'picOpenSize'=>200,        //Größe des Bildes (quadratisch)
        PREFIX.'picOpacity'=>.3,          //Opacity des Bildes
        PREFIX.'picPosition'=>'left',     //(left|center|right)
        PREFIX.'rowHeight'=>300,          //Reihenhöhe 
        PREFIX.'columnWidth'=>450,        //Spaltenbreite
        PREFIX.'popUpHeight'=>220,        //Höhe des PopUp - Fensters
        PREFIX.'popUpWidth'=>420,         //Breite des PopUp - Fensters
        PREFIX.'popUpFactorImg'=>3,       //Faktor um den das Bild (Cover) verkleinert wird beim popUp (1/Faktor)
        PREFIX.'animationTime'=>200,      //Animationszeit des Poups  
        PREFIX.'multiOpen'=>FALSE,        //Gibt an ob mehrere Einträge gleichzeitig geöffnet werden können (gilt nur wenn tmpl_openEvent => 'click'
        PREFIX.'openEvent'=>'mouseover'   //Gibt an mit welchem mouse-Event das popUpTemplate geöffnet wird (click|mouseover)
        
    );
?>
