<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/xhtml2/DTD/xhtml1-strict.dtd">

    <?php
    require_once 'conf/calendar.init.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta name="author" content="Martin Möhler">
	<meta name="copyright" content="(c) Copyright 2013 Martin Möhler">
        <title>Calendar</title>
        
        <link href="calendar.css" rel="stylesheet" type="text/css">
        
        <script src="scripts/jquery.js" type="text/javascript"></script>
        <script src="classes/calendar.class.js" type="text/javascript"></script>
        
        
         <script type="text/javascript">
            $(document).ready(function () {
                myCalendar.setPrintLengthOld(6);
                myCalendar.setPrintLengthNew(4);
                myCalendar.setPrintLengthAll(1);
                
                myCalendar.printDates('newDates', 'new');
                myCalendar.printDates('oldDates','old');
                myCalendar.printDates('allDates','all');
                
                myCalendar.printControles('OldControle', 'black', 'old');
                myCalendar.printControles('NewControle', 'black', 'new');
                myCalendar.printControles('AllControle', 'black', 'all');
            });
        </script>
    </head>
    <body id ="body">
        
        
        <div id="content" class="content">
            <table id="oldDates"></table>
            <div id="OldControle"></div>
            
            <div id="newDates"></div>
            <div id="NewControle"></div>
            
            <div id="allDates"></div>
            <div id="AllControle"></div>
        </div>
        
    </body>
</html>
