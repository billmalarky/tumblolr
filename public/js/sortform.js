;(function($, window, document, undefined) {
    
    'use strict';

    var Sortform = function(options){
        this.initialize.call(this, options);
        return this;
    }
    
    Sortform.prototype = {
        initialize: function(options){
            //singleton instance
            var instantiated;
            
            if (!instantiated) {
                
                var defaults = {
                    baseUrl: ''
                };
                
                this.sortformProperties = $.extend({}, defaults, options || {});
                
                Sortform.prototype.sortformProperties = this.sortformProperties;
                
                instantiated = this;
            }

            return instantiated;
        },
        submitSort: function($button, currentTag){
            var value = $button.attr('data-sort');
            window.location.href = window.tumblolr.CoreObj.coreProperties.baseUrl+'sorter/reorder/sort/'+value+'/tag/'+currentTag+'/';
        },
        submitOrder: function(currentTag){
            window.location.href = window.tumblolr.CoreObj.coreProperties.baseUrl+'sorter/reorder/order/toggle/tag/'+currentTag+'/';
        }
    };
    
    //Attach Sortform object constructor method to window scope
    window.tumblolr.Sortform = Sortform;

})(jQuery, this, this.document);