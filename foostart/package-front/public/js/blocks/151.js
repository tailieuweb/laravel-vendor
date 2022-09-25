 $(document).ready(function () {     
    //Initiate equalize on load     
    equalize();  
    sizenews();
    });     
    //Equalize on resizing of window        
    $(window).resize(function () {      
        removeHeights();        
        equalize();     
    });     
    function equalize() {       
        $(".container .row").each(function () {      
            var heights = $(this).find(".img-height ").map(function () {        
                return $(this).height();        
            }).get(),       
            minHeight = Math.min.apply(null, heights);      
            $(this).find(".img-height").height(minHeight);     
        });     
    }       
    function removeHeights() {      
        $(".container .row").each(function () {      
            $(this).find(".img-height").height("auto");        
        });     
    } 
    
    function sizenews() {       
        $(".container .row").each(function () {      
            var heights = $(this).find(".block_news").map(function () {        
                return $(this).height();        
            }).get(),       
           maxHeight = Math.max.apply(null, heights);      
            $(this).find(".block_news").height(maxHeight);     
        });     
    } 
    
    
    