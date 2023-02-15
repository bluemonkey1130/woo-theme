let singleProductSettings = (() => {
    let init = () => {
            $(document).ready(function () {
                if ($('.single-product').length) {
                    priceIcon();
                }

            });
        },
        priceIcon = () =>{
            $( ".wcpa_form_outer .wcpa_price" ).prepend( "<p>+</p>" );
        }
    ;
    init();
    return {};
})();