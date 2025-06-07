(function ($) {
   "use strict";

   var GaviasElementsEditor = {
      init: function(){     
         elementor.settings.page.addChangeCallback( 'gowilds_post_preview', GaviasElementsEditor.handlePostPreview);
         elementor.settings.page.addChangeCallback( 'header_background_black', GaviasElementsEditor.handlePostPreview);
         
      },
      handlePostPreview: function(doc_preview_post_id){
         elementor.saver.saveEditor({
            status: elementor.settings.page.model.get('post_status'),
            onSuccess: function onSuccess() {

               elementor.once('preview:loaded', function(){
                     if(typeof elementor.panel === 'undefined') {
                     return false;
                  }
                  elementor.getPanelView().setPage('page_settings');
                  return true;
               });
               //window.location.reload();
               elementor.reloadPreview();
            }
         });
      },
   };
  
   $(document).ready(function(){
      GaviasElementsEditor.init();
   })

}(jQuery));
