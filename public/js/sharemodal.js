/**
 * Share modal JS runs entirely separate from
 * the rest of the web app's JS structure as
 * it is run within an iframe.
 */
;(function($, window, document, undefined) {
    
    'use strict';
    
    $(document).ready(function(){
        
        //Generate PseudoGlobals
        var $body = $(document.body),
        $window = $(window);
        
        //Attach event bindings.
        
        //On share button click
        $body.on('click','#shareOnTumblrButton', function(e){
            e.preventDefault();
            
            var $this = $(this),
            url = $this.attr('data-url'),
            title = $this.attr('data-title') + ' post edited by me',
            clickthru = $this.attr('data-clickthru'),
            tumblrUrl = 'http://www.tumblr.com/share/photo?source='+encodeURIComponent(url)+'&caption='+encodeURIComponent(title)+'&clickthru='+encodeURIComponent(clickthru);
            
            //Open tumblr share interface in new tab.
            window.open(
                tumblrUrl,
                '_blank'
            );
            
            //Close modal
            window.parent.pixlr.overlay.hide();
            
        });
        
        //On cancel button click, 
        $body.on('click','#cancelShareOnTumblrButton', function(e){
            e.preventDefault();
            window.parent.pixlr.overlay.hide();
        });
        
    });

})(jQuery, this, this.document);