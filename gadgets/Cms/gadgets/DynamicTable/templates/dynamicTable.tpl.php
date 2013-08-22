<?php
    /**
     *  Variables given by configuration:
     *  (allways starts with 'tmpl_*'!!)
     *   - 
     */

     $imgLeft = $tmpl_padding;
     if ($tmpl_picPosition == "center") {
         $imgLeft = ($tmpl_width - $tmpl_picSize) / 2 + $tmpl_padding. "px";
     }
?>

<div id="tmpl_box-<?=$tmpl_id ?>" class="tmpl_box" style="
     top: <?php echo ($tmpl_row * $tmpl_rowHeight); ?>px;
     left: <?php echo ($tmpl_position * $tmpl_columnWidth); ?>px;
     width: <?=$tmpl_width ?>px;
     height: <?=$tmpl_height ?>px;
     ">
    
    <img 
        width="<?=$tmpl_picSize ?>" 
        style="left: <?=$imgLeft ?>" 
        alt="<?=$tmpl_mgmtPictureAlt ?>" 
        src="<?=$tmpl_mgmtPicture ?>" 
        class="tmpl_picture"
        >    
    
    <div class="tmpl_identity" style="display: none;"><?=$tmpl_parentKey ?></div>
    
    <div id="tmpl_box-<?=$tmpl_id ?>_infos" class="tmpl_infos" style="padding: <?=$tmpl_padding; ?>">
        
        <div class="tmpl_table_box" style="max-height: <?php echo $tmpl_popUpHeight - $tmpl_picSize * (1 /$tmpl_popUpFactorImg) - 15?>px">
            
            <div class="tmpl_title"><?=$tmpl_mgmtName ?></div>
        </div>
    </div>

</div>