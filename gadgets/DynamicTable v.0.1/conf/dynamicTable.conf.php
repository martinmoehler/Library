<?php


    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_BENUTZER')) define ( 'DB_BENUTZER', 'root' );
    if(!defined('DB_KENNWORT')) define ( 'DB_KENNWORT', 'ricoreserve3.5');
    
    if(!defined('DB_DATENBANK')) define ( 'DB_DATENBANK', 'library');
    if(!defined('DB_TABLE_RELEASES')) define ( 'DB_TABLE_RELEASES', 'dynamictable');
    
    $init = array(
        'tmpl_columns'=>2,              //Anzahl der Spalten der Tabelle
        'tmpl_width'=>200,              //Breite eines Templates
        'tmpl_height'=>200,             //Höhe eines Templates
        'tmpl_picSize'=>200,            //Größe des Bildes (quadratisch)
        'tmpl_picOpenSize'=>200,        //Größe des Bildes (quadratisch)
        'tmpl_picOpacity'=>.3,          //Opacity des Release-Bildes
        'tmpl_picPosition'=>'center',   //(left|center|right)
        'tmpl_rowHeight'=>220,          //Reihenhöhe 
        'tmpl_columnWidth'=>220,        //Spaltenbreite
        'tmpl_popUpHeight'=>300,        //Höhe des PopUp - Fensters
        'tmpl_popUpWidth'=>250,         //Breite des PopUp - Fensters
        'tmpl_popUpFactorImg'=>3,       //Faktor um den das Bild (Cover) verkleinert wird beim popUp (1/Faktor)
        'tmpl_animationTime'=>200,      //Animationszeit des Poups  
        'tmpl_multiOpen'=>FALSE,        //Gibt an ob mehrere Einträge gleichzeitig geöffnet werden können (gilt nur wenn tmpl_openEvent => 'click'
        'tmpl_openEvent'=>'mouseover'   //Gibt an mit welchem mouse-Event das popUpTemplate geöffnet wird (click|mouseover)
        
    );
?>
