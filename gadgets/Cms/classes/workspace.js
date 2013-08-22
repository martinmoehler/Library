Workspace = new Class();

Workspace.extend({
//--- Fields ---//
    workspace : null,
    startPoint : null,
    
//--- Getters and Setters ---//
    getWorkspace : function() {
        return this.workspace;
    },
    setWorkspace : function(_workspace) {
        this.workspace = _workspace;
    },
    getStartPoint : function() {
        return this.startPoint;
    },
    setStartPoint : function(_workspace) {
        this.startPoint = _startPoint;
    },   
        
//--- Methods ---//
    /**
     * @param {string|array|object} spaceholder Object which is used as Mask to create the Workspace
     * @param {string|object} parent Object to which the Workspace will be appended. 
     * @description Creates a div which uses the Position an Size of the spaceholder and is append to the parent object.
     */
    build : function(spaceholder, parent) {
        
        //All possible values which would represent a undefined state:
        notDefined = [undefined, null, '', 0];
        
        //$.inArray() would be the same as indexOf()
        if ( $.inArray(parent, notDefined) !== -1) {
            parent = $('body');
        } else {
            type = $.type(parent);
            switch(type) {
                case 'string':
                    var selector = parent;
                    
                    parent = $(selector);
                    
                    //If selector wasn't found. Try to find it as id or class
                    if (selector.indexOf('#') !== 0 && selector.indexOf('.') !== 0 ) {
                        if (!$.selectorFound(parent)) {
                            parent = $('#'+selector);
                            if (!$.selectorFound(parent)) {
                                parent = $('.'+selector);
                                if($.isArray(parent)) {
                                    parent = parent[0];
                                }
                                if(!$.selectorFound(parent)) {
                                    return false;
                                }
                            }
                        }
                    }
                    break;
                case 'object':
                    //Everything's fine?!
                    break;
                default :
                    return false;
            };
        };
        if ( $.inArray(spaceholder, notDefined) !== -1 ) {
            spaceholder = {
                'x' : 5,
                'y' : 5,
                'width' : parent.width() - 10,
                'height' : parent.height() - 10
            };
        };
        
        var helper = spaceholder;
        switch($.type(spaceholder))  {
            case 'array' :
                spaceholder = {
                    'x' : helper[0],
                    'y' : helper[1],
                    'width' : helper[2],
                    'height' : helper[3]
                }
                break;
            case 'object' :
                if($.inArray(helper.tagName, notDefined) == -1) {
                    //Object is a DOM Element
                    helper = $(spaceholder);
                }  
                if($.inArray(helper.context, notDefined) == -1) {
                    //Object is a Jquery Element
                    pos = helper.position();
                    spaceholder = {
                        'x' : pos.left,
                        'y' : pos.top,
                        'width' : helper.width(),
                        'height' : helper.height()
                    };
                    break;
                } 
            
                //Object is a non DOM Object
                if (spaceholder.x === undefined ||
                    spaceholder.y === undefined ||
                    spaceholder.width === undefined ||
                    spaceholder.height === undefined) return false;
                
                break;
            case 'string' :
                var selector = spaceholder;
                    
                helper = $(selector);

                //If selector wasn't found. Try to find it as id or class
                if (selector.indexOf('#') !== 0 && selector.indexOf('.') !== 0 ) {
                    if (!$.selectorFound(helper)) {
                        helper = $('#'+selector);
                        if (!$.selectorFound(helper)) {
                            helper = $('.'+selector);
                            if($.isArray(helper)) {
                                parent = parent[0];
                            }
                            if(!$.selectorFound(helper)) {
                                return false;
                            }
                        }
                    }
                }
                pos = helper.position();
                spaceholder = {
                    'x' : pos.left,
                    'y' : pos.top,
                    'width' : helper.width(),
                    'height' : helper.height()
                };
                break;
        }
    
        var div = $(document.createElement('div'));
        div.attr({
            id: 'workspace'
        });
        div.css({
            position: 'absolute',
            left: spaceholder.x,
            top: spaceholder.y,
            width: spaceholder.width,
            height: spaceholder.height,
            display: 'none'
        });
        
        //this.setWorkspace(div);
        parent.append(div);
        
        var model = Model.create();
        model.extend({
            left : spaceholder.x,
            top : spaceholder.y,
            width: spaceholder.width,
            height: spaceholder.height,
            state : closed
        });
        this.setWorkspace(model);
        
    },

    enlarge : function() {
        
    },
    fadeIn : function () {

    },
    loadContent : function( path ) {
    
    },
    /**
     * @param {object} config Object which contains all the config data
     */
    init : function (config) {
        if(!$.ObjEqualsObj(config, )) return false;
    }
});

var defaultConfig = Model.create();
defaultConfig.extend ({
    'workspaceBox':[100,50,$(window).width() - 100,$(window).height() - 100],
    'parent':'body', 
    'openEvent':'click',
    'openObject':
});