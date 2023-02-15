let productAddOnSettings = (() => {
    let init = () => {
        $(document).ready(function () {
            if ($('.single-product').length) {
                customMessage();
            }
        });
    }
    customMessage = () => {
        $(".suggested-message input[type='radio']").change(function() {
            var selectedLabel = $(this).siblings("label").text();
            $(".custom-message-textarea").val(selectedLabel);
        });
    }
    ;
    init();
    return {};
})();
