<?php
    /**
     *  Variables given by configuration:
     *  (allways starts with 'tmpl_*'!!)
     *   - 
     */
?>

<div id="tmpl_box-<?=$tmpl_id ?>" class="tmpl_box" style="
     top: <?php echo ($tmpl_row * $tmpl_rowHeight); ?>px;
     left: <?php echo ($tmpl_position * $tmpl_columnWidth); ?>px;
     width: <?=$tmpl_width ?>px;
     height: <?=$tmpl_height ?>px;
     ">



    <div id="tmpl_box-<?=$tmpl_id ?>_infos" class="tmpl_infos">
        <div class="tmpl_table_box" style="max-height: <?php echo $tmpl_popUpHeight - $tmpl_picSize * (1 /$tmpl_popUpFactorImg) - 15?>px">
            <img width="<?=$tmpl_picSize ?>" alt="<?=$tmpl_setupPictureAlt ?>" src="<?=$tmpl_setupPicture ?>" class="tmpl_picture">
            <div class="tmpl_title"><?=$tmpl_parentKey ?></div>
            <hr class="tmpl_hr">
            <br>
            <table>     
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>