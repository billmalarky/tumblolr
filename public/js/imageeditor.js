;(function($, window, document, undefined) {
    
    'use strict';

    var Imageeditor = function(options){
        this.initialize.call(this, options);
        return this;
    }
    
    Imageeditor.prototype = {
        initialize: function(options){
            //singleton instance
            var instantiated;
            
            if (!instantiated) {
                
                var defaults = {
                    baseUrl: ''
                };
                
                this.imageeditorProperties = $.extend({}, defaults, options || {});
                
                Imageeditor.prototype.imageeditorProperties = this.imageeditorProperties;
                
                instantiated = this;
            }

            return instantiated;
        },
        loadPixlrEditor: function(iconUrl, imageUrl, title, target, exitUrl){
            
            var pixlrOptions = {
                Name: title,
                referrer: 'Tumblolr',
                icon: iconUrl,
                type: 'png',
                exit: exitUrl,
                image: imageUrl,
                title: title,
                method: 'GET',
                target: target,
                locktarget: 'true',
                locktitle: 'true',
                locktype: 'png'
            };
            
            window.pixlr.overlay.show(pixlrOptions);
            
        }
    };
    
    //Attach Imageeditor object constructor method to window scope
    window.tumblolr.Imageeditor = Imageeditor;

})(jQuery, this, this.document);