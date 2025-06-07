
(function($) {
   "use strict";
   var templateLayoutManager = {
      init: function(){
         this.addTemplateLayout();
         this.duplicateTemplateLayout();
         this.setHeaderFooterLayout();
         this.setConfigState();
         this.deleteTemplateLayout();
      },

      addTemplateLayout: function(){
         $('.template-layout-add-new').on('click', function(e){
            var button = $(this);
            var type = $(this).attr('data-type');
            var title = $(this).attr('data-title');
            $('#gva-ajax-success h2').html(''); 
            $('#gva-ajax-loadding').addClass('active');
            $('.gva-ajax-overlay').addClass('active'); 
            $.ajax({
               type: 'POST',
               dataType: 'json',
               url: form_ajax_object.ajaxurl,
               data: {
                  'action'    : "gowilds_add_template_layout",
                  'type'      : type,
                  'title'     : title,
                  'security'  : form_ajax_object.security_nonce
               },
               success: function(data){
                if(data.message){
                  $('#gva-ajax-success h2').html(data.message); 
                }
                  $('#gva-ajax-loadding').removeClass('active'); 
                  $('#gva-ajax-success').addClass('active'); 
                  setTimeout( function(){
                     $('#gva-ajax-success').removeClass('active'); 
                     $('.gva-ajax-overlay').removeClass('active'); 
                  }, 2500);
                  location.reload();
               },
               error: function(data) {
                 location.reload();
               }
            });
            e.preventDefault();

         });
      },

      duplicateTemplateLayout: function(){
         $('.template-layout-dulipcate').on('click', function(e){
          if(!confirm("Are you sure you want to dulipcate this?")){
            return false;
          }
            var button = $(this);
            var title = $(this).attr('data-title');
            var post_id = $(this).attr('data-post_id');
            var language = $(this).attr('data-language');
            var title = $(this).attr('data-title');
            var type = $(this).attr('data-type');
            $('#gva-ajax-success h2').html(''); 
            $('#gva-ajax-loadding').addClass('active');
            $('.gva-ajax-overlay').addClass('active'); 
            $.ajax({
               type: 'POST',
               dataType: 'json',
               url: form_ajax_object.ajaxurl,
               data: {
                  'action'    : 'gowilds_duplicate_template_layout',
                  'post_id'   : post_id,
                  'language'  : language,
                  'type'      : type,
                  'security'  : form_ajax_object.security_nonce
               },
               success: function(data){
                if(data.message){
                  $('#gva-ajax-success h2').html(data.message); 
                }
                  $('#gva-ajax-loadding').removeClass('active'); 
                  $('#gva-ajax-success').addClass('active'); 
                  setTimeout( function(){
                     $('#gva-ajax-success').removeClass('active'); 
                     $('.gva-ajax-overlay').removeClass('active'); 
                  }, 2500);
                  location.reload();
               },
               error: function(data) {
                 location.reload();
               }
            });
            e.preventDefault();

         });
      },

      deleteTemplateLayout: function(){
         $('.template-layout-delete').on('click', function(e){
          if(!confirm("Are you sure you want to delete this?")){
            return false;
          }
            var button = $(this);
            var post_id = $(this).attr('data-post_id');

            $('#gva-ajax-success h2').html(''); 
            $('#gva-ajax-loadding').addClass('active');
            $('.gva-ajax-overlay').addClass('active'); 
            $.ajax({
               type: 'POST',
               dataType: 'json',
               url: form_ajax_object.ajaxurl,
               data: {
                  'action'    : 'gowilds_delete_template_layout',
                  'post_id'   : post_id,
                  'security'  : form_ajax_object.security_nonce
               },
               success: function(data){
                if(data.message){
                  $('#gva-ajax-success h2').html(data.message); 
                }
                  $('#gva-ajax-loadding').removeClass('active');
                  $('#gva-ajax-success').addClass('active'); 
                  setTimeout( function(){
                    $('#gva-ajax-success').removeClass('active'); 
                    $('.gva-ajax-overlay').removeClass('active'); 
                  }, 2500);
                  if(data.status == 'success'){
                    button.parents('.item').remove();
                  }
               },
               error: function(data) {
                 location.reload();
               }
            });
            e.preventDefault();

         });
      },

      setHeaderFooterLayout: function(){
        $('.choose-header-footer').each(function(){
          var label =  $(this).find('.active').html();
          $(this).find('a.label').html(label);
        });
        $('.choose-header-footer a.label').on('click', function(e){
          e.preventDefault();
          if($(this).parent().hasClass('open')){
            $(this).parent().removeClass('open');
          }else{
            $('.choose-header-footer').removeClass('open');
            $(this).parent().addClass('open');
          }
        });

         $('a.control-set-header-footer').on('click', function(e){
            e.preventDefault();
            $('#gva-ajax-success h2').html(''); 
            $('#gva-ajax-loadding').addClass('active');
            $('.gva-ajax-overlay').addClass('active'); 
            var button = $(this);
            $.ajax({
              type:'POST',
              dataType: 'json',
              url: form_ajax_object.ajaxurl,
              data: {
                  'action'    : "gowilds_set_header_footer_layout",
                  'security'  : form_ajax_object.security_nonce,
                  'h_f_id'    : button.attr('data-id'),
                  'layout_id' : button.attr('data-layout_id'),
                  'type'      : button.attr('data-type'),
                  'title'     : button.attr('data-title')
               },
               success: function(data){
                if(data.message){
                  $('#gva-ajax-success h2').html(data.message); 
                }
                $('#gva-ajax-loadding').removeClass('active'); 
                $('#gva-ajax-success').addClass('active'); 
                button.parents('.choose-header-footer').find('.control-set-header-footer').removeClass('active');
                button.parents('.choose-header-footer').find('.label').html(data.title);
                button.addClass('active');
                button.parents('.choose-header-footer').removeClass('open');
                setTimeout( function(){
                  $('#gva-ajax-success').removeClass('active'); 
                  $('.gva-ajax-overlay').removeClass('active'); 
                }, 2500);
                location.reload();
               },
               error: function(data) {
                 location.reload();
               }
            })
        });
      },

      setConfigState: function(){
         $('a.btn-set-config-state').on('click', function(e){
            e.preventDefault();
            $('#gva-ajax-success h2').html(''); 
            $('#gva-ajax-loadding').addClass('active');
            $('.gva-ajax-overlay').addClass('active'); 
            var button = $(this);
            $.ajax({
              type:'POST',
              dataType: 'json',
              url: form_ajax_object.ajaxurl,
              data: {
                  'action'    : "gowilds_set_state_config",
                  'security'  : form_ajax_object.security_nonce,
                  'type'      : button.attr('data-type'),
                  'id'        : button.attr('data-id'),
                  //'meta_key'  : button.attr('data-key')
               },
               success: function(data){
                if(data.message){
                  $('#gva-ajax-success h2').html(data.message); 
                }
                  $('#gva-ajax-loadding').removeClass('active'); 
                  $('#gva-ajax-success').addClass('active'); 
                  button.parents('.list-template-layout').find('.btn-set-config-state').removeClass('active');
                  button.addClass('active');
                  setTimeout( function(){
                     $('#gva-ajax-success').removeClass('active'); 
                     $('.gva-ajax-overlay').removeClass('active'); 
                  }, 2500);
               },
               error: function(data) {
                 location.reload();
               }
            })
        });
      },
   }

   $(document).ready(function(){
    templateLayoutManager.init();
  })

})(jQuery);

