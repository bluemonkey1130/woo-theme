function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

var fadeUpSetting = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($(".fadeUp").length) {
        fadeUp();
      }

      if ($(".fadeIn").length) {
        fadeIn();
      }
    });
  },
      fadeUp = function fadeUp() {
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray(".fadeUp").forEach(function (section, i) {
      gsap.fromTo(section, {
        y: 20,
        opacity: 0
      }, {
        y: 0,
        opacity: 1,
        ease: "back.out(1.7)",
        duration: 0.6,
        scrollTrigger: {
          trigger: section,
          start: "+=150 90%",
          end: "+=200 40%" // markers: true,

        }
      });
    });
  },
      fadeIn = function fadeIn() {
    gsap.registerPlugin(ScrollTrigger);
    gsap.utils.toArray(".fadeIn").forEach(function (section, i) {
      gsap.to(section, {
        opacity: 1,
        duration: 0.6
      });
    });
  };

  init();
  return {};
}(); // 'use strict';
// (function ($) {
//
//     $(document).ready(function(){
//         var e = document.getElementById("subjectId");
//         var strUser = e.options[0].innerHTML;
//         $('#subject').val(strUser);
//     })
//
//
//     $('#subjectId').change(function() {
//         var val = this.value;
//         var label = this.options[this.selectedIndex].innerHTML;
//         $('#toEmail').val(val);
//         $('#subject').val(label);
//
//     })
//     function datePicker() {
//         $('.datepicker').each(function (index, Element) {
//             let $this = $(this);
//             $this.datepicker();
//         });
//     }
//     datePicker();
//     // DATE PICKER
//
//
//     // DATE RANGE
//     $( function() {
//         var dateFormat = "mm/dd/yy",
//             from = $( "#from" )
//                 .datepicker({
//                     defaultDate: "+1w",
//                     changeMonth: true,
//                     numberOfMonths: 3
//                 })
//                 .on( "change", function() {
//                     to.datepicker( "option", "minDate", getDate( this ) );
//                 }),
//             to = $( "#to" ).datepicker({
//                 defaultDate: "+1w",
//                 changeMonth: true,
//                 numberOfMonths: 3
//             })
//                 .on( "change", function() {
//                     from.datepicker( "option", "maxDate", getDate( this ) );
//                 });
//
//         function getDate( element ) {
//             var date;
//             try {
//                 date = $.datepicker.parseDate( dateFormat, element.value );
//             } catch( error ) {
//                 date = null;
//             }
//
//             return date;
//         }
//     } );
//     let openForm = $(".open-form-link");
//     openForm.magnificPopup({
//         type:'inline',
//         gallery:{
//             enabled:true
//         },
//         midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
//     });
//     openForm.on("click", function (e) {
//         datePicker();
//     });
//
// })(jQuery); // Fully reference jQuery after this point.


