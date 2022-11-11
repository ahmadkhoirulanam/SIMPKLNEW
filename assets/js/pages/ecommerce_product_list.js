/* ------------------------------------------------------------------------------
*
*  # Ecommerce - product list
*
*  Specific JS code additions for product listing pages
*
*  Version: 1.0
*  Latest update: Mar 20, 2022
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Lightbox
    $('[data-popup="lightbox"]').fancybox({
	    padding: 3
    });

    // Uniform.js - custom checkboxes
    $('.styled').uniform({
        radioClass: 'choice'
    });

});
