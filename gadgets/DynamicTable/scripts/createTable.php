<?php

    $templatesData = NULL;
    if (key_exists('templatesData', $_GET)) $templatesData = $_GET['templatesData'];
    if (key_exists('templatesData', $_POST)) $templatesData = $_POST['templatesData'];
    if (!$templatesData) die('Datasubmission failed.');
    
    require_once '../conf/dynamicTable.init.php';
    
    $table = new DynamicTable($init, $templatesData);
    echo json_encode($table);
?>
