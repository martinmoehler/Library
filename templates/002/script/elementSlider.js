/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function ElementSlider() {
    this.elements = Array ();
    
    this.newElement = function(slideInfo) {
        element = slideInfo['element'];
        position = element.position();
        
        
        slideInfo['left'] = position.left;
        slideInfo['top'] = position.top;
        
        
        element.css('top', slideInfo['top']);
        element.css('position','absolute');
        element.css('display','block');
        
        width = element.innerWidth();
        
        if(slideInfo['start'] === "left") {
            element.css('left', 0-width);
        }
        if(slideInfo['start'] === "right") {
            element.css('left', '100%');
        }
        this.elements[this.elements.length] = slideInfo;
    };
    
    this.slideIn = function () {
        /*if(index !== "undefined") { 
          *  
           * return;
        };*/
        for(i=0; i<this.elements.length; i++) {
            this.elements[i]['element'].animate({
                left: this.elements[i]['left'],
                top: this.elements[i]['top']
            }, function(){
                $('#title').fadeIn('slow');
            });
        }
    };
    
    this.animate = function () {
        
    };
}