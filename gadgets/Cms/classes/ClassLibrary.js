

var Class = function(){
    var klass = function() {
        this.init.apply(this, arguments);
    };
    
    //Shortcuts
    klass.fn = klass.prototype;
    klass.fn.parent = klass;
    
    //Adding Class Properties
    klass.extend = function( obj ){
        var extended = obj.extended;
        for (var i in obj) {
            klass[i] = obj[i];
        }
        if(extended) extended(klass)
    };
    
    //Adding Instance Properties
    klass.include = function( obj ){
        var included = obj.included;
        for (var i in obj) {
            klass.fn[i] = obj[i];
        }
        if(included) included(klass)
    };
    
    //Adding a proxa function
    klass.proxy = function(func) {
        var self = this;
        return (function() {
            func.apply(self, arguments);
        });
    };
    
    return klass;
};
