let mobileNavigationSettings = (() => {
    let init = () => {
            $(document).ready(function () {

                if ($('header').length) {
                    mobileNavigation();
                }

            });
        },
        mobileNavigation = () => {

            //MOBILE NAVIGATION
            let mobileNav = $("#mobile-menu");
            let menuButton = $("#menu-icon");
            let close = $("#close");

            menuButton.on("click", function (e) {
                // $(this).addClass('active');
                mobileNav.addClass('active');
            });
            close.on("click", function (e) {
                mobileNav.removeClass('active');
                open.removeClass('active');
            });

        }
    ;
    init();
    return {};
})();