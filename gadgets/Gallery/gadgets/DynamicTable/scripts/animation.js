    
    
    var id = "";
    var lastId = "";
    var lastObject = "";
    var dynamicTableTimeout = null;
    
    $(".tmpl_box").click(function(){
        if (init['tmpl_openEvent'] !== 'click') return;

        con = $(this);

        if (id) lastId = "tmpl_box-"+ id;

        id = con.attr('id').split("-")[1];

        if (lastId) lastObject = $("div.tmpl_title",'#'+lastId).html().replace(/ /g, "_"); 
        object = $("div.tmpl_title", con).html().replace(/ /g, "_");

        if(lastObject && init['tmpl_multiOpen'] === false && lastObject !== object) {

            table[lastObject].template.close();
        }
        table[object].template.status == "closed" ? table[object].template.open() : table[object].template.close();
    });

    $(".tmpl_box").mouseenter(function(){
        if (init['tmpl_openEvent'] !== 'mouseover') return;

        con = $(this);

        if (id) lastId = "tmpl_box-"+ id;
        id = con.attr('id').split("-")[1];

        if (lastId) lastObject = lastId.split("-")[1]; //$("div.tmpl_title",'#'+lastId).html().replace(/ /g, "_"); 
        //object = $("div.tmpl_title", con).html().replace(/ /g, "_");
        object = id;
        if(lastObject) {
            table[lastObject].template.clearAnimations();
        }
        if (table[object].template.status !== "opened") {
            dynamicTableTimeout = setTimeout(function() {
                table[object].template.open()
            }, init['tmpl_mouseOverTime'])
            
        }
            
        
    });

    $(".tmpl_box").mouseleave(function(){
        
        clearTimeout(dynamicTableTimeout);
        
        if (init['tmpl_openEvent'] !== 'mouseover') return;
        if (table[object].template.status !== "closed")
        con = $(this);

        if (id) lastId = "tmpl_box-"+ id;
        id = con.attr('id').split("-")[1];

        if (lastId) lastObject = lastId.split("-")[1]; //$("div.tmpl_title",'#'+lastId).html().replace(/ /g, "_");  
        //object = $("div.tmpl_title", con).html().replace(/ /g, "_");
        object = id;

        if(lastObject) {
            table[lastObject].template.clearAnimations();
        }
        if (table[object].template.status !== "closed") table[object].template.close();
    });