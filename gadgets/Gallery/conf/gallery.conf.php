<?php
    
    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_USER')) define ( 'DB_USER', 'root' );
    if(!defined('DB_PW')) define ( 'DB_PW', 'ricoreserve3.5');
    
    if(!defined('DB_DB')) define ( 'DB_DB', 'library');
    /**
     * Fields in Table:
     * 
     *   -> `id` INT(11) AUTO_INCREMENT primary key NOT NULL,
            `fullImg` TEXT NOT NULL,
            `thmbImg` TEXT
            `gallery` TEXT NOT NULL,
            `title` TEXT,
            `description` TEXT,
            `photographer` TEXT NOT NULL,
            `copyright` TEXT NOT NULL,
            `persons` TEXT
     */
    if(!defined('DB_TABLE_GALLERY')) define ( 'DB_TABLE_GALLERY', 'gallery');
    
    
    /**
     * @var boolean If set to true the existing `calendar` Database will be 
     * deleted and a new one will be set up with some example dates. This Variable 
     * should should not set to true or you will reset your DB!
     */
    define ('GALLERY_CREATE_DB', false);
    
    /**
     * @var boolean If set to true the existing `calendar` Database will be 
     * read and its data will be stored in $galleryData.
     */
    define ('GALLERY_READ_DB', true);
    
    /**
     * Path to the parentfolder of the galleries
     */
    define ('GALLERY_PATH', 'gfx/galleries/');
    
    /**
     * OPTIONS
     */
    $galleryOptions = Array (
        //If the Gallerydata is not stored in a Database these Selectors 
        //are used to get the Data out of HTML structure:
        'gallerySelector'=>'div.galleryContainer',
        'pictureSelector'=>'div.pictureContainer',
        'fullImageSelector'=>'img.fullImage',
        'thmbImageSelector'=>'img.thmbImage',
        'titleSelector'=>'h3.title',
        'descriptionSelector'=>'h4.description',
        'photographerSelector'=>'p.photographer',
        'copyrightSelector'=>'p.copyright',
        'personsSelector'=>'p.persons',
        
        //These Selectors are used to get the Information into the template
        'galleryChooser' => '#galleryChooserContainer',
        'pictureBox' => '#pictureBox',
        'previousBox' => '#previous',
        'nextBox' => '#next',
        'pictureContainer' => '#pictureContainer',
        
        //Options to define the behaviour of the Gallery
        'maxPicturesPerScreen' => 8,
        'dynamicallyChangeGallerySize' => false
        
        
    );
    
?>
