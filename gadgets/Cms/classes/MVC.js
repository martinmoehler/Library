

//This support for Object.create ist taken from Douglas Crockford's article on
//Prototypal Inheritance(http://javascript.crockford.com/protoypal.html)
if (typeof Object.create !== "function")
    Object.create = function(o) {
        function F() {}
        F.prototype = o;
        return new F();
    };


var Model = {
    inherited: function(){},
    created: function(){},
    
    prototype: {
        init: function(){}
    },
    
    create: function(){
        var object = Object.create(this);
        object.parent = this;
        object.prototype = object.fn = Object.create(this.prototype);
        
        object.created();
        this.inherited(object);
        return object;
    },
    
    init: function(){
        var instance = Object.create(this.prototype);
        instance.parent = this;
        instance.init.apply(instance, arguments);
        return instance;
    },
    
    extend: function( obj ){
        var extended = obj.extended;
        for (var i in obj) {
            this[i] = obj[i];
        }
        if(extended) extended(this)
    },
    
    include: function( obj ){
        var included = obj.included;
        for (var i in obj) {
            this.prototype[i] = obj[i];
        }
        if(included) included(this.prototype)
    }
};