'use strict';
(function ($) {
    window.dataLayer = window.dataLayer || [];
    let options = {
        title: 'Cookies & Privacy Policy',
        message: ['Our website uses cookies to improve user experience. By continuing to browse you are giving us your consent to our use of cookies.'],
        delay: 600,
        expires: [30],
        link: '/privacy-policy',

        onAccept: function () {

            var myPreferences = $.fn.ihavecookies.cookie();

            if ($.fn.ihavecookies.preference('analytics') === true) {
                dataLayer.push({'event': 'analyticsConsentGiven'});

            }
            if ($.fn.ihavecookies.preference('marketing') === true) {
                dataLayer.push({'event': 'marketingConsentGiven'});

            }
            if ($.fn.ihavecookies.preference('preferences') === true) {
                dataLayer.push({'event': 'preferencesConsentGiven'});

            }
            $("#cookie-wrapper").hide();

        },

        uncheckBoxes: true,
        acceptBtnLabel: 'Accept Cookies',
        moreInfoLabel: 'More information',
        cookieTypesTitle: 'Select which cookies you want to accept',
        fixedCookieTypeLabel: 'Essential',
        fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
    }

    $(document).ready(function () {
        $('body').ihavecookies(options);
        $('.button-cookie').on('click', function () {
            $('body').ihavecookies(options, 'reinit');
            $("#cookie-wrapper").show();
        });
    });

})(jQuery); // Fully reference jQuery after this point.
