/**
* Main executable JS
* 
* Contains shared JS executions and event binding.
*/
;(function($, window, document, undefined) {
    
    'use strict';
    
    $(document).ready(function(){
        
        //Generate PseudoGlobals
        var $body = $(document.body),
        $window = $(window);
        
        //Instantiate Objects
        window.tumblolr.TagformObj = new window.tumblolr.Tagform({
            "baseUrl": window.tumblolr.CoreObj.coreProperties.baseUrl
        });
        window.tumblolr.SortformObj = new window.tumblolr.Sortform({
            "baseUrl": window.tumblolr.CoreObj.coreProperties.baseUrl
        });
        
        //Attach event bindings.
        
        //On tag form button click, 
        $body.on('click','#tagFormSubmitButton', function(e){
            e.preventDefault();
            window.tumblolr.TagformObj.submitTagForm.call($('#tagForm'), $('#postTagInput'));
        });
        
        //Sort Form Button clicks
        $body.on('click','#sortTypeButton', function(e){
            e.preventDefault();
            window.tumblolr.SortformObj.submitSort.call(this);
        });
        
        $body.on('click','#orderToggleButton', function(e){
            e.preventDefault();
            window.tumblolr.SortformObj.submitOrder.call($('#orderToggleButton'));
        });
        
    });

})(jQuery, this, this.document);