var mapsSettings = function () {
  var init = function init() {
    $(document).ready(function () {});
  };

  initMaps = function initMaps() {
    if ($(".map").length) {
      $('.map').each(function (index, Element) {
        var params = $(Element).text().split(",");
        var target = {
          lat: parseFloat(params[0]),
          lng: parseFloat(params[1])
        };
        var zoom = parseFloat(params[2]);
        var mapID = params[3];
        var iconColour = params[4];
        var addressName = params[5] + params[6] + params[7] + params[8];
        var mapStringLit = "".concat(mapID);
        var myOptions = {
          zoom: zoom,
          mapId: mapStringLit,
          center: target,
          disableDefaultUI: true
        };
        var map = new google.maps.Map(Element, myOptions);
        var icon = {
          path: "M23.13,8a11.45,11.45,0,0,0-10.5-8c-5.15-.23-9,2.07-11.39,6.65A12.67,12.67,0,0,0,3,20.31c2.67,3,5.47,6,8.21,8.94L12,30l.77-.78q3.84-4.21,7.69-8.42A12.26,12.26,0,0,0,23.13,8ZM11.86,17.79a5.66,5.66,0,0,1-5.3-5.61,5.52,5.52,0,0,1,5.64-5.6,5.62,5.62,0,0,1-.34,11.21Z",
          fillColor: iconColour,
          fillOpacity: 1,
          anchor: new google.maps.Point(12, 24),
          strokeWeight: 0,
          scale: 1.5
        };
        var marker = new google.maps.Marker({
          position: target,
          map: map,
          icon: icon
        });
        var infowindow = new google.maps.InfoWindow({
          content: addressName + ' <a target="_blank" href="http://maps.google.com/?q=' + addressName + '">Get Directions</a>'
        });
        marker.addListener("click", function () {
          infowindow.open(map, marker);
        });
      });
    }

    if ($("#map").length) {
      var parentMapInfo = $("#map > .map-info");
      var mapParams = parentMapInfo.text().split(",");
      var zoom = parseFloat(mapParams[0]);
      var mapID = mapParams[1];
      var mapStringLit = "".concat(mapID);
      var maps = $("#map > .location");
      var location = [];
      maps.each(function (index, Element) {
        var params = $(Element).text().split(",");
        location.push({
          lat: parseFloat(params[0]),
          lng: parseFloat(params[1]),
          addressName: params[3] + params[4] + params[5],
          iconColour: params[2]
        });
      }); //First location defines the Map Center

      var center = new google.maps.LatLng(location[0].lat, location[0].lng);
      var myOptions = {
        zoom: zoom,
        mapId: mapStringLit,
        center: center,
        disableDefaultUI: true
      };
      var map = new google.maps.Map(document.getElementById('map'), myOptions);
      var infowindow = new google.maps.InfoWindow({});
      var marker, count;

      for (count = 0; count < location.length; count++) {
        var icon = {
          path: "M23.13,8a11.45,11.45,0,0,0-10.5-8c-5.15-.23-9,2.07-11.39,6.65A12.67,12.67,0,0,0,3,20.31c2.67,3,5.47,6,8.21,8.94L12,30l.77-.78q3.84-4.21,7.69-8.42A12.26,12.26,0,0,0,23.13,8ZM11.86,17.79a5.66,5.66,0,0,1-5.3-5.61,5.52,5.52,0,0,1,5.64-5.6,5.62,5.62,0,0,1-.34,11.21Z",
          fillColor: location[count].iconColour,
          fillOpacity: 1,
          anchor: new google.maps.Point(12, 24),
          strokeWeight: 0,
          scale: 1.5
        };
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(location[count].lat, location[count].lng),
          map: map,
          icon: icon
        });
        google.maps.event.addListener(marker, 'click', function (marker, count) {
          return function () {
            infowindow.setContent(location[count].addressName + ' <a target="_blank" href="http://maps.google.com/?q=' + location[count].addressName + '">Get Directions</a>'); // infowindow.setContent(location[count].name);

            infowindow.open(map, marker);
          };
        }(marker, count));
      }
    }
  };

  init();
  return {};
}();

var menuHandlerSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      menuHandler();

      if ($('.header-ribbon').length) {
        if ($(window).width() > 767) {
          ribbonHeightAdjuster();
        }

        ribbonHandler();
      }
    });
  },
      ribbonHeightAdjuster = function ribbonHeightAdjuster() {
    var header = document.getElementById("header");
    var elemHeight = $(".header-ribbon").offsetHeight;
    header.style.top = elemHeight + 'px';
  },
      menuHandler = function menuHandler() {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
    var scrollDeadzone = 80;
    var lastScrollTop = 0;
    var menuTrigger = ScrollTrigger.create;
    lastScrollTop = $(window).scrollTop();
    $(window).scroll(menuScrollHandler);

    function menuScrollHandler(e) {
      scrollTop = $(e.currentTarget).scrollTop();

      if (scrollTop > lastScrollTop + scrollDeadzone) {
        hideMenu();
        lastScrollTop = scrollTop;
        return;
      }

      if (scrollTop < lastScrollTop - scrollDeadzone || scrollTop < scrollDeadzone) {
        showMenu();
        lastScrollTop = scrollTop;
        return;
      }
    }

    function hideMenu() {
      gsap.to("header", {
        y: "-100%"
      });
    }

    function showMenu() {
      gsap.to("header", {
        y: "0%"
      });
    }
  };

  ribbonHandler = function ribbonHandler() {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);
    var scrollDeadzone = 80;
    var lastScrollTop = 0;
    var mm = gsap.matchMedia();
    mm.add("(max-width: " + mobileBreakpoint + "px", function () {
      console.log('blah');
      var menuTrigger = ScrollTrigger.create;
      lastScrollTop = $(window).scrollTop();
      $(window).scroll(menuScrollHandler);

      function menuScrollHandler(e) {
        scrollTop = $(e.currentTarget).scrollTop();

        if (scrollTop > lastScrollTop + scrollDeadzone) {
          hideMenu();
          lastScrollTop = scrollTop;
          return;
        }

        if (scrollTop < lastScrollTop - scrollDeadzone || scrollTop < scrollDeadzone) {
          showMenu();
          lastScrollTop = scrollTop;
          return;
        }
      }

      function hideMenu() {
        gsap.to(".header-ribbon", {
          y: "+100%"
        });
      }

      function showMenu() {
        gsap.to(".header-ribbon", {
          y: "0%"
        });
      }
    });
  };

  init();
  return {};
}();

