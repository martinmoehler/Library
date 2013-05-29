<?php
    error_reporting(0);
    /**
     *  Variables given by configuration:
     *  (allways starts with 'tmpl_*'!!)
     *   - 
     */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">
<html>
    <body>
        <div id="tmpl_box-<?= substr(basename($tmpl_fullImg), 0,-4) ?>" class="tmpl_box" style="
             top: <?php echo ($tmpl_row * $tmpl_rowHeight); ?>px;
             left: <?php echo ($tmpl_position * $tmpl_columnWidth); ?>px;
             width: <?=$tmpl_width ?>px;
             height: <?=$tmpl_height ?>px;
             ">
            <div id="tmpl_box-<?=  substr(basename($tmpl_fullImg), 0,-4) ?>_infos" class="tmpl_infos">
                <img 
                    height="<?=$tmpl_picSize ?>" 
                    width="<?=$tmpl_picSize ?>" 
                    alt="<?=$tmpl_description ?>" 
                    src="<?=$tmpl_thmbImg ?>" 
                    class="tmpl_picture"
                    onclick="$('#'+Gallery.getGalleryContainer()).trigger('enterpictureviewer', '<?=$tmpl_fullImg ?>' )"
                    >
                
            </div>
            
        </div>
    </body>
</html>