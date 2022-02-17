(function ($) {
// Select all links with hashes
//     $('a[href*="#"]')
//         // Remove links that don't actually link to anything
//         .not('[href="#"]')
//         .not('[href="#0"]')
//         .click(function (event) {
//             // On-page links
//             if (
//                 location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
//                 &&
//                 location.hostname == this.hostname
//             ) {
//                 // Figure out element to scroll to
//                 var target = $(this.hash);
//                 target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
//                 // Does a scroll target exist?
//                 if (target.length) {
//                     // Only prevent default if animation is actually gonna happen
//                     event.preventDefault();
//                     $('html, body').animate({
//                         scrollTop: target.offset().top - 250
//                     }, 1000, function () {
//                         // Callback after animation
//                         // Must change focus!
//                         var $target = $(target);
//                         $target.focus();
//                         if ($target.is(":focus")) { // Checking if the target was focused
//                             return false;
//                         } else {
//                             $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
//                             $target.focus(); // Set focus again
//                         }
//                         ;
//                     });
//                 }
//             }
//         });

    $.fn.smoothScroll = function (t, setHash) {
        // Set time to t variable to if undefined 500 for 500ms transition
        t = t || 500;
        setHash = (typeof setHash == 'undefined') ? true : setHash;

        // Return this as a proper jQuery plugin
        return this.each(function () {
            $('html, body').animate({
                scrollTop: $(this).offset().top - 100
            }, t);

            // Lets set the hash to the current ID since if an event was prevented this doesn't get done
            if (this.id && setHash) {
                window.location.hash = this.id;
            }
        });
    };


    if (window.location.hash) {
        window.scrollTo(0, 0);
        $(window.location.hash).smoothScroll();
    }

    $('a[href^="#"]').click(function (e) {
        e.preventDefault();
        var href = $(this).attr('href');

        // In this case we have only a hash, so maybe we want to scroll to the top of the page?
        if (href.length === 1) {
            href = 'body'
        }

        $(href).smoothScroll();
    });


})(jQuery); // Fully reference jQuery after this point