var modalVideo = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('.js-modal-btn').length) {
        modalInit();
      }
    });
  },
      modalInit = function modalInit() {
    $(".js-modal-btn").modalVideo();
  };

  init();
  return {};
}();

var pinningSettings = function () {
  var init = function init() {
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
      pinProductGalleryImage = function pinProductGalleryImage() {
    var mm = gsap.matchMedia();
    var imageBlock = document.getElementById("productGallery");
    mm.add("(min-width: 920px)", function () {
      ScrollTrigger.create({
        trigger: imageBlock,
        start: "top-=100px top",
        end: "bottom bottom",
        pin: true,
        pinSpacing: false
      });
    });
  },
      pinProductImage = function pinProductImage() {
    var mm = gsap.matchMedia();
    var imageBlock = document.getElementById("singleImage");
    mm.add("(min-width: 920px)", function () {
      ScrollTrigger.create({
        trigger: imageBlock,
        start: "top-=100px top",
        end: "bottom bottom",
        pin: true,
        pinSpacing: false
      });
    });
  },
      pinFilters = function pinFilters() {
    var filterWidget = document.getElementById("widgetInner");
    var productsFilters = document.getElementById("products-filters");
    var mm = gsap.matchMedia(); // mm.add("(min-width: 767px)", () => {
    //     ScrollTrigger.create({
    //         trigger: filterWidget,
    //         start: "top-=100px top",
    //         end: "max ",
    //         pin: true,
    //         pinSpacing: false
    //     });
    // });

    mm.add("(max-width: 766px)", function () {
      ScrollTrigger.create({
        trigger: productsFilters,
        start: "top top",
        end: "max ",
        pin: true,
        pinSpacing: false
      });
    });
  },
      pinFeaturedPost = function pinFeaturedPost() {
    var mm = gsap.matchMedia();
    var featuredPost = document.getElementById("featured");
    var blog = document.getElementById("blog");
    mm.add("(min-width: 767px)", function () {
      ScrollTrigger.create({
        trigger: blog,
        start: "top=-100  top",
        end: "bottom bottom",
        pin: featuredPost,
        pinSpacing: false // markers:true,

      });
    });
    mm.add("(max-width: 766px)", function () {});
  };

  init();
  return {};
}();

var productAddOnSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('.single-product').length) {
        customMessage();
      }
    });
  };

  customMessage = function customMessage() {
    $(".suggested-message input[type='radio']").change(function () {
      var selectedLabel = $(this).siblings("label").text();
      $(".custom-message-textarea").val(selectedLabel);
    });
  };

  init();
  return {};
}();

