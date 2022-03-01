'use strict';
(function ($) {

    $('.masonry').packery({
        // options
        columnWidth: '.grid-sizer',
        percentPosition: true,
        itemSelector: '.grid-item',
        gutter: 0
    });


    $('.gallery-item').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        disableOn: 0,
        mainClass: 'mfp-fade',
        gallery: {
            enabled: true,
            preload: [0, 2]
        }
    });

})(jQuery); // Fully reference jQuery after this point.