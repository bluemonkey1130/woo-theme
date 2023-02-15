let modalVideo = (() => {
    let init = () => {
        $(document).ready(function () {
            if ($('.js-modal-btn').length) {
                modalInit();
            }

        });
    },
    modalInit = () =>{
        $(".js-modal-btn").modalVideo();
    }
    ;
    init();
    return {};
})();
