;(function($, window, document, undefined) {
    
    'use strict';

    var Core = function(options){
        this.initialize.call(this, options);
        return this;
    }
    
    Core.prototype = {
        initialize: function(options){
            //singleton instance
            var instantiated;
            
            if (!instantiated) {
                
                var defaults = {
                    baseUrl: '',
                    pdfImageEditor: 'paintweb'
                };
                
                this.coreProperties = $.extend({}, defaults, options || {});
                
                Core.prototype.coreProperties = this.coreProperties;
                
                instantiated = this;
            }

            return instantiated;
        }
    };
    
    //Attach Core object constructor method to window scope
    window.tumblolr.Core = Core;

})(jQuery, this, this.document);
