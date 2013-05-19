


function Template(containerID){
    var classTemplate = this;
    
    this.container = $('#'+containerID);
    this.position = this.container.position();

    this.openHeight = init['tmpl_popUpHeight'];
    this.openWidth = init['tmpl_popUpWidth'];
    this.openTop = this.position.top - (init['tmpl_popUpHeight'] - init['tmpl_height'])/ 2;
    this.openLeft = this.position.left - (init['tmpl_popUpWidth'] - init['tmpl_width'])/ 2;
    this.openZIndex = 99;

    this.closeHeight = init['tmpl_height'];
    this.closeWidth = init['tmpl_width'];
    this.closeTop = this.position.top;
    this.closeLeft = this.position.left;
    this.closeZIndex = 1;

    this.fade = "";
    this.picClose = init['tmpl_picSize'];   //init['tmpl_picSize'];
    this.picOpen = init['tmpl_picOpenSize'];    //init['tmpl_picSize'] / init['tmpl_popUpFactorImg'];
    this.picOpacity = init['tmpl_picOpacity'];
    this.picPosition = init['tmpl_picPosition'];             

    this.titleHeight = 80;                 //this.picOpen

    this.status = "closed";

    this.open = function() {
        this.status = "progress";

        container = this.container;

        this.container.animate({
            height: this.openHeight , 
            width: this.openWidth ,
            top: this.openTop,
            left: this.openLeft,
            zIndex: this.openZIndex
            
        }, init['tmpl_animationTime'] );

        $('div.tmpl_title_box', this.container).animate({
            height: this.titleHeight
        }, init['tmpl_animationTime']);

        switch (this.picPosition) {
            case 'left' :
                $('img', this.container).animate({
                    left: 5,
                    width: this.picOpen,
                    height: this.picOpen,
                    opacity: this.picOpacity

                },init['tmpl_animationTime']);
                break;
            case 'center' :
                $('img', this.container).animate({
                    left: (this.openWidth - this.picOpen) / 2 + 5,
                    top: (this.openHeight - this.picOpen) / 2 + 5,
                    width: this.picOpen,
                    height: this.picOpen,
                    opacity: this.picOpacity

                },init['tmpl_animationTime']);
                break;
            case 'right' :
                $('img', this.container).animate({
                    right: 5,
                    width: this.picOpen,
                    height: this.picOpen,
                    opacity: this.picOpacity
                    
                },init['tmpl_animationTime']);
                break;
        }
        $('img', this.container).animate({
            width: this.picOpen,
            height: this.picOpen,
            opacity: this.picOpacity

        },init['tmpl_animationTime'], function(){
            classTemplate.status = "opened";
            //$(this).parent().parent().parent().css('z-index','99')

        });

        $('div.tmpl_infos .tmpl_table_box',this.container).fadeIn(100);
        $('div.tmpl_infos .tmpl_title',this.container).fadeIn(100);
    }

    this.close = function () {
        this.status = "progress";

        $('div.tmpl_infos .tmpl_table_box',this.container).fadeOut(100);
        $('div.tmpl_infos .tmpl_title',this.container).fadeOut(100);

        this.container.animate({
            height: this.closeHeight , 
            width: this.closeWidth ,
            top: this.closeTop,
            left: this.closeLeft

        }, init['tmpl_animationTime']);

        $('img', this.container).animate({
            left: 5,
            top: 5,
            width: this.picClose,
            height: this.picClose,
            opacity: 1

        },init['tmpl_animationTime'], function(){
            $(this).parent().parent().css('z-index','1');
            classTemplate.status = "closed";

        });
    }
    
    this.clearAnimations = function () {
        this.status = "cleared";
        
        this.container.stop(true,true);
        $('img', this.container).stop(true,true);
        $('div.tmpl_infos .tmpl_table_box',this.container).stop(true,true);
        $('div.tmpl_infos .tmpl_title',this.container).stop(true,true);
    }
}