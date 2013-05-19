<?php
/**
 * @todo Max-sizes for fileuploads ermitteln und umsetzen!
 */

    if(!defined('DB_HOST')) define ( 'DB_HOST', 'localhost' );
    if(!defined('DB_USER')) define ( 'DB_USER', 'root' );
    if(!defined('DB_PW')) define ( 'DB_PW', 'ricoreserve3.5');
    if(!defined('DB_DB')) define ( 'DB_DB', 'library');
    
    
    /**
     * @description Table in which additional Data should be safed in
     */
    define ( 'DB_TABLE_TO_UPLOAD', 'gallery');
    
    /**
     * @description Gives a default value to a field in the table of th DB which is connected to a file.
     *  key = fieldName, value = defaultValue (
     *  - 'fileName'
     *  - 'fullFileName' (+extension)
     * )
     */
    $fieldValues = Array (
        'fullImg' => 'fullFileName',
        'thmbImg' => 'fileName.png'
    );
    
    /**
     * @description Says which field represents which $variable for the upload in upload.php
     * key = fieldName, value = represents $var (
     * 
     * Example: 
     *  'gallery' => 'subfolder'
     *  means: the Value of the field `gallery` should be used as subfolder for the uploadPath.
     */
    $represents = Array (
        'fullImg' => 'filename',
        'thmbImg' => 'thmbname',        // Thumbnail wird automatisch erstellt
        'gallery' => 'subfolder'        // Ordner werden angelegt fass nicht vorhanden
    );
    
    
    /**
     * Uploadpath
     */
    define ('UPLOAD_PATH', 'upload/');
    
    /**
     * Maximal-sizes for pictures 
     */
    define ('PIC_MAX_WIDTH', 1000);
    define ('PIC_MAX_HEIGHT', 1000);
    
    
?>
