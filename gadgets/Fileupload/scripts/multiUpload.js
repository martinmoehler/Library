
var Upload = new multiUpload();


$('#dragContainer').click( function () {
    $('#fileInput').trigger('click');
});

$('#dragContainer').on('dragover', function( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.originalEvent.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    $(this).addClass('dragOver');
});

$('#dragContainer').on('dragenter', function ( evt ) {
    evt.preventDefault();
    $(this).addClass('dragOver');
});

$('#dragContainer').on('dragleave', function ( evt ) {
    $(this).removeClass('dragOver');
});

$('#dragContainer').on('drop', function( evt ) {
    evt.stopPropagation();
    evt.preventDefault();
    
    $(this).removeClass('dragOver');

    var files = evt.originalEvent.dataTransfer.files; // FileList object.
    
    var multiFiles = new Array();

    for ( var i = 0, file; file = files[i]; i++ ) {

        multiFiles[i] = {
            'name' : escape(file.name),
            'type' : file.type,
            'size' : file.size,
            'lastModified' : file.lastModifiedDate
        };
    };
    Upload.printFiles( files );
});

$('#fileInput').change( function( evt ) {

    var files = evt.target.files;   //FileList object

    var multiFiles = new Array();

    for ( var i = 0, file; file = files[i]; i++ ) {

        multiFiles[i] = {
            'name' : escape(file.name),
            'type' : file.type,
            'size' : file.size,
            'lastModified' : file.lastModifiedDate
        };
    };
    Upload.printFiles( files );
});

/**
 * 
 * @param {String} _type type of file
 * @returns {void}
 */
