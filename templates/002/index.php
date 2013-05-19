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
        <div id ="title_box">
            <h1 id="title">Schlagzeug Duo</h1>
            <h2 id="slide1" class="slide-left">Lukas Böhm</h2>
            <h2 id="slide2" class="slide-right">Ni Fan</h2>
        </div>
        <div id="header">
                <ul>
                    <li>Termine</li>
                    <li>Kontakt</li>
                    <li>Fotos</li>
                    <li>Presse</li>
                    <li>Bild / Ton</li>
                </ul>
        </div>
        <div id="main">
            <div id="left">
                <div id="l_img_box" class="front_img_box"><img src="gfx/Lukas Boehm.jpg"></div>
            </div>
            <div id="body">
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
                SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - SchlagzeugDuo - 
            </div>
            <div id="right">
                <div id="r_img_box" class="front_img_box"><img src="gfx/Ni Fan.jpg"></div>
            </div>
        </div>
    </body>
</html>
