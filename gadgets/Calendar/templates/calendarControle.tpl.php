<?php

/**
 * Variables given by _request.php:
 *  - $pathLeft
 *  - $pathRight
 *  - $instance
 *  - $type
 */
?>

<table>
    <tr>
        <td class='calendarControles' id='calnedarContrLeft'>
            <img title='Vorherige Termine' src='<?=$pathLeft ?>' alt='Previous Dates' onclick="<?=$instance ?>.previousDates('<?=$type ?>');">
        </td>
        <td class='calendarControles' id='calnedarContrLeft'>
            <img title='Nächste Termine' src='<?=$pathRight ?>' alt='Next Dates' onclick="<?=$instance ?>.nextDates('<?=$type ?>');">
        </td>
    </tr>
</table>