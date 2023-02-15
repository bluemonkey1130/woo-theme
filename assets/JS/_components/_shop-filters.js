let shopFiltersSettings = (() => {
    let init = () => {
            $(document).ready(function () {
                if ($('#products-filters').length) {
                    wrapWidget();
                    if ($(window).width() < 767) {
                        mobileFilterHandler();
                        mobileCategoryHandler();
                        mobileColourHandler();
                        mobileFlowerHandler();
                        mobileRecentViewHandler();
                        listToSelectProductCat();
                    }
                }
                if ($('.wc-block-product-categories-list').length) {
                    hideCategoryLabel();
                }
            });
        },
        wrapWidget = () => {
            $('#block-8, #block-12').wrapAll("<div class='cat' />");
        },
        hideCategoryLabel = () => {
            let categories = $(".wc-block-product-categories-list-item__name");
            $(categories).toArray();
            categories.each(function (index, Element) {
                if (Element.innerText === 'Flowers') {
                    $itemToHide = $(Element).closest("li");
                    $($itemToHide).addClass('hide');
                }
            });
        },
        mobileFilterHandler = () => {
            $("#widgetInner").hide();
            $("#mobileFilterOpen").click(function () {
                let $this = $(this);
                $this.toggleClass('active');
                $("#widgetInner").slideToggle("fast", "linear", function () {
                    // Animation complete.
                });
            });
        },
        mobileCategoryHandler = () => {
            $("#block-8").hide();
            $("#block-12").click(function () {
                let $this = $(this);
                $this.toggleClass('active');
                $("#block-8").slideToggle("fast", "linear", function () {
                    // Animation complete.
                });
            });
        },
        mobileColourHandler = () => {
            $("#block-10 .wp-block-woocommerce-filter-wrapper .wc-blocks-filter-wrapper h3").click(function () {
                let $this = $(this);
                $this.toggleClass('active');
                $("#block-10 .wp-block-woocommerce-attribute-filter").slideToggle("fast", "linear", function () {
                    // Animation complete.
                });
            });
        },
        mobileFlowerHandler = () => {
            $("#block-11 .wp-block-woocommerce-filter-wrapper .wc-blocks-filter-wrapper h3").click(function () {
                let $this = $(this);
                $this.toggleClass('active');
                $("#block-11 .wp-block-woocommerce-attribute-filter").slideToggle("fast", "linear", function () {
                    // Animation complete.
                });
            });
        },
        mobileRecentViewHandler = () => {
            $(".widget_recently_viewed_products").click(function () {
                let $this = $(this);
                $this.toggleClass('active');
                $(".product_list_widget").slideToggle("fast", "linear", function () {
                    // Animation complete.
                });
            });
        },

        listToSelectProductCat = () => {
            // Get the element containing the list items
            var list = document.querySelector(".wc-block-product-categories-list");

            // Create a new <select> element
            var select = document.createElement("select");
            select.id = "product-cat-list-select";

            // Create the "Please Select" option
            var pleaseSelectOption = document.createElement("option");
            pleaseSelectOption.text = "Please Select";
            pleaseSelectOption.disabled = true;
            pleaseSelectOption.selected = true;
            select.add(pleaseSelectOption);

            // Create a new option for each <li> element in the list
            var options = [];
            for (var i = 0; i < list.children.length; i++) {
                var option = document.createElement("option");
                option.value = list.children[i].querySelector("a").getAttribute("href");
                option.text = list.children[i].textContent;
                options.push(option);
            }

            // Add the options to the select element
            options.forEach(function(option) {
                select.add(option);
            });

            // Replace the list with the select element
            list.parentNode.replaceChild(select, list);

            // Get the selected option from local storage (if it exists)
            var selectedOption = localStorage.getItem("selectedOption");

            // Set the selected option in the select element
            if (selectedOption) {
                select.value = selectedOption;
            }

            // Listen for changes to the select element and redirect to the selected URL
            select.addEventListener("change", function() {
                if (this.value !== "") {
                    localStorage.setItem("selectedOption", this.value);
                    window.location = this.value;
                }
            });
        }
    ;
    init();
    return {};
})();