<?php

    $templatesData = NULL;
    if (key_exists('templatesData', $_GET)) $templatesData = $_GET['templatesData'];
    if (key_exists('templatesData', $_POST)) $templatesData = $_POST['templatesData'];
    $templatesData = json_decode($templatesData, true);
    
    if (!$templatesData) die('Datasubmission failed.');
    
    require_once '../conf/dynamicTable.init.php';
    
    
    
    foreach ($templatesData as $gallery => $pictures) {
        $table = new DynamicTable($init, $templatesData, $gallery);
        $index = 0;
        foreach ($templatesData[$gallery] as $picture => $data) {
            $templatesData[$gallery][$picture]['templateHTML'] = $table->printTemplate('../templates/dynamicTable.tpl.php',$gallery,$index, true);
            $templatesData[$gallery]['tableData']['width'] = $table->getWidth();
            $templatesData[$gallery]['tableData']['height'] = $table->getHeight();
            $templatesData[$gallery]['tableData']['log'] = $table->getLog();
            $index++;
        }
    }
    
    echo json_encode($templatesData);
?>
