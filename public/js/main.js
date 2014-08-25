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
        window.tumblolr.ImageeditorObj = new window.tumblolr.Imageeditor({
            "baseUrl": window.tumblolr.CoreObj.coreProperties.baseUrl
        });
        
        //Attach event bindings.
        
        //On tag form button click, 
        $body.on('click','#tagFormSubmitButton', function(e){
            e.preventDefault();
            window.tumblolr.TagformObj.submitTagForm.call(window.tumblolr.TagformObj, $('#postTagInput'));
        });
        
        //Sort Form Button clicks
        $body.on('click','#sortTypeButton', function(e){
            e.preventDefault();
            var currentTag = $('#currentTagValue').val();
            window.tumblolr.SortformObj.submitSort.call(window.tumblolr.SortformObj, $(this), currentTag);
        });
        
        $body.on('click','#orderToggleButton', function(e){
            e.preventDefault();
            var currentTag = $('#currentTagValue').val();
            window.tumblolr.SortformObj.submitOrder.call(window.tumblolr.SortformObj, currentTag);
        });
        
        //Image editor events
        $body.on('click','.tumblr-post-photo-image', function(e){
            e.preventDefault();
            
            var 
            iconUrl = window.location.hostname === 'tumblolr.local' ? 'http://i.imgur.com/Idn41J4.png' : window.tumblolr.CoreObj.coreProperties.baseUrl+'img/tumblolr-icon-small.png',
            imageUrl = window.location.hostname === 'tumblolr.local' ? 'http://i.imgur.com/7ojASuE.png' : $(this).attr('src'),
            title = $(this).parents('.post').find('.tumblr-post-blog-name').text(),
            target = window.tumblolr.CoreObj.coreProperties.baseUrl+'editor/success',
            exitUrl = window.tumblolr.CoreObj.coreProperties.baseUrl+'editor/quit';
            
            window.tumblolr.ImageeditorObj.loadPixlrEditor.call(window.tumblolr.ImageeditorObj, iconUrl, imageUrl, title, target, exitUrl);
            
        });
        
        $body.on('click','#imageEditorPostButton', function(e){
            e.preventDefault();
            
        });
        
    });

})(jQuery, this, this.document);