var shopFiltersSettings = function () {
  var init = function init() {
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
      wrapWidget = function wrapWidget() {
    $('#block-8, #block-12').wrapAll("<div class='cat' />");
  },
      hideCategoryLabel = function hideCategoryLabel() {
    var categories = $(".wc-block-product-categories-list-item__name");
    $(categories).toArray();
    categories.each(function (index, Element) {
      if (Element.innerText === 'Flowers') {
        $itemToHide = $(Element).closest("li");
        $($itemToHide).addClass('hide');
      }
    });
  },
      mobileFilterHandler = function mobileFilterHandler() {
    $("#widgetInner").hide();
    $("#mobileFilterOpen").click(function () {
      var $this = $(this);
      $this.toggleClass('active');
      $("#widgetInner").slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  },
      mobileCategoryHandler = function mobileCategoryHandler() {
    $("#block-8").hide();
    $("#block-12").click(function () {
      var $this = $(this);
      $this.toggleClass('active');
      $("#block-8").slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  },
      mobileColourHandler = function mobileColourHandler() {
    $("#block-10 .wp-block-woocommerce-filter-wrapper .wc-blocks-filter-wrapper h3").click(function () {
      var $this = $(this);
      $this.toggleClass('active');
      $("#block-10 .wp-block-woocommerce-attribute-filter").slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  },
      mobileFlowerHandler = function mobileFlowerHandler() {
    $("#block-11 .wp-block-woocommerce-filter-wrapper .wc-blocks-filter-wrapper h3").click(function () {
      var $this = $(this);
      $this.toggleClass('active');
      $("#block-11 .wp-block-woocommerce-attribute-filter").slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  },
      mobileRecentViewHandler = function mobileRecentViewHandler() {
    $(".widget_recently_viewed_products").click(function () {
      var $this = $(this);
      $this.toggleClass('active');
      $(".product_list_widget").slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  },
      listToSelectProductCat = function listToSelectProductCat() {
    // Get the element containing the list items
    var list = document.querySelector(".wc-block-product-categories-list"); // Create a new <select> element

    var select = document.createElement("select");
    select.id = "product-cat-list-select"; // Create the "Please Select" option

    var pleaseSelectOption = document.createElement("option");
    pleaseSelectOption.text = "Please Select";
    pleaseSelectOption.disabled = true;
    pleaseSelectOption.selected = true;
    select.add(pleaseSelectOption); // Create a new option for each <li> element in the list

    var options = [];

    for (var i = 0; i < list.children.length; i++) {
      var option = document.createElement("option");
      option.value = list.children[i].querySelector("a").getAttribute("href");
      option.text = list.children[i].textContent;
      options.push(option);
    } // Add the options to the select element


    options.forEach(function (option) {
      select.add(option);
    }); // Replace the list with the select element

    list.parentNode.replaceChild(select, list); // Get the selected option from local storage (if it exists)

    var selectedOption = localStorage.getItem("selectedOption"); // Set the selected option in the select element

    if (selectedOption) {
      select.value = selectedOption;
    } // Listen for changes to the select element and redirect to the selected URL


    select.addEventListener("change", function () {
      if (this.value !== "") {
        localStorage.setItem("selectedOption", this.value);
        window.location = this.value;
      }
    });
  };

  init();
  return {};
}();

var singleProductSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('.single-product').length) {
        priceIcon();
      }
    });
  },
      priceIcon = function priceIcon() {
    $(".wcpa_form_outer .wcpa_price").prepend("<p>+</p>");
  };

  init();
  return {};
}();

(function ($) {
  // Select all links with hashes
  //     $('a[href*="#"]')
  //         // Remove links that don't actually link to anything
  //         .not('[href="#"]')
  //         .not('[href="#0"]')
  //         .click(function (event) {
  //             // On-page links
  //             if (
  //                 location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
  //                 &&
  //                 location.hostname == this.hostname
  //             ) {
  //                 // Figure out element to scroll to
  //                 var target = $(this.hash);
  //                 target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
  //                 // Does a scroll target exist?
  //                 if (target.length) {
  //                     // Only prevent default if animation is actually gonna happen
  //                     event.preventDefault();
  //                     $('html, body').animate({
  //                         scrollTop: target.offset().top - 250
  //                     }, 1000, function () {
  //                         // Callback after animation
  //                         // Must change focus!
  //                         var $target = $(target);
  //                         $target.focus();
  //                         if ($target.is(":focus")) { // Checking if the target was focused
  //                             return false;
  //                         } else {
  //                             $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
  //                             $target.focus(); // Set focus again
  //                         }
  //                         ;
  //                     });
  //                 }
  //             }
  //         });
  $.fn.smoothScroll = function (t, setHash) {
    // Set time to t variable to if undefined 500 for 500ms transition
    t = t || 500;
    setHash = typeof setHash == 'undefined' ? true : setHash; // Return this as a proper jQuery plugin

    return this.each(function () {
      $('html, body').animate({
        scrollTop: $(this).offset().top - 100
      }, t); // Lets set the hash to the current ID since if an event was prevented this doesn't get done

      if (this.id && setHash) {
        window.location.hash = this.id;
      }
    });
  };

  if (window.location.hash) {
    window.scrollTo(0, 0);
    $(window.location.hash).smoothScroll();
  }

  $('a[href^="#"]').click(function (e) {
    e.preventDefault();
    var href = $(this).attr('href'); // In this case we have only a hash, so maybe we want to scroll to the top of the page?

    if (href.length === 1) {
      href = 'body';
    }

    $(href).smoothScroll();
  });
})(jQuery); // Fully reference jQuery after this point


var tableOfContentsSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('#single-blog').length) {
        anchorHeadings();
        pinTableOfContents();
        showTableOfContents();
      }
    });
  },
      anchorHeadings = function anchorHeadings() {
    var headings = document.querySelectorAll('.textBlock h1, .textBlock h2, .textBlock h3, .textBlock h4, .textBlock h5, .textBlock h6');
    return Array.from(headings).map(function (heading, index) {
      var id = heading.textContent.toLowerCase().replace(/ /g, '-');

      if (!heading.id) {
        heading.id = id;
      }

      return {
        text: heading.textContent,
        id: id
      };
    });
  },
      pinTableOfContents = function pinTableOfContents() {
    var main = document.querySelector('main');
    var toc = document.querySelector('.table-of-contents');
    var header = document.querySelector('header');
    ScrollTrigger.create({
      trigger: toc,
      start: function start() {
        return "top top+=".concat(header.offsetHeight, "px");
      },
      endTrigger: main,
      end: function end() {
        return "bottom bottom-=".concat(toc.offsetHeight + main.offsetTop);
      },
      pin: toc,
      pinSpacing: false
    });
  },
      showTableOfContents = function showTableOfContents() {
    var mm = gsap.matchMedia();
    var tableHead = document.querySelector('.table-of-contents h3');
    var tableBody = document.querySelector('.table-of-contents ul');
    mm.add("(max-width: 1100px)", function () {
      $(tableBody).hide();
      $(tableHead).click(function () {
        $(tableHead).toggleClass('active');
        $(tableBody).slideToggle(500, "easeInOutQuad", function () {// Animation complete.
        });
      });
      $(tableBody).click(function () {
        $(tableBody).slideUp(500, "easeInOutQuad", function () {
          $(tableHead).removeClass('active');
        });
      });
    });
  };

  ;
  init();
  return {};
}();

var textTreatmentSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      orphanPreventor();
    });
  },
      orphanPreventor = function orphanPreventor() {
    // add non breaking space between the last words in text blocks
    $('.orphanPrevent, .parentOrphanPrevent *').each(function (i, d) {
      // larger sized fonts should skip treatment on shorter sentances and last words longer than 10 chars
      if (d.tagName === 'H1' || d.tagName === 'H2' || d.tagName === 'H3') {
        if (wordCount($(d).text()) > 3) {
          // if sentance length is longer than 3 words
          var lastWord = $(d).text().split(" ").slice(-1);

          if (lastWord[0].length < 10) {
            // if last word is shorter than 10 characters
            $(d).html($(d).text().replace(/\s(?=[^\s]*$)/g, "&nbsp;"));
          }
        } // typically smaller sized fonts should all be treated

      } else if (d.tagName === 'P' || d.tagName === 'H4' || d.tagName === 'H5' || d.tagName === 'H6' || d.tagName === 'H6' || d.tagName === 'BLOCKQUOTE') {
        $(d).html($(d).text().replace(/\s(?=[^\s]*$)/g, "&nbsp;"));
      }
    });

    function wordCount(str) {
      return str.split(" ").length;
    }
  };

  init();
  return {};
}();

var accordionSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('.accordionBlock').length) {
        accordion();
      }
    });
  },
      accordion = function accordion() {
    // Block Trigger
    $(".draw").hide();
    $(".trigger").click(function () {
      var $this = $(this);
      $this.parent('.accordion-block').toggleClass('active');
      $this.next().slideToggle("fast", "linear", function () {// Animation complete.
      });
    });
  };

  init();
  return {};
}();

var styleAdusting = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('.single-product').length) {
        addClassToParent();
        wrapItems();
      }
    });
  },
      addClassToParent = function addClassToParent() {
    $('.add-ons-select_parent').parent('.wcpa_row').addClass('add-ons-parent'); // SELECT ITEMS

    $('.wine-add-on_parent').parent('.wcpa_row').addClass('wine-parent');
    $('.bubble-add-on_parent').parent('.wcpa_row').addClass('bubble-parent');
    $('.chocolate-add-on_parent').parent('.wcpa_row').addClass('chocolate-parent');
    $('.plush-add-on_parent').parent('.wcpa_row').addClass('plush-parent');
    $('.balloon-add-on_parent').parent('.wcpa_row').addClass('balloon-parent');
    $('.candle-add-on_parent').parent('.wcpa_row').addClass('candle-parent');
  };

  wrapItems = function wrapItems() {
    $('.wine-parent, .bubble-parent, .chocolate-parent, .plush-parent, .plush-parent, .balloon-parent, .candle-parent').wrapAll("<div class='right-col' />");
    $('.add-ons-parent, .right-col').wrapAll("<div class='options-container' />");
  };

  init();
  return {};
}();

