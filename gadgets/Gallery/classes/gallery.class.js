

function classGallery ( _options, _galleryData, _galleryContainer, _dynamicTableInit ) {
    
//--- Fields ---/    
    this.defaultOptions = {
        'gallerySelector':'div.galleryContainer',
        'pictureSelector':'div.pictureContainer',
        'fullImageSelector':'img.fullImage',
        'thmbImageSelector':'img.thmbImage',
        'titleSelector':'h3.title',
        'descriptionSelector':'h4.description',
        'photographerSelector':'p.photographer',
        'copyrightSelector':'p.copyright',
        'personsSelector':'p.persons',
        'galleryChooser' : 'galleryChooserContainer',
        'pictureBox' : 'pictureBox',
        'previousBox' : 'previous',
        'nextBox' : 'next',
        'pictureContainer' : 'pictureContainer'
    };
    
    var Gallery = null;
    var tmplHTML = null;
    var galleryData = new Array();
    var tableData = {};
    var galleryContainer = null;
    var gallerySize = null;
    var selectedGallery = null;
    var galleryTable = null;
    var dynamicTableInit = null;
    var dynamicTableTemplate = false;
    var galleryChooserFilled = false;
    var firstPictureIndex = null;
    
//--- Getters and Settets ---//
    this.getTable = function () {
        return galleryTable;
    };
    this.setTable = function ( _table ) {
        galleryTable = _table;
        table = _table;
    };
    this.setInstance = function () {
        Gallery = this;
    };
    this.getTmplHTML = function() {
        return tmplHTML;
    };
    this.setTmplHTML = function ( _html ) {
        tmplHTML = _html;
    };
    this.isDynamicTableTemplates = function() {
        return dynamicTableTemplate;
    };
    this.setDynamicTableTemplate = function ( _bool ) {
        dynamicTableTemplate = _bool;
    };
    this.getGalleryData = function() {
        return galleryData;
    };
    this.setGalleryData = function ( _galleryData ) {
        galleryData = _galleryData;
        
    };
    this.getTableData = function( _gallery ) {
        if (_gallery !== undefined) {
            return tableData[_gallery];
        }
        return tableData;
    };
    this.setTableData = function ( _tableData ) {
        tableData[_tableData.gallery] = _tableData.data;
        console.log(tableData['log']);
    };
    this.getGalleryContainer = function () {
        return galleryContainer;
    };
    this.setGalleryContainer = function ( _galleryContainer ) {
        galleryContainer = _galleryContainer;
    };
    this.getDynamicTableInit = function () {
        return dynamicTableInit;
    };
    this.setDynamicTableInit = function ( _dynamicTableInit ) {
        dynamicTableInit = _dynamicTableInit;
    };
    this.isGalleryChooserFilled = function () {
        return galleryChooserFilled;
    };
    this.setGalleryChooserFilled = function ( _bool ) {
        galleryChooserFilled = _bool;
    }
    this.getSelectedGallery = function () {
        return selectedGallery;
    };
    this.setSelectedGallery = function ( _gallery ) {
        selectedGallery = _gallery;
    };
    this.getFirstPictureIndex = function () {
        return firstPictureIndex || 0;
    };
    this.setFirstPictureIndex = function ( _index ) {
        firstPictureIndex = _index;
    };
    this.getGallerySize = function () {
        return gallerySize;
    };
    this.setGallerySize = function ( _size ) {
        gallerySize = _size;
    };

//--- Methods ---//
    this.destroyHTMLStructure = function () {
        $(this.options.gallerySelector).remove();
    };
    this.readFromHTMLStructure = function () {
        var galleries = $(this.options.gallerySelector);
        var gallery = null;
        var galleryData = {};
        
        for (i=0;i<galleries.length;i++) {
            var gallery = $(galleries[i]).attr('title');
            var galleryId = $(galleries[i]).attr('id');
            var pictures = $(this.options.pictureSelector, '#'+ galleryId);
            
            galleryData[gallery] = {};
            
            for (p=0; p<pictures.length; p++) {
                pictureId = $(pictures[p]).attr('id');
                title = $('#'+pictureId).find(this.options.titleSelector);//.html();
                galleryData[gallery][p] = {
                    title : $(this.options.titleSelector, '#'+pictureId).html(),
                    description : $(this.options.descriptionSelector, '#'+pictureId).html(),
                    fullImg : $(this.options.fullImageSelector, '#'+pictureId).attr('src'),
                    thmbImg : $(this.options.thmbImageSelector, '#'+pictureId).attr('src'),
                    photographer : $(this.options.photographerSelector, '#'+pictureId).html(),
                    copyright : $(this.options.copyrightSelector, '#'+pictureId).html(),
                    persons : $(this.options.personsSelector, '#'+pictureId).html()
                };
            }
        };
        this.destroyHTMLStructure();
        return galleryData;
    };
    this.getDynamicTableTemplates = function ( _request ) {
        var request = null;
        
        var galleryData = JSON.stringify(this.getGalleryData());
        _request !== undefined ? request = _request : request = 'gadgets/DynamicTable/scripts/pushTemplatesToArray.php';
        
        $.ajax({
            url : request,
            type : 'POST',
            data : {'templatesData' : galleryData},
            dataType : 'json',
            fail : function ( err ) {
                $(Gallery.getGalleryContainer()).trigger('error', err);
            },
            success : function ( data ) {
                for(gallery in data) {
                    Gallery.setTableData({gallery : gallery, data : data[gallery]['tableData']});
                    delete(data[gallery]['tableData']);
                }
                Gallery.setGalleryData( data );
                
                Gallery.setDynamicTableTemplate(true);
                container.trigger ('onDynamicTableTemplatesLoad');
            }
        });
    };
    this.readGalleryTemplate = function ( _template ) {
        var template = null;
        
        _template !== undefined ? template = _template : template = 'templates/gallery.tpl.php';
        
        $.ajax({
            url : template,
            fail : function ( err ) {},
            success : function ( data ) {
                Gallery.setTmplHTML( data );
                container = $('#'+Gallery.getGalleryContainer());
                container.trigger ('onGalleryTemplateLoad');
            }
        });
        
    };
    this.printGallery = function () {
        var template = this.getTmplHTML();
        var container = $('#'+this.getGalleryContainer());
        container.css('opacity', '0');
        container.append(template);
        this.fillTemplate();

        container.css({
            display : 'none',
            opacity : 1
        });
        container.fadeIn();
        container.trigger('galleryprinted');
    };
    this.fillTemplate = function ( _gallery ) {
        
        if (_gallery == undefined) {
            for ( var gallery in this.getGalleryData()) {
                break;
            }
        } else {
            gallery = _gallery;
        };
        
        
        var data = this.getGalleryData();
        var init = this.getDynamicTableInit();
        var pictureContainer = $(this.options.pictureContainer);
        var table = {};
        var firstIndex = this.getFirstPictureIndex();
        
        pictureContainer.empty();
        if (!this.isGalleryChooserFilled()) this.fillGalleryChooser();
        

        for (i in data[gallery]) {
            if (parseInt(i) >= firstIndex && parseInt(i) < firstIndex + this.options.maxPicturesPerScreen) {
                var fileName = data[gallery][i].fullImg
                        .replace(/\\/g,'/')
                        .split('/');
                fileName = fileName[fileName.length -1].substr(0, fileName[fileName.length -1].indexOf("."));

                table[fileName] = data[gallery][i];
                pictureContainer.append(data[gallery][i]['templateHTML']);
                var box = $('#tmpl_box-'+fileName);
                
                var index = (parseInt(i) - firstIndex);
                var row = Math.floor(index / init['tmpl_columns']);
                var number = index % init['tmpl_columns'];
                
                box.css({
                    top: row * init['tmpl_rowHeight'],
                    left: number * init['tmpl_columnWidth']
                });
                table[fileName].template = new Template('tmpl_box-'+fileName, init);
            }
        }
        
        if (this.options.dynamicallyChangeGallerySize) {
            this.changePictureContainerSize(gallery);
        } else {
            padding = 2*$('.tmpl_box').first().css('paddingLeft').slice(0,-2);
            $(this.options.pictureContainer).css({
                width: init['tmpl_columns'] * init['tmpl_columnWidth'] - (init['tmpl_columnWidth'] - init['tmpl_width']) - padding,
                height: (Gallery.options.maxPicturesPerScreen / init['tmpl_columns']) * init['tmpl_rowHeight'] - (init['tmpl_rowHeight'] - init['tmpl_height'])
            });
        }
    
        this.setFirstPictureIndex ( firstIndex );
        this.setSelectedGallery(gallery);
        this.setTable(table);
        this.setGallerySize($.assocArraySize(data[gallery]));
        $('#'+Gallery.getGalleryContainer()).trigger('tableloaded');
        
    };
    this.fillGalleryChooser = function () {
        var data = this.getGalleryData();
        for ( gallery in data ) {
            var li = document.createElement('li');
            li.innerHTML = gallery;
            li.title = gallery;
            li.className = "galleryChooserElement";
            $(li).on('click', function () {
                $('.galleryChooserElement').css({fontWeight : 'normal'});
                
                $(this).css({fontWeight : 'bold'});
                gallery = this.innerHTML;
                $('#'+Gallery.getGalleryContainer()).trigger('gallerychange', gallery);
            });
            $(this.options.galleryChooser+" ul").append(li);
        };
        this.setGalleryChooserFilled(true);
    };
    this.changePictureContainerSize = function ( _gallery ) {
        if (_gallery == undefined) {
            for ( var gallery in this.getGalleryData()) {
                break;
            }
        } else {
            var gallery = _gallery;
        };
        var data = Gallery.getTableData(gallery);
        $(this.options.pictureContainer).css({
            width : data.width,
            height : data.height
        });
    };
    this.createGalleryContainer = function() {
        container = $(document.createElement('div'));
        container.attr('id', 'galleryMainContainer');
        container.attr('class', 'mainContainer');
        $('body').append(container);
        return 'galleryMainContainer';
    };
    this.areTemplatesLoaded = function () {
        if(this.isDynamicTableTemplates() && this.getTmplHTML()) {
            return true;
        }
        return false;
    };
    this.showNextPictures = function () {
        var picturesPerScreen = this.options.maxPicturesPerScreen;
        var firstIndex = this.getFirstPictureIndex();
        var data = this.getGalleryData();
        var gallery = this.getSelectedGallery();
        var gallerySize = this.getGallerySize();
        
        if (gallerySize > firstIndex + picturesPerScreen) {
            this.setFirstPictureIndex(firstIndex + picturesPerScreen);
            this.fillTemplate(gallery);
        }
    };
    this.showPreviousPictures = function () {
        var picturesPerScreen = this.options.maxPicturesPerScreen;
        var firstIndex = this.getFirstPictureIndex();
        var data = this.getGalleryData();
        var gallery = this.getSelectedGallery();
        
        if ((firstIndex - picturesPerScreen) >= 0) {
            this.setFirstPictureIndex(firstIndex - picturesPerScreen);
            this.fillTemplate(gallery);
        }
    };


//--- EventHandlers ---//
    this.templatesLoaded = function() {
        console.log('templateLoad');
        
        this.printGallery();
    };
    this.galleryPrinted = function () {
        //Reset some css.
        var tD = this.getTableData();
        $(this.options.pictureContainer).css({
            width : tD['width'],
            height : tD['height']
        });
    };
    this.changeGallery = function ( _gallery ) {
        if ( _gallery === this.getSelectedGallery()) {
            return;
        }
        this.fillTemplate(_gallery);
    };
    this.firstPicturePage = function () {
        
    };
    this.lastPicturePage = function () {
        
    };

//--- Constructor ---//
    this.construct = function () {
        this.setInstance();
        
        _galleryContainer !== null ? this.setGalleryContainer (_galleryContainer) : this.setGalleryContainer(this.createGalleryContainer());
        var mainContainer = $('#'+this.getGalleryContainer());
        
        //--- EvenetListeners ---//
        mainContainer.on('onTemplateLoad', function() {Gallery.templatesLoaded();});
        mainContainer.on('onDynamicTableTemplatesLoad', function(){
            if (Gallery.areTemplatesLoaded()) mainContainer.trigger('onTemplateLoad');
        });
        mainContainer.on('onGalleryTemplateLoad', function(){
            if (Gallery.areTemplatesLoaded()) mainContainer.trigger('onTemplateLoad');
        });
        mainContainer.on('error', function (e) {console.log(e);});
        mainContainer.on('tableloaded', function() {
            pictureContainer = $(Gallery.options.pictureContainer);
            pictureContainer.append("<script src='gadgets/DynamicTable/scripts/animation.js' type='text/javascript'></script>");        
        });
        mainContainer.on('galleryprinted', function () {
            Gallery.galleryPrinted();
        });
        mainContainer.on('gallerychange', function (event, gallery) {
            $('')
            Gallery.changeGallery(gallery);
        });
        mainContainer.on('firstPicturePage', function() {
            Gallery.firstPicturePage();
        });
        mainContainer.on('lastPicturePage', function () {
            Gallery.lastPicturePage();
        });
    
        //--- DefaultOptions ---//
        _options !== null ? this.options = _options : this.options = this.defaultOptions;
        _galleryData !== null ? this.setGalleryData(_galleryData) : this.setGalleryData(this.readFromHTMLStructure());
        _dynamicTableInit !== null ? this.setDynamicTableInit( _dynamicTableInit ) : mainContainer.trigger('error', {msg:'Configurationdata of the DynamicTable-gadget is missing!','advice':'Check the *.conf.php of the Dynamic Table for the existance of the Array and the right JSON-transmission in the index file!'});
        
        this.defaultOptions = null;
        this.readGalleryTemplate();
        
        for (var firstGallery in this.getGalleryData()) {
            break;
        }
        this.getDynamicTableTemplates();
        
        
    };

    this.construct();



}