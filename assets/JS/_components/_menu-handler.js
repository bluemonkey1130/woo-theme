let menuHandlerSettings = (() => {
    let init = () => {
            $(document).ready(function () {
                menuHandler();
                if ($('.header-ribbon').length) {
                    if ($(window).width() > 767) {
                        ribbonHeightAdjuster();
                    }
                    ribbonHandler();
                }
            });


        },
        ribbonHeightAdjuster = () => {
            let header = document.getElementById("header");
            let elemHeight = $(".header-ribbon").offsetHeight;
            header.style.top = elemHeight + 'px';
        },
        menuHandler = () => {
            gsap.registerPlugin(ScrollTrigger, ScrollToPlugin)
            let scrollDeadzone = 80;
            let lastScrollTop = 0;

            let menuTrigger = ScrollTrigger.create;
            lastScrollTop = $(window).scrollTop();
            $(window).scroll(menuScrollHandler);

            function menuScrollHandler(e) {
                scrollTop = $(e.currentTarget).scrollTop();
                if (scrollTop > lastScrollTop + scrollDeadzone) {
                    hideMenu();
                    lastScrollTop = scrollTop;
                    return;
                }
                if ((scrollTop < lastScrollTop - scrollDeadzone) || scrollTop < scrollDeadzone) {
                    showMenu();
                    lastScrollTop = scrollTop;
                    return;
                }
            }

            function hideMenu() {
                gsap.to("header", {y: "-100%"});
            }

            function showMenu() {
                gsap.to("header", {y: "0%"});
            }

        }
        ribbonHandler = () => {
            gsap.registerPlugin(ScrollTrigger, ScrollToPlugin)
            let scrollDeadzone = 80;
            let lastScrollTop = 0;
            let mm = gsap.matchMedia();

            mm.add("(max-width: "+mobileBreakpoint+"px", () => {
                console.log('blah');
                let menuTrigger = ScrollTrigger.create;
                lastScrollTop = $(window).scrollTop();
                $(window).scroll(menuScrollHandler);

                function menuScrollHandler(e) {
                    scrollTop = $(e.currentTarget).scrollTop();
                    if (scrollTop > lastScrollTop + scrollDeadzone) {
                        hideMenu();
                        lastScrollTop = scrollTop;
                        return;
                    }
                    if ((scrollTop < lastScrollTop - scrollDeadzone) || scrollTop < scrollDeadzone) {
                        showMenu();
                        lastScrollTop = scrollTop;
                        return;
                    }
                }

                function hideMenu() {
                    gsap.to(".header-ribbon", {y: "+100%"});
                }

                function showMenu() {
                    gsap.to(".header-ribbon", {y: "0%"});
                }
            });

        }
    ;
    init();
    return {};
})();