'use strict';

(function ($) {
  var nVer = navigator.appVersion;
  var nAgt = navigator.userAgent;
  var browserName = navigator.appName;
  var fullVersion = '' + parseFloat(navigator.appVersion);
  var majorVersion = parseInt(navigator.appVersion, 10);
  var nameOffset, verOffset, ix; // In Opera 15+, the true version is after "OPR/"

  if ((verOffset = nAgt.indexOf("OPR/")) != -1) {
    browserName = "opera";
    fullVersion = nAgt.substring(verOffset + 4);
  } // In older Opera, the true version is after "Opera" or after "Version"
  else if ((verOffset = nAgt.indexOf("Opera")) != -1) {
    browserName = "opera";
    fullVersion = nAgt.substring(verOffset + 6);
    if ((verOffset = nAgt.indexOf("Version")) != -1) fullVersion = nAgt.substring(verOffset + 8);
  } // In MSIE, the true version is after "MSIE" in userAgent
  else if ((verOffset = nAgt.indexOf("MSIE")) != -1) {
    browserName = "ie";
    fullVersion = nAgt.substring(verOffset + 5);
  } // In Chrome, the true version is after "Chrome"
  else if ((verOffset = nAgt.indexOf("Chrome")) != -1) {
    browserName = "chrome";
    fullVersion = nAgt.substring(verOffset + 7);
  } // In Safari, the true version is after "Safari" or after "Version"
  else if ((verOffset = nAgt.indexOf("Safari")) != -1) {
    browserName = "safari";
    fullVersion = nAgt.substring(verOffset + 7);
    if ((verOffset = nAgt.indexOf("Version")) != -1) fullVersion = nAgt.substring(verOffset + 8);
  } // In Firefox, the true version is after "Firefox"
  else if ((verOffset = nAgt.indexOf("Firefox")) != -1) {
    browserName = "firefox";
    fullVersion = nAgt.substring(verOffset + 8);
  } // In most other browsers, "name/version" is at the end of userAgent
  else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
    browserName = nAgt.substring(nameOffset, verOffset);
    fullVersion = nAgt.substring(verOffset + 1);

    if (browserName.toLowerCase() == browserName.toUpperCase()) {
      browserName = navigator.appName;
    }
  } // trim the fullVersion string at semicolon/space if present


  if ((ix = fullVersion.indexOf(";")) != -1) fullVersion = fullVersion.substring(0, ix);
  if ((ix = fullVersion.indexOf(" ")) != -1) fullVersion = fullVersion.substring(0, ix);
  majorVersion = parseInt('' + fullVersion, 10);

  if (isNaN(majorVersion)) {
    fullVersion = '' + parseFloat(navigator.appVersion);
    majorVersion = parseInt(navigator.appVersion, 10);
  }

  $('html').addClass(browserName + '-' + majorVersion);
})(jQuery); // Fully reference jQuery after this point


'use strict';

(function ($) {
  window.dataLayer = window.dataLayer || [];
  var options = {
    title: 'Cookies & Privacy Policy',
    message: ['Our website uses cookies to improve user experience. By continuing to browse you are giving us your consent to our use of cookies.'],
    delay: 600,
    expires: [30],
    link: '/privacy-policy',
    onAccept: function onAccept() {
      var myPreferences = $.fn.ihavecookies.cookie();

      if ($.fn.ihavecookies.preference('analytics') === true) {
        dataLayer.push({
          'event': 'analyticsConsentGiven'
        });
      }

      if ($.fn.ihavecookies.preference('marketing') === true) {
        dataLayer.push({
          'event': 'marketingConsentGiven'
        });
      }

      if ($.fn.ihavecookies.preference('preferences') === true) {
        dataLayer.push({
          'event': 'preferencesConsentGiven'
        });
      }

      $("#cookie-wrapper").hide();
    },
    uncheckBoxes: true,
    acceptBtnLabel: 'Accept Cookies',
    moreInfoLabel: 'More information',
    cookieTypesTitle: 'Select which cookies you want to accept',
    fixedCookieTypeLabel: 'Essential',
    fixedCookieTypeDesc: 'These are essential for the website to work correctly.'
  };
  $(document).ready(function () {
    $('body').ihavecookies(options);
    $('.button-cookie').on('click', function () {
      $('body').ihavecookies(options, 'reinit');
      $("#cookie-wrapper").show();
    });
  });
})(jQuery); // Fully reference jQuery after this point.


