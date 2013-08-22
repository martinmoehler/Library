<?php
    
    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_USER')) define ( 'DB_USER', 'root' );
    if(!defined('DB_PW')) define ( 'DB_PW', 'ricoreserve3.5');
    if(!defined('DB_DB')) define ( 'DB_DB', 'library');
    
    
    $setup = Array (
        'Gallery' => Array (
            'id' => 0,
            'mgmtName' => 'Galerie',
            'mgmtPath' => '...',
            'mgmtPicture' => 'gfx/gallery.png',
            'mgmtPictureAlt' => '...'
        ),
        'Calendar' => Array (
            'id' => 1,                  
            'mgmtName' => 'Kalender',
            'mgmtPath' => '..',
            'mgmtPicture' => 'gfx/calendar.png',
            'mgmtPictureAlt' => '...'
        )
    );
    
?>
