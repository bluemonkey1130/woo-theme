'use strict';
(function ($) {
    $('.isoproducts').isotope({
        itemSelector: '.grid-item',
        masonry: {
            "gutter": 30
        },
    });

})(jQuery); // Fully reference jQuery after this point.
