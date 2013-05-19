<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<?php
    
    require_once 'conf/fileupload.init.php';
    
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PW, DB_DB);
    $result = $mysqli->query("SHOW FIELDS FROM ".DB_TABLE_TO_UPLOAD);
    foreach ($result as  $field_parent) {
        $fields[] = $field_parent['Field'];
    };
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="author" content="Martin Möhler" />
	<meta name="copyright" content="(c) Copyright 2013 Martin Möhler" />
        <title>Fileupload</title>

        <link href="style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var fields = <?= json_encode($fields); ?>;
            var fieldValues = <?= json_encode($fieldValues); ?>;  //defined in *.conf.php
        </script>
        <script src="scripts/jquery.js" type="text/javascript"></script>
        
    </head>
    <body>
        <div id="main">
            <h1>Fileupload</h1>
            <div class="content">
                <div id="uploadContainer">
                    <input type="file" name="files[]" id="fileInput" multiple>
                    
                    <div id="dragContainer">
                        Drag your files here ... <hr> Or click to choose from filebrowser.
                    </div>
                    <input type="button" value="Daten Absenden" onclick="Upload.uploadFiles();">
                    <div id="fileContainer">
                        
                    </div>
                </div>
            </div>
            <script src="scripts/multiUpload.js" type="text/javascript"></script>
        </div>
    </body>
</html>

