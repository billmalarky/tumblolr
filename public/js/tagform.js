;(function($, window, document, undefined) {
    
    'use strict';

    var Tagform = function(options){
        this.initialize.call(this, options);
        return this;
    }
    
    Tagform.prototype = {
        initialize: function(options){
            //singleton instance
            var instantiated;
            
            if (!instantiated) {
                
                var defaults = {
                    baseUrl: ''
                };
                
                this.tagformProperties = $.extend({}, defaults, options || {});
                
                Tagform.prototype.tagformProperties = this.tagformProperties;
                
                instantiated = this;
            }

            return instantiated;
        },
        submitTagForm: function($inputField){
            var value = $inputField.val();
            window.location.href = window.tumblolr.CoreObj.coreProperties.baseUrl+'index/index/tag/'+value+'/';
        }
    };
    
    //Attach Tagform object constructor method to window scope
    window.tumblolr.Tagform = Tagform;

})(jQuery, this, this.document);