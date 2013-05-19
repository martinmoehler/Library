<?php
    
    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_USER')) define ( 'DB_USER', 'root' );
    if(!defined('DB_PW')) define ( 'DB_PW', 'ricoreserve3.5');
    if(!defined('DB_DB')) define ( 'DB_DB', 'library');
    
    
    $setup = Array (
        'Gallery' => Array (
            'id' => 0,
            'parentKey' => 'Gallery',
            'setupName' => 'Galerie',
            'setupPath' => '...',
            'setupPicture' => '...',
            'setupPictureAlt' => '...'
        ),
        'Calendar' => Array (
            'id' => 1,                  
            'parentKey' => ' ',         //Will be replaced with the right Key anyway...
            'setupName' => 'Galerie',
            'setupPath' => '..',
            'setupPicture' => '...',
            'setupPictureAlt' => '...'
        )
    );
    
?>
