<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<?php
    
    require_once 'conf/cms.init.php';
    
    //Initalize DynamicTable
    require 'gadgets/DynamicTable/conf/dynamicTable.init.php';
    foreach ($setup as $key => $data) {     //$setup is given by cms.init.php!
        $tplData[$key] = $data;
    }
    $table = new DynamicTable($init, $tplData);
    
    
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="author" content="Martin Möhler" />
	<meta name="copyright" content="(c) Copyright 2013 Martin Möhler" />
        <title>CMS</title>
        
        <link href="cms.css" rel="stylesheet" type="text/css">
        <link href="gadgets/DynamicTable/dynamicTable.css" rel="stylesheet" type="text/css">
        
        <script src="scripts/jquery.js" type="text/javascript"></script>
        <script src="classes/ClassLibrary.js" type="text/javascript"></script>
        <script src="classes/MVC.js" type="text/javascript"></script>
        <script src="classes/workspace.js" type="text/javascript"></script>
        
        <script src="gadgets/DynamicTable/classes/dynamicTable.class.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            var workspace;
            
            var table = <?php echo $table->printDataAsJSObject() ?>;
            var init = <?php echo json_encode($init) ?>;
            var DynamicTableLog = <?php echo json_encode($table->getLog()); ?>;
            
            console.log("DynamicTable Log: \n" + DynamicTableLog );
            
            $(document).ready(function(){
                for (i in table){
                    table[i].template = new Template('tmpl_box-'+table[i].id);
                }
                $.ajaxSetup ({
                    cache: false
                });
            
                
                Workspace.build([110, 35, 990, 700],'#main');
                
            });
        
            
        </script>
    </head>
    <body>
        <div id="main" class="" style="height: <?= 100 + $table->getHeight(); ?>px;">
            <!--<?php //print_r($init); ?>-->
            <div id="content" class="content" style="
                 height: <?php echo $table->getHeight(); ?>px;
                width: <?php echo $table->getWidth(); ?>px;
                ">
                <?php
                    $table->printTemplates("gadgets/DynamicTable/templates/dynamicTable.tpl.php");
                ?>
                <script type="text/javascript" src="gadgets/DynamicTable/scripts/animation.js"></script>
                <script type="text/javascript">
                    $(".tmpl_box").click(function(){
                        var managerSrc;
                        var workspace = $('#workspace');
                        var id = con.attr('id').split("-")[1];
                        
                        for (manager in table) {
                            if (manager.id == id) {
                                managerSrc = manager.mgmtPath;
                                break;
                            }
                        }
                        
                        
                    });
                </script>
            </div>
            
        </div>
    </body>
</html>

