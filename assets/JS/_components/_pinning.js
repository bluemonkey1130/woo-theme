let pinningSettings = (() => {
    let init = () => {
            $(document).ready(function () {
                if ($('#productGallery').length) {
                    pinProductGalleryImage();
                }
                if ($('#singleImage').length) {
                    pinProductImage();
                }
                if ($('#products-filters').length) {
                    pinFilters();
                }
                if ($('#featured').length) {
                    pinFeaturedPost();
                }
            });
        },
        pinProductGalleryImage = () => {
            let mm = gsap.matchMedia();
            let imageBlock = document.getElementById("productGallery");
            mm.add("(min-width: 920px)", () => {
                ScrollTrigger.create({
                    trigger: imageBlock,
                    start: "top-=100px top",
                    end: "bottom bottom",
                    pin: true,
                    pinSpacing: false
                });
            });
        },
        pinProductImage = () => {
            let mm = gsap.matchMedia();
            let imageBlock = document.getElementById("singleImage");
            mm.add("(min-width: 920px)", () => {
                ScrollTrigger.create({
                    trigger: imageBlock,
                    start: "top-=100px top",
                    end: "bottom bottom",
                    pin: true,
                    pinSpacing: false
                });
            });
        },
        pinFilters = () => {
            let filterWidget = document.getElementById("widgetInner");
            let productsFilters = document.getElementById("products-filters");

            let mm = gsap.matchMedia();

            // mm.add("(min-width: 767px)", () => {
            //     ScrollTrigger.create({
            //         trigger: filterWidget,
            //         start: "top-=100px top",
            //         end: "max ",
            //         pin: true,
            //         pinSpacing: false
            //     });
            // });
            mm.add("(max-width: 766px)", () => {
                ScrollTrigger.create({
                    trigger: productsFilters,
                    start: "top top",
                    end: "max ",
                    pin: true,
                    pinSpacing: false
                });
            });
        },
        pinFeaturedPost = () => {

            let mm = gsap.matchMedia();
            let featuredPost = document.getElementById("featured");
            let blog = document.getElementById("blog");

            mm.add("(min-width: 767px)", () => {
                ScrollTrigger.create({
                    trigger: blog,
                    start: "top=-100  top",
                    end: "bottom bottom",
                    pin: featuredPost,
                    pinSpacing: false,
                    // markers:true,
                });
            });
            mm.add("(max-width: 766px)", () => {

            });
        }
    ;
    init();
    return {};
})();