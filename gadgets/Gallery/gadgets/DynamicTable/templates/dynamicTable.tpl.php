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
                <img height="<?=$tmpl_picSize ?>" width="<?=$tmpl_picSize ?>" alt="<?=$tmpl_description ?>" src="<?=$tmpl_thmbImg ?>" class="tmpl_picture">
                <div class="tmpl_table_box" style="max-height: <?php echo $tmpl_popUpHeight - $tmpl_picSize * (1 /$tmpl_popUpFactorImg) - 15?>px">
                    <!---
                    <div class="tmpl_title"><?php echo ($tmpl_row ." ". $tmpl_rowHeight); ?></div>
                    <hr class="tmpl_hr">
                    <br>
                    <table>     
                        <tbody>
                            <?php if ($tmpl_title) { ?>
                            <tr>
                                <td class="tmpl_table_key">T:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var1 ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($tmpl_description) { ?>
                            <tr>
                                <td class="tmpl_table_key">T:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var1 ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($tmpl_photographer) { ?>
                            <tr>
                                <td class="tmpl_table_key">T:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var1 ?></td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                    -->
                </div>
            </div>
            
        </div>
    </body>
</html>