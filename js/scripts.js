jQuery(function () {
    var search_icon    = jQuery('.top-bar .search-wrapper .search i');
    var search_wrapper = jQuery('.header .top-bar .search-wrapper');

    search_icon.on('click', function(){
        //if(jQuery('body').hasClass('mode-xs')) {
            search_wrapper.toggleClass('is-active');
            console.log('is-active');
        //}
    });

    jQuery('.m-nav-ico').on('click', function(){
        jQuery('.logo-nav nav').addClass('visible');
	});

    jQuery('.m-nav-close').on('click', function(){
        jQuery('.logo-nav nav').removeClass('visible');
    });



    jQuery('.user-account').on('click', function(){
        jQuery(this).find('.dropdown').toggleClass('visible');
    });

    jQuery('.menu-item-has-children > a').on('click', function(e){
        e.preventDefault();
        jQuery(this).next().toggleClass('visible');
        jQuery(this).parent().toggleClass('_active');
    });

});


// Wrap IIFE around your code
(function($, viewport){
    $(document).ready(function() {

        // Executes only in XS breakpoint
        if(viewport.is('xs')) {
           //$('body').addClass('mode-xs');
        }

        // Executes in SM, MD and LG breakpoints
        if(viewport.is('>=sm')) {
            // ...
        }

        // Executes in XS and SM breakpoints
        if(viewport.is('<md')) {
            // ...
        }

        // Execute code each time window size changes
        $(window).resize(
            viewport.changed(function() {
                if(viewport.is('xs')) {
                    $('body').addClass('mode-xs');
                }
            })
        );
    });
})(jQuery, ResponsiveBootstrapToolkit);