'use strict';

(function ($) {
  // This will create a single gallery from all elements that have class "gallery-item"
  $('.gallery-item').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true
    }
  });
  $('.popup-video').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });
  $('.open-card-popup').magnificPopup({
    type: 'inline',
    midClick: false // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

  });
  $('.open-contact-popup').magnificPopup({
    type: 'inline',
    midClick: false // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

  });
  $('.popup-tweet').magnificPopup({
    type: 'inline',
    gallery: {
      enabled: true
    }
  });
  $('.open-popup-link').magnificPopup({
    type: 'inline',
    gallery: {
      enabled: true
    },
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.

  });
})(jQuery); // Fully reference jQuery after this point.


var mobileNavigationSettings = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('header').length) {
        mobileNavigation();
      }
    });
  },
      mobileNavigation = function mobileNavigation() {
    //MOBILE NAVIGATION
    var mobileNav = $("#mobile-menu");
    var menuButton = $("#menu-icon");
    var close = $("#close");
    menuButton.on("click", function (e) {
      // $(this).addClass('active');
      mobileNav.addClass('active');
    });
    close.on("click", function (e) {
      mobileNav.removeClass('active');
      open.removeClass('active');
    });
  };

  init();
  return {};
}();

function O(i) {
  return _typeof(i) == 'object' ? i : document.getElementById(i);
}

function S(i) {
  return O(i).style;
}

function C(i) {
  return document.getElementByClassName(i);
}

'use strict';

(function ($) {// $('p').each(function(){
  //     var string = $.trim($(this).html());
  //     string = string.replace(/ ([^ ]*) ([^ ]*)$/,'&nbsp;$1&nbsp;$2');
  //     $(this).html(string);
  // });
})(jQuery); // Fully reference jQuery after this point


var sliders = function () {
  var init = function init() {
    $(document).ready(function () {
      if ($('#custom-hero').length) {
        heroSlider();
      }

      if ($('.slidesBlock').length) {
        slidesBlock();
      }

      if ($('#single-product').length) {
        productSlider();
      }

      if ($('.flexSlider').length) {
        flexSlider();
      }
    });
  },
      heroSlider = function heroSlider() {
    $('.slider').each(function (index, sliderWrap) {
      var $carousel = $(this);
      $carousel.slick({
        adaptiveHeight: true
      });
    });
  },
      slidesBlock = function slidesBlock() {
    $('.slidesBlock').each(function (index, sliderWrap) {
      var $carousel = $(this);
      $carousel.slick({
        fade: true,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false
      });
    });
  },
      flexSlider = function flexSlider() {
    var elements = document.querySelectorAll(".flexSlider");

    if (window.innerWidth < sliderBreakpoint) {
      slideInit();
    } else {
      slideUnslick();
    }

    $(window).resize(function (e) {
      if (window.innerWidth < sliderBreakpoint) {
        slideInit();
      } else {
        slideUnslick();
      }
    });

    function slideInit() {
      for (var i = 0; i < elements.length; i++) {
        $(elements[i]).slick({
          autoplay: false,
          arrows: true
        });
        elements[i].style.gridTemplateColumns = "1fr";
      }
    }

    function slideUnslick() {
      if ($('.flexSlider').hasClass('slick-initialized')) {
        for (var i = 0; i < elements.length; i++) {
          elements[i].style.gridTemplateColumns = '';
          $(elements[i]).slick('unslick');
        }
      }
    }
  },
      productSlider = function productSlider() {
    $('.productSliderMain').slick({
      fade: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: false,
      arrows: false // asNavFor: '.productSliderNav',

    });
    var length = $('.productSliderNav img').length;
    console.log(length);
    $('.productSliderNav').slick({
      slidesToShow: length,
      slidesToScroll: 1,
      dots: false,
      vertical: true,
      asNavFor: '.productSliderMain',
      focusOnSelect: true,
      centerMode: true
    });
  };

  init();
  return {};
}();