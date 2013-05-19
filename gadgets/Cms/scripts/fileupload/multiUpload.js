function multiUpload () {
    
    var multiUpload = this;
    

    $('#fileUpload').change( function( evt ) {

        var files = evt.target.files;   //FileList object

        var multiFiles = new Array();

        for ( var i = 0, file; file = files[i]; i++ ) {

            multiFiles[i] = {
                'name' : escape(file.name),
                'type' : file.type,
                'size' : file.size,
                'lastModified' : file.lastModifiedDate
            }
        }
        multiUpload.printFiles( multiFiles );
    });


    
    this.printFiles = function( multiFiles ) {
        //var multiFiles = multiFiles || null; 
        if(!multiFiles) return false;
        
        for ( i in multiFiles ){
            //If files is not an image continue going through the Array
            if (!multiFiles[i]['type'].match('image.*')) continue;  
            
            var reader = new FileReader();
            reader.onload = function (file) {
                span = document.createElement('span');
                span.innerHTML = "<img class='gallery_setup_preview'>";
            }
            $('#fileContainer').append("<li>"+multiFiles[i]+"</li>")
        }
    };
}