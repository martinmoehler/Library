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
        <div id="tmpl_box-<?=$tmpl_id ?>" class="tmpl_box" style="
             top: <?php echo ($tmpl_row * $tmpl_rowHeight); ?>px;
             left: <?php echo ($tmpl_position * $tmpl_columnWidth); ?>px;
             width: <?=$tmpl_width ?>px;
             height: <?=$tmpl_height ?>px;
             ">
            <div id="tmpl_box-<?=$tmpl_id ?>_infos" class="tmpl_infos">
                <div class="tmpl_table_box" style="max-height: <?php echo $tmpl_popUpHeight - $tmpl_picSize * (1 /$tmpl_popUpFactorImg) - 15?>px">
                    <div class="tmpl_title"><?php echo ($tmpl_row ." ". $tmpl_rowHeight); ?></div>
                    <hr class="tmpl_hr">
                    <br>
                    <table>     
                        <tbody>
                            <tr>
                                <td class="tmpl_table_key">Var 1:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var1 ?></td>
                            </tr>
                            <tr>
                                <td class="tmpl_table_key">Var 2:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var2 ?></td>
                            </tr>
                            <tr>
                                <td class="tmpl_table_key">Var 3:</td>
                                <td class="tmpl_table_value"><?=$tmpl_var3 ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </body>
</html>