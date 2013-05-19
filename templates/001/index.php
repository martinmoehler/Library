<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title></title>
        
        <link type="text/css" href="index.css" rel="stylesheet">
     
        <script src="script/jquery.js"></script>
        <script src="script/elementSlider.js"></script>
        <script type="text/javascript">
            Slide = new ElementSlider();
            

            $(document).ready(function(){
                $.ajaxSetup ({cache: false});
                
                newElem = {
                    "element" : $('#slide1'),
                    "start" : "left"
                };
                Slide.newElement(newElem);

                newElem = {
                    "element" : $('#slide2'),
                    "start" : "right"
                };
                Slide.newElement(newElem);
                
                Slide.slideIn();
            });
            
        </script>
    </head>
    <body>
        <div id="header">
            <h1 id="title">Duo Sonstewie</h1>
            <h2 id="slide1" class="slide-left">Lukas Böhm</h2>
            <h2 id="slide2" class="slide-right">Ni Fan</h2>
        </div>
        <div id="body">
        </div>
    </body>
</html>
