let styleAdusting = (() => {
    let init = () => {
            $(document).ready(function () {
                if ($('.single-product').length) {
                    addClassToParent();
                    wrapItems();
                }
            });
        },
        addClassToParent = () => {
            $('.add-ons-select_parent').parent('.wcpa_row').addClass('add-ons-parent');
            // SELECT ITEMS
            $('.wine-add-on_parent').parent('.wcpa_row').addClass('wine-parent');
            $('.bubble-add-on_parent').parent('.wcpa_row').addClass('bubble-parent');
            $('.chocolate-add-on_parent').parent('.wcpa_row').addClass('chocolate-parent');
            $('.plush-add-on_parent').parent('.wcpa_row').addClass('plush-parent');
            $('.balloon-add-on_parent').parent('.wcpa_row').addClass('balloon-parent');
            $('.candle-add-on_parent').parent('.wcpa_row').addClass('candle-parent');
        }
        wrapItems = () => {
            $( '.wine-parent, .bubble-parent, .chocolate-parent, .plush-parent, .plush-parent, .balloon-parent, .candle-parent' ).wrapAll( "<div class='right-col' />");
            $( '.add-ons-parent, .right-col' ).wrapAll( "<div class='options-container' />");
        }

    ;
    init();
    return {};
})();
