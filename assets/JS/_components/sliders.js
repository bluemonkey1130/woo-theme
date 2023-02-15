let sliders = (() => {
    let init = () => {
            $(document).ready(function () {
                if ($('#custom-hero').length) {
                    heroSlider();
                }
                if ($('.slidesBlock').length) {
                    slidesBlock();
                }
                if ($('#single-product').length) {
                    productSlider();
                }
                if ($('.flexSlider').length) {
                    flexSlider();
                }
            });
        },
        heroSlider = () => {
            $('.slider').each(function (index, sliderWrap) {
                let $carousel = $(this);
                $carousel.slick({
                    adaptiveHeight: true,
                });
            });
        },
        slidesBlock = () => {
            $('.slidesBlock').each(function (index, sliderWrap) {
                let $carousel = $(this);
                $carousel.slick(
                    {
                        fade: true,
                        autoplay: true,
                        autoplaySpeed: 5000,
                        arrows: false,
                    }
                );
            });
        },
        flexSlider = () => {
            var elements = document.querySelectorAll(".flexSlider");

            if (window.innerWidth < sliderBreakpoint) {
                slideInit();
            } else {
                slideUnslick();
            }
            $(window).resize(function(e){
                if(window.innerWidth < sliderBreakpoint) {
                    slideInit();
                }else{
                    slideUnslick();
                }
            });
            function slideInit(){
                for (var i = 0; i < elements.length; i++) {
                    $(elements[i]).slick({
                        autoplay: false,
                        arrows: true,
                    });
                    elements[i].style.gridTemplateColumns = "1fr";
                }
            }
            function slideUnslick(){
                if ($('.flexSlider').hasClass('slick-initialized')) {
                    for (var i = 0; i < elements.length; i++) {
                        elements[i].style.gridTemplateColumns = '';
                        $(elements[i]).slick('unslick');
                    }
                }
            }
        },
        productSlider = () => {
            $('.productSliderMain').slick({
                fade: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                arrows: false,
                // asNavFor: '.productSliderNav',
            });
            let length = $('.productSliderNav img').length;
            console.log(length);
            $('.productSliderNav').slick({
                slidesToShow: length,
                slidesToScroll: 1,
                dots: false,
                vertical: true,
                asNavFor: '.productSliderMain',
                focusOnSelect: true,
                centerMode: true,
            });
        }
    ;
    init();
    return {};
})();