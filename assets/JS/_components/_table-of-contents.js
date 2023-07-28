let tableOfContentsSettings = (() => {
    let init = () => {
        $(document).ready(function () {
            if ($('#single-blog').length) {
                anchorHeadings();
                pinTableOfContents();
                showTableOfContents();
            }
        });
    },
    anchorHeadings = () => {
        const headings = document.querySelectorAll('.textBlock h1, .textBlock h2, .textBlock h3, .textBlock h4, .textBlock h5, .textBlock h6');
        return Array.from(headings).map((heading, index) => {
            const id = heading.textContent.toLowerCase().replace(/ /g, '-');
            if (!heading.id) {
                heading.id = id;
            }
            return {
                text: heading.textContent,
                id: id
            };
        });
    },
    pinTableOfContents = () => {
        let main = document.querySelector('main');
        let toc = document.querySelector('.table-of-contents');
        let header = document.querySelector('header');

        ScrollTrigger.create({
            trigger: toc,
            start: () => `top top+=${header.offsetHeight}px`,
            endTrigger: main,
            end: () => `bottom bottom-=${toc.offsetHeight + main.offsetTop}`,
            pin: toc,
            pinSpacing: false,
        });
    },
    showTableOfContents = () => {
        let mm = gsap.matchMedia();
        const tableHead = document.querySelector('.table-of-contents h3');
        const tableBody = document.querySelector('.table-of-contents ul');

        mm.add("(max-width: 1100px)", () => {
            $(tableBody).hide();
            $(tableHead).click(function () {
                $(tableHead).toggleClass('active');
                $(tableBody).slideToggle(500, "easeInOutQuad", function () {
                    // Animation complete.
                });
            });
            $(tableBody).click(function () {
                $(tableBody).slideUp(500, "easeInOutQuad",  function () {
                    $(tableHead).removeClass('active');
                });
            });
        });
    };
    ;
    init();
    return {};
})();