function multiUpload ( _type ) {
    
    var multiUpload = this;
    var type = null;

    var fileInProgress = null;
    var checkBoxClicked = null;
    var templates = Array();
    var files = Array();
    
    this.getFiles = function() {
        return files;
    };
    this.setFiles = function (_files) {
        files = _files;
    };
    this.pushFiles = function (_file) {
        files[files.length] = _file;
    };
    this.getTemplates = function() {
        return templates;
    };
    this.setTemplates = function (_templates) {
        templates = _templates;
    };
    this.pushTemplate = function (_template) {
        templates[templates.length] = _template;
    };
    this.getFileInProgress = function() {
        return fileInProgress;
    };
    this.setFileInProgress = function ( name ) {
        fileInProgress = name;
    };
    this.isCheckBoxClicked = function() {
        return checkBoxClicked;
    };
    this.setCheckBoxClicked = function ( bool ) {
        checkBoxClicked = bool;
    };
    
    this.printFiles = function( files ) {
        //var multiFiles = multiFiles || null; 
        if(!files) return false;
        var file;
        var names = Array();
        for ( var i = 0; file = files[i]; i++ ){
            //If files is not an image continue going through the Array
            if (!file['type'].match('image.*')) continue;  
            
            this.pushFiles(file);
            //Save filename in two different ways
            var fileName = escape(file.name.toString());
            var name = fileName.split(".")[0];
            
           
            this.includeTemplate(name, fileName);
            
            //Set the current file
            //this.setFileInProgress({'name' : name, 'fileName': fileName});
            
            //New FileReader
            this.readFile(file);
            
        };
    };

    this.readFile = function (file) {
        var fileName = escape(file.name.toString());
        var name = fileName.split(".")[0];
        
        var reader = new FileReader();
        var templates = this.getTemplates();
        var thmb = $('#'+templates[templates.length -1]['thmb']);
        
        reader.onload = function ( evt ) {


            instance = evt.target;

            var dataUri = instance.result;
            var img = new Image ();

            img.onload = function () {
                var format;
                this.width > this.height ? format = 'quer' : format = 'hoch';
                switch (format) {
                    case 'hoch' :
                        this.class = 'thmb';
                        this.width=50;
                        break;
                    case 'quer' :
                        this.class = 'thmb';
                        this.height = 50;
                        break;
                    default :
                        console.log("Thumbnailformat konnte nicht ermittelt werden!");
                        break;
                }
            };

            img.src = dataUri;
            img.title = fileName;
            img = $(img);
            
            img.css('display', 'none');
            thmb.append(img);
            img.fadeIn();

        };

        reader.readAsDataURL(file);
    };

    this.errorHandler = function (evt) {
        switch(evt.target.error.code) {
            case evt.target.error.NOT_FOUND_ERR:
                alert('File Not Found!');
                break;
            case evt.target.error.NOT_READABLE_ERR:
                alert('File is not readable');
                break;
            case evt.target.error.ABORT_ERR:
                break; // noop
            default:
                alert('An error occurred reading this file.');
        };
    };
    
    this.includeTemplate = function(currName, currFileName){
        
        $.ajax({
            async: false,
            url: 'templates/pictureUpload.tpl.html',
            success: function(data) {
                $('#fileContainer').append(data);

                //Read the objects from the Template
                thmb = $('#up_thmb');
                data = $('#up_data');
                row = $('#up_row');

                //Give unique id's
                thmb.attr('id', thmb.attr('id') +"_"+ currName);
                data.attr('id', data.attr('id') +"_"+ currName);
                row.attr('id', row.attr('id')+"_"+currName);

                row.attr('class', 'up_row');
                
                //Save id's
                multiUpload.pushTemplate({
                    'name' : currName,
                    'row' : row.attr('id'),
                    'thmb' : thmb.attr('id'),
                    'data' : data.attr('id')
                });

                

                table = $(document.createElement('table'));
                table.css({
                    border : '1px solid gray',
                    borderRadius : '3px',
                    padding : '4px'
                });

                for(var i = 0; i<fields.length; i++) {
                    if (fields[i] === "id") continue;
                    row = $(document.createElement('tr'));
                    row.attr('id', currName + "_" + fields[i]);
                    i%2 == 0 ? color = 'rgb(180,180,180)' : color = 'rgb(190,190,190)';

                    row.css({
                        backgroundColor : color
                    });
                    row.append("<td class='up_data_field'>"+fields[i]+"</td>");

                    fieldValue = ""+fields[i]+"";
                    if ( fields[i] in fieldValues) {
                        
                        //Replace placeholders with $fieldValues
                        if(fieldValues[fields[i]].match('fileName*')){
                            fieldValue = fieldValues[fields[i]].replace('fileName', currName);
                        }
                        if(fieldValues[fields[i]].match('fullFileName*')){
                            fieldValue = fieldValues[fields[i]].replace('fullFileName', currFileName);
                        }
                    }
                    row.append("<td class='up_data_data' style='width: 300px;'>"+fieldValue+"</td>");

                    row.children().css({
                        paddingLeft : '5px',
                        paddingRight : '5px',
                        color : 'white',
                        border : '1px solid gray',
                        borderRadius : '2px',
                        textShadow : '1px 1px 1px gray'
                    });
                    table.append(row);

                    row.on('click', function() {
                        td = $('.up_data_data', this);
                        html = td.html();
                        index = html.indexOf('<input');
                        if(index === -1) {
                            multiUpload.createTextBox( this );
                        };
                    });

                }
                data.append(table);
            }
        });
    };
    
    /**
     * 
     * @param {Object} obj Object in which the Textbox should be rendered into
     * @returns {void}
     */
    this.createTextBox = function ( obj ) {
        
        var td = $('.up_data_data' , obj);
        var value = td.html();
        var textBox = $(document.createElement('input'));
        var checkBox = $(document.createElement('input'));
        textBox.attr('type', 'text');
        textBox.attr('class', 'dataInput');
        textBox.css({
           position: 'relative',
           top: '0px',
           left: '0px',
           width : '81%',
           height : '100%',
           display : 'none',
           float : 'left',
           marginRight : '5px'
        });
        textBox.attr('value', value);
        
        checkBox.attr('type', 'checkbox');
        checkBox.attr('title', 'Sets this value to all other files.');
        checkBox.attr('class', 'up_checkBox');
        checkBox.css({
            position: 'relative',
            top: '0px',
            right: '5px',
            height : '100%'
        });
    
        td.empty();
        td.append(textBox);
        td.append('All: ');
        td.append(checkBox);
        textBox.fadeIn();
        
        checkBox.mousedown(function () {
            multiUpload.setCheckBoxClicked ( true );
        });
    
        checkBox.mouseup(function () {
            multiUpload.setCheckBoxClicked ( false );
            textBox.focus();
        });
        
        textBox.focus();
        textBox.focusout(function() {
            if ( !multiUpload.isCheckBoxClicked() ) {
                multiUpload.removeTextBox( this );
            }
        });
        
    };
    
    this.removeTextBox = function ( obj ) {
        value = $(obj).val();
        parent = $(obj).parent();
        check = parent.find(':checkbox');
        if (check.attr('checked')) {
            field = parent.parent().find('td.up_data_field').html();
            this.pushValueToAllFiles(value, field);
        }
        parent
            .empty()
            .append(value);
    };
    
    this.pushValueToAllFiles = function ( _value, _field) {
        templates = this.getTemplates();
        
        for(i=0, tmpl = ""; tmpl = templates[i]; i++) {
            dataRow = $('#' + tmpl['name'] + "_" + _field);
            tdDataData = dataRow.find('.up_data_data');
            tdDataData.html(_value);
        }
    };

    this.uploadFiles = function () {
        var files = this.getFiles();
        var formData = new FormData();
        var tableData = JSON.stringify(this.getTableData());
        //alert(typeof tableData);
        
        //Alle Files in das FormDataObject einfügen
        for (i = 0; i < files.length; i++) {
            formData.append('file_'+i,files[i]);
        }
        formData.append('tableData', tableData);
        $.ajax({
            url : 'scripts/upload.php',
            type : 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data : formData,
            success : function (data) {
                if (data != "") {
                    alert(data);
                } else {
                    alert ("Dateien erfolgreich hochgeladen!");
                    multiUpload.reload();
                }
            },
            error : function ( err ) {
                console.log(err);
                alert(err);
            }
        });
    
    };

    /**
     * @description Reads all Data from the Data tables an represents them in an Array.
     * @return {Array} Data for the Upload Table.
     */
    this.getTableData = function (){
        var rows = $('.up_row');
        var row = null;
        var tableData = new Array();
        
        for (var i=0, row; row = rows[i]; i++) {
            keys = $(row).find('.up_data_field');
            vals = $(row).find('.up_data_data');
            
            //Fehlerüberprüfung
            if (keys.length != vals.length) {
                console.log('Unerwarteter Fehler. Daten nicht komplett weitergeleitet.');
                continue;
            }           
            key = "";
            value ="";
            tableData[i] = new Object();
            for ( j=0, key, value; key=keys[j], value=vals[j]; j++) {
                key = $(key).html();
                value = $(value).html();
                tableData[i][key] = value;
            }
        }
    return tableData;
    };
    
    this.progressHandling = function (data) {
        
    };

    this.reload = function() {
        window.location.reload();
    };
}