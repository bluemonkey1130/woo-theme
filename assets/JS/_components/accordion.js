let accordionSettings = (() => {
    let init = () => {
        $(document).ready(function () {
            if ($('.accordionBlock').length) {
                accordion();
            }
        });
    },
    accordion = () =>{
        // Block Trigger
        $(".draw").hide();
        $(".trigger").click(function () {
            let $this = $(this);
            $this.parent('.accordion-block').toggleClass('active');
            $this.next().slideToggle( "fast","linear", function() {
                // Animation complete.
            });
        });
    }
    ;
    init();
    return {};
})();
