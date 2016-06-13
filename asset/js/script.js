jQuery(function($){
    $('.lightbox').magnificPopup({ 
        type: 'image'
    });
    
     $(function() {
         var $header = $('.header-container');
         $('.header-menu-btn').click(function() {
             $header.toggleClass('open');
             $('.header-menu-btn i').toggleClass('fa-bars');
             $('.header-menu-btn i').toggleClass('fa-times');
         });
     });
});

hljs.initHighlightingOnLoad();
hljs.configure({useBR: true});
$('div.code').each(function(i, block) {
    hljs.highlightBlock(block);
});