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
            });
        },
        pinProductGalleryImage = () => {
            let imageBlock = document.getElementById("productGallery");
            ScrollTrigger.create({
                trigger: imageBlock,
                start: "top-=100px top",
                end: "bottom bottom",
                pin: true,
                pinSpacing: false
            });
        },
        pinProductImage = () => {
            let imageBlock = document.getElementById("singleImage");
            ScrollTrigger.create({
                trigger: imageBlock,
                start: "top-=100px top",
                end: "bottom bottom",
                pin: true,
                pinSpacing: false
            });
        },
        pinFilters = () => {
            let filterWidget = document.getElementById("widgetInner");
            let productsFilters = document.getElementById("products-filters");
            let mm = gsap.matchMedia();

            mm.add("(min-width: 767px)", () => {
                ScrollTrigger.create({
                    trigger: filterWidget,
                    start: "top-=100px top",
                    end: "max ",
                    pin: true,
                    pinSpacing: false
                });
            });
            mm.add("(max-width: 766px)", () => {
                ScrollTrigger.create({
                    trigger: productsFilters,
                    start: "top-=100px top",
                    end: "max ",
                    pin: true,
                    pinSpacing: false
                });
            });
        }
    ;
    init();
    return {};
})();