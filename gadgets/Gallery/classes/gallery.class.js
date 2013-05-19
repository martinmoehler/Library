

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
    var galleryData = null;
    var galleryContainer = null;
    var dynamicTableInit = null;
    var dynamicTableTemplate = false;
    
    
//--- Getters and Settets ---//
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
            fail : function ( err ) {},
            success : function ( data ) {
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
        container.css('display', 'none');
        container.append(template);
        this.fillTemplate();
        container.fadeIn();
    };
    this.fillTemplate = function () {
        var data = this.getGalleryData();
        var init = this.getDynamicTableInit();
        //var tableTemplate = this.getDynamicTableTemplate();
        var pictureContainer = $(this.options.pictureContainer);
        var table = {};
        
        for ( gallery in data ) {
            var li = document.createElement('li');
            li.innerHTML = gallery;
            $(this.options.galleryChooser+" ul").append(li);
            
            
            for (i=0; i<data[gallery].length;i++) {
                //var table = <?php echo $table->printDataAsJSObject() ?>;
                var fileName = data[gallery][i].fullImg
                        .replace(/\\/g,'/')
                        .split('/');
                fileName = fileName[fileName.length -1].substr(0, fileName[fileName.length -1].indexOf("."));
                
                table[fileName] = data[gallery][i];
                pictureContainer.append(data[gallery][i]['templateHTML']);
                $('#tmpl_box-').attr('id', 'tmpl_box-'+i);
                table[fileName].template = new Template('tmpl_box-'+i, init);
            }
        }
        pictureContainer.append("<script src='gadgets/DynamicTable/scripts/animation.js' type='text/javascript'></script>");
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

//--- EventHandlers ---//
    this.templatesLoaded = function() {
        console.log('templateLoad');
        
        this.printGallery();
    };
    

//--- Constructor ---//
    this.construct = function () {
        this.setInstance();
        
        _galleryContainer !== null ? this.setGalleryContainer (_galleryContainer) : this.setGalleryContainer(this.createGalleryContainer());
        var mainContainer = $('#'+this.getGalleryContainer());
        
        mainContainer.on('onTemplateLoad', function() {Gallery.templatesLoaded();});
        mainContainer.on('onDynamicTableTemplatesLoad', function(){
            if (Gallery.areTemplatesLoaded()) mainContainer.trigger('onTemplateLoad');
        });
        mainContainer.on('onGalleryTemplateLoad', function(){
            if (Gallery.areTemplatesLoaded()) mainContainer.trigger('onTemplateLoad');
        });
        mainContainer.on('error', function (e) {console.log(e);});
        
        
        _options !== null ? this.options = _options : this.options = this.defaultOptions;
        _galleryData !== null ? this.setGalleryData(_galleryData) : this.setGalleryData(this.readFromHTMLStructure());
        _dynamicTableInit !== null ? this.setDynamicTableInit( _dynamicTableInit ) : mainContainer.trigger('error', {msg:'Configurationdata of the DynamicTable-gadget is missing!','advice':'Check the *.conf.php of the Dynamic Table for the existance of the Array and the right JSON-transmission in the index file!'});
        
        this.defaultOptions = null;
        this.readGalleryTemplate();
        this.getDynamicTableTemplates();
        
        
    };

    this.construct();



}