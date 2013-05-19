
<?php

/**
 * Variables given by _request.php:
 *  - $id
 *  - $title
 *  - $description
 *  - $date
 */

?>
<div id ="date-<?php echo $id; ?>" class="dates">
    <table>
        <tr>
            <td class="calendarWhen">
                <ul>
                    <li class="calendarDate"><?php echo $date; ?></li>
                    <li class="calendarTime"><img src="gfx/clock.png" alt="icon" class="icon" width="17px"> <?php echo $time; ?></li>
                </ul>
            <td class="calendarWhat">
                <ul>
                    <li class="calendarTitle"><?php echo $title; ?></li>
                    <li class="calendarDescription"><?php echo $description; ?></li>
                </ul>
            </td>
        </tr>
    </table>
</div>