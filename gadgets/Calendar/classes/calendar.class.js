

/**
 * @author Martin Möhler
 * 
 * Object myCalendar Instance of Class classCalendar.  
 * 
 * The Name of the Variable in which the Instance is captured is important.
 * Chnaging it will lead to no complete functionality!
 */
var myCalendar = new classCalendar();
            
function classCalendar() {
    var calendar = this;
    
    /**
     * @type Array 
     * @description Contains Number of newDates, oldDates and allDates.
     */
    var countCpx;
    
    /**
     * @type int
     * @description Index of the first printed Date.
     */
    var firstShownDateIndexNew;
    
    /**
     * @type int
     * @description Index of the first printed Date.
     */
    var firstShownDateIndexOld;
    
    /**
     * @type int
     * @description Index of the first printed Date.
     */
    var firstShownDateIndexAll;
    
    /**
     * 
     * @type Number
     * @description Says how many dates shoud be printed at once.
     */
    var printLengthNew = 4;
    
    /**
     * 
     * @type Number
     * @description Says how many dates shoud be printed at once.
     */
    var printLengthOld = -1;
    
    /**
     * 
     * @type Number
     * @description Says how many dates shoud be printed at once.
     */
    var printLengthAll = -1;
    
    /**
     * 
     * @type String
     * @description Holds the id of the Container for new Dates.
     */
    var newDatesContainer;
    
    /**
     * 
     * @type String
     * @description Holds the id of the Container for old Dates.
     */
    var oldDatesContainer;
    
    /**
     * 
     * @type String
     * @description Holds the id of the Container for all Dates.
     */
    var allDatesContainer;
    
   /**
    * 
    * @type Boolean Says whether the Object is in process or not.
    */
    var inAction = false;
    
    /**
     * 
     * @type Array 
     * @description Holds the correct request-strings for the _request.php file.
     */
    this.requestQuerys = {
        'printCtr' : 'PCC',
        'printNew' : 'PND',
        'printOld' : 'POD',
        'printAll' : 'PAD',
        'countNew' : 'CND',
        'countOld' : 'COD',
        'countAll' : 'CAD',
        'countCpx' : 'CPX',     //Complex counting returns Array combinig CND, COD and CAD.
        'from' : '-FRM',    
        'to' : '-TO*',
        'color' : '-CLR',       //Used for printControles. Defines whether the black or the white pictures should be used
        'type' : '-TYP',        //Used for printContrtoles to give a callback-type for the template Controle buttons.
        'instance' : '-INS'     //Pattern for a String with the name of the var which holds the actual instance of this class
    };
    
    /**
     * 
     * @type String Path to the _request.php file. 
     */
    this.fileToRequestPhp = "scripts/calendar_request.php";
    
    /**
     * Do the Ajax Setup.
     */
    $.ajaxSetup({
        url : this.fileToRequestPhp,
        type : "POST"
    });

    
    
    // Getters and Setters
    this.getCountCpx = function() {
        return countCpx;
    };
    this.setCountCpx = function(_countCpx) {
        countCpx = _countCpx;
    };
    this.getFirstShownDateIndexNew = function () {
        return firstShownDateIndexNew;
    };
    this.setFirstShownDateIndexNew = function (_index) {
        firstShownDateIndexNew = _index;
    };
    this.getFirstShownDateIndexOld = function () {
        return firstShownDateIndexOld;
    };
    this.setFirstShownDateIndexOld = function (_index) {
        firstShownDateIndexOld = _index;
    };
    this.getFirstShownDateIndexAll = function () {
        return firstShownDateIndexAll;
    };
    this.setFirstShownDateIndexAll = function (_index) {
        firstShownDateIndexAll = _index;
    };
    this.getPrintLengthNew = function() {
        return printLengthNew;
    };
    this.setPrintLengthNew = function(_length) {
        printLengthNew = _length;
    };
    this.getPrintLengthOld = function() {
        return printLengthOld;
    };
    this.setPrintLengthOld = function(_length) {
        printLengthOld = _length;
    };
    this.getPrintLengthAll = function() {
        return printLengthAll;
    };
    this.setPrintLengthAll = function(_length) {
        printLengthAll = _length;
    };
    this.getNewDatesContainer = function () {
        return newDatesContainer;
    };
    this.setNewDatesContainer = function ( _id ) {
        newDatesContainer = _id;
    };
    this.getOldDatesContainer = function () {
        return oldDatesContainer;
    };
    this.setOldDatesContainer = function ( _id ) {
        oldDatesContainer = _id;
    };
    this.getAllDatesContainer = function () {
        return allDatesContainer;
    };
    this.setAllDatesContainer = function ( _id ) {
        allDatesContainer = _id;
    };
    this.isInAction = function () {
        return inAction;
    };
    this.setInAction = function ( _bool ) {
        inAction = new Boolean( _bool);
    };

    /**
     * 
     * @param {String} type Values: 'NEW', 'OLD' or 'ALL'. Default. 'ALL'.
     * @description Is doing a ! synchron ! Ajax request. Giving back the Number of entrys in the database.
     * @returns {int} Number of entrys in the Database
     */
    this.countDates = function ( type ) {
        // Set 'type' to Default value
        if (!type) type = "ALL";
        
        //Fill 'data' with the correct request-string.
        switch (type) {
            case "new" || "New" || "NEW" :
                data = this.requestQuerys['countNew'];
                break;
            case "old" || "Old" || "OLD" :
                data = this.requestQuerys['countOld'];
                break;
            case "all" || "All" || "ALL" :
                data = this.requestQuerys['countAll'];
                break;
            case "complex" || "Complex" || "COMPLEX" :
                data = this.requestQuerys['countCpx'];
                $.ajax({
                    dataType : 'json',
                    data : {'query' : data},
                    async : false
                }).done(function( responseText ) {
                     calendar.setCountCpx( responseText );
                });
                return;
            default :
                return false;
        };    
        
        //Do Ajax-Request with JQuery Ajax
        $.ajax({ 
            data : {'query' : data},
            
            /**
             * ACHTUNG : Dieser Ajax-Request läuft synchron. Das kann Ursache 
             * für Geschwidigkeitsverluste sein oder den Browser fest fahren.
             */ 
            async : false
        })
        .done(function ( responseText ) {
            response = responseText;
        });

        return response;
    };
        
    this.countDates("complex");
    
    /**
     * 
     * @param {String} containerId Id of container to which the response is appended.
     * @param {String} type Values: 'NEW', 'OLD' or 'ALL'. Default. 'ALL'.
     * @param {int} from From which Index of Dates-Array start printing. Default min-Index.
     * @description Is doing a ! synchron ! Ajax request. Giving back the HTML of loaded Templates.
     * @returns {HTML} 
     */
    this.printDates = function ( containerId, type , from ) {
        var container = $('#'+containerId);
        if (!container) return false;
        this.disableContainer(container);
        
        if (!type) type = "ALL";
        cnt = this.getCountCpx();
        if (!from) from = 0;
        
        switch (type) {
            case "new" || "New" || "NEW" :
                this.setFirstShownDateIndexNew( from );
                this.setNewDatesContainer( containerId );
                to = from + this.getPrintLengthNew();
                if (to === -1 ){
                    var arr = this.getCountCpx();
                    to = arr['all'];
                };
                data = this.requestQuerys['printNew'] + this.requestQuerys['from'] + from  + this.requestQuerys['to'] + to;
                break;
            case "old" || "Old" || "OLD" :
                this.setFirstShownDateIndexOld( from );
                this.setOldDatesContainer( containerId );
                to = from + this.getPrintLengthOld();
                if (to === -1 ){
                    var arr = this.getCountCpx();
                    to = arr['all'];
                };
                data = this.requestQuerys['printOld'] + this.requestQuerys['from'] + from  + this.requestQuerys['to'] + to;
                break;
            case "all" || "All" | "ALL" :
                this.setFirstShownDateIndexAll( from );
                this.setAllDatesContainer( containerId );
                to = from + this.getPrintLengthAll();
                if (to === -1 ){
                    var arr = this.getCountCpx();
                    to = arr['all'];
                };
                data = this.requestQuerys['printAll'] + this.requestQuerys['from'] + from  + this.requestQuerys['to'] + to;
                break;
            default :
                return false;
        };    
    
        //Do Ajax-Request with JQuery Ajax
        $.ajax({ 
            data : {'query' : data},
            
            /**
             * ACHTUNG : Dieser Ajax-Request läuft synchron. Das kann Ursache 
             * für Geschwidigkeitsverluste sein oder den Browser fest fahren.
             */ 
            async : true,
            success : function ( responseText ) {
                //$('#clndr_load_div').fadeOut('fast');
                container
                    .empty()
                    .append(responseText)
                    .attr('disabled', false);
                
            }
        });
    };
    
    /**
     * 
     * @param {String} _containerId Id of container to which the controles are appended.
     * @param {String} _color "black" | "white". Default: "black".
     * @param {String} _type "new" | "old" | "all".
     * @returns void
     */
    this.printControles = function ( _containerId, _color, _type ) {
        this.setInAction(true);
        switch (_color) {
            case "black" || "Black" || "BLACK" :
                color = "black";
                break;
            case "white" || "White" || "WHITE" :
                color = "white";
                break;
            default :
                color = "black";
                break;
        }
        switch (_type) {
            case "new" || "New" || "NEW" :
                type = "new";
                break;
            case "old" || "Old" || "OLD" :
                type = "old";
                break;
            case "all" || "All" || "ALL" :
                type = "all";
                break;
        }
        var containerId = _containerId;
        $.ajax({
            data : {'query' : 
                        this.requestQuerys['printCtr'] + 
                        this.requestQuerys['type'] + type +
                        this.requestQuerys['color'] + color +
                        this.requestQuerys['instance'] + 'myCalendar'
                    },
            success : function ( response ) {
                $('#'+containerId).append(response);
            }
        }).done(function(){ calendar.setInAction(false);});
        
    };
    
    /**
     * 
     * @returns {boolean}
     * @param {Sting} _type Says which dates should be processed.
     * @description Prints the previous 'printLength' dates overwriting the existing.
     */
    this.previousDates = function( _type ) {
        var container = "";
        var length = 0;
        var firstIndex = 0;
        var print = false;
        var cnt = this.getCountCpx();
        
        switch(_type) {
            case "new" :
                container = this.getNewDatesContainer();
                firstIndex =  this.getFirstShownDateIndexNew();
                length = this.getPrintLengthNew();
                if ( firstIndex - length >= 0) print = true;
                break;
            case "old" :
                container = this.getOldDatesContainer();
                firstIndex =  this.getFirstShownDateIndexOld();
                length = this.getPrintLengthOld();
                if ( firstIndex - length >= 0) print = true;
                break;
            case "all" :
                container = this.getAllDatesContainer();
                firstIndex =  this.getFirstShownDateIndexAll();
                length = this.getPrintLengthAll();
                if ( firstIndex - length >= 0) print = true;
                break;
        };
        if (print) {
            this.printDates(container, _type, firstIndex - length);
        } else {
            this.disableContainer( $('#' +container) );
            $('#clndr_load_message')
                .empty()
                .append('<p>Keine früheren Termine</p>');
                
            calendar.enableContainer( $('#' +container) , 1000 );
        };
    };

    /**
     * 
     * @returns {boolean}
     * @param {Sting} _type Says which dates should be processed.
     * @description Prints the next 'printLength' dates overwriting the existing.
     */
    this.nextDates = function ( _type) {
        var container = "";
        var length = 0;
        var firstIndex = 0;
        var print = false;
        var cnt = this.getCountCpx();
        
        switch(_type) {
            case "new" :
                container = this.getNewDatesContainer();
                firstIndex =  this.getFirstShownDateIndexNew();
                length = this.getPrintLengthNew();
                if ( firstIndex + length < cnt['new']) print = true;
                break;
            case "old" :
                container = this.getOldDatesContainer();
                firstIndex =  this.getFirstShownDateIndexOld();
                length = this.getPrintLengthOld();
                if ( firstIndex + length < cnt['old']) print = true;
                break;
            case "all" :
                container = this.getAllDatesContainer();
                firstIndex =  this.getFirstShownDateIndexAll();
                length = this.getPrintLengthAll();
                if ( firstIndex + length < cnt['all']) print = true;
                break;
        };
        if (print) {
            this.printDates(container, _type, firstIndex + length);
        } else {
            this.disableContainer( $('#' +container) );
            $('#clndr_load_message')
                .empty()
                .append('<p>Keine weiteren Termine</p>');
                
            calendar.enableContainer( $('#' +container) , 1000 );
        };
    };
    
    /**
     * 
     * @param {Object} container 
     * @returns {void}
     */
    this.disableContainer = function (container) {
        container.attr('disabled', true);
        var off = container.offset();
        
        container.append("<div id='clndr_load_div' style='position:absolute; left: "+off.left+"px; top: "+off.top+"px; width: "+container.outerWidth()+"px; height: "+container.outerHeight()+"px; background-color: black; opacity: .7; z-index: 99; display: none; '><div id='clndr_load_message' style='position: relative; color: white; top: 10%; left: 5%'; font-weight: bold;>Laden...</div></div>");
        $('#clndr_load_div').fadeIn('fast');
    }; 
    /**
     * 
     * @param {Object} container 
     * @param {Number} wait Time to wait befor execution
     * @returns {void}
     */
    this.enableContainer = function (container, wait) {
        wait = wait || 0;
        container.attr('disabled', false);
        $('#clndr_load_div')
                .wait(wait)
                .fadeOut('fast', function() {
            $('#clndr_load_div').remove();
        });
    }; 
    
};
