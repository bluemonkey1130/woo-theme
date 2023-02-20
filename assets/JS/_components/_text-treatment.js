let textTreatmentSettings = (() => {
    let init = () => {
            $(document).ready(function () {
                orphanPreventor();
            });
        },

        orphanPreventor = () => { // add non breaking space between the last words in text blocks
            $('.orphanPrevent, .parentOrphanPrevent *').each(function (i, d) {
                // larger sized fonts should skip treatment on shorter sentances and last words longer than 10 chars
                if (d.tagName === 'H1' || d.tagName === 'H2' || d.tagName === 'H3') {
                    if (wordCount($(d).text()) > 3) { // if sentance length is longer than 3 words
                        let lastWord = $(d).text().split(" ").slice(-1);
                        if (lastWord[0].length < 10) { // if last word is shorter than 10 characters
                            $(d).html($(d).text().replace(/\s(?=[^\s]*$)/g, "&nbsp;"));
                        }
                    }
                    // typically smaller sized fonts should all be treated
                } else if (d.tagName === 'P' || d.tagName === 'H4' || d.tagName === 'H5' || d.tagName === 'H6' || d.tagName === 'H6' || d.tagName === 'BLOCKQUOTE') {
                    $(d).html($(d).text().replace(/\s(?=[^\s]*$)/g, "&nbsp;"));
                }

            });
            function wordCount(str) {
                return str.split(" ").length;
            }
        }


    ;
    init();
    return {};
})();
