<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">

<?php

require_once 'conf/gallery.init.php';
require_once 'gadgets/DynamicTable/conf/dynamicTable.init.php';
?>



<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="author" content="Martin Möhler" />
	<meta name="copyright" content="(c) Copyright 2013 Martin Möhler" />
        <title>Gallery</title>

        <link href="gallery.css" rel="stylesheet" type="text/css">
        <link href="gadgets/DynamicTable/dynamicTable.css" rel="stylesheet" type="text/css">
        <script src="scripts/jquery.js" type="text/javascript"></script>
        <script src="classes/gallery.class.js" type="text/javascript"></script>
        <script src="gadgets/DynamicTable/classes/dynamicTable.class.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            
            var init = null;
            var table = null;
            var galleryData = null; 
            var galleryOptions = null;
            var galleryContainer = null;                            

            var Gallery = null;

            $(document).ready(function(){
                
            
                init = <?php echo json_encode($init) ?>;                        //configuration of dynamicTable                
                galleryData = null;                                             //!IMPORTANT
                galleryOptions = <?php echo json_encode($galleryOptions) ?>;    //!IMPORTANT
                galleryContainer = null;                                        //if null, a new Container will be placed in the body;
                
                Gallery = new classGallery ( galleryOptions, galleryData, galleryContainer, init );

                
                
                
            });
        </script>
        
            
        
    </head>
    
    <body>
        <?php
            include 'templates/rawHtml.tpl.php';
        ?>
        
    </body>
</html>
