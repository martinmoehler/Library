<?php
    require 'conf/dynamicTable.init.php';
    
    $table = new DynamicTable($init);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="author" content="Martin Möhler" />
	<meta name="copyright" content="(c) Copyright 2013 Martin Möhler" />
        <title>Dynamic Table</title>
        
        <link href="dynamicTable.css" rel="stylesheet" type="text/css">
        
        <script src="scripts/jquery.js"></script>
        <script src="classes/dynamicTable.class.js"></script>
        
        <script type="text/javascript">
            
            var table = <?php echo $table->printDataAsJSObject() ?>;
            var init = <?php echo json_encode($init) ?>;
            
            
            $(document).ready(function(){
                for (i in table){
                    table[i].template = new Template('tmpl_box-'+table[i].id);
                }
                $.ajaxSetup ({
                    cache: false
                });
            });
        </script>
    </head>
    <body>
        <div id="main" class="" style="height: <?= 100 + $table->getHeight(); ?>px;">
            <!--<?= print_r($init); ?>-->
            <div id="content" class="content" style="
                 height: <?php echo $table->getHeight(); ?>px;
                width: <?php echo $table->getWidth(); ?>px;
                ">
                <?php
                    $table->printTemplates("templates/dynamicTable.tpl.php");
                ?>
                <script src="scripts/animation.js"></script>
            </div>
            
        </div>
    </body>
</html>
