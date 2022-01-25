/*--------------------------------------------------
 Template Name: Makali;
 Description: Cosmetics and Beauty eCommerce Bootstrap 4 Template;
 Version: 1.0;

 NOTE: main.js, All custom script and plugin activation script in this file.
 -----------------------------------------------------

 JS INDEX
 ================================================
 1. Newsletter Popup
 2. Mobile Menu Activation
 3. Tooltip Activation
 4. Checkout Page Activation
 5. Slider Activation
 6. Our Product Activation
 7. Blog Activation
 8. daily-deal-active Activation
 9. single deal Activation
 10. Tripple Pro Activation
 11. daily-deal-active Activation
 12. Categorie Products Activation
 13. Thumbnail Product activation
 14. Testmonial Activation
 15. Recent Post Activation
 16. Categorie Slider Activation
 17. Countdown Js Activation
 18. ScrollUp Activation
 19. Sticky-Menu Activation
 20. Nice Select Activation
 21. Price Slider Activation
 22. Brand Logo  Activation

 ================================================*/

(function ($) {
    "use Strict";

    /*--------------------------
     1. Newsletter Popup
     ---------------------------*/
    setTimeout(function () {
        $('.popup_wrapper').css({
            "opacity": "1",
            "visibility": "visible"
        });
        $('.popup_off').on('click', function () {
            $(".popup_wrapper").fadeOut(500);
        })
    }, 4000);

    /*----------------------------
     2. Mobile Menu Activation
     -----------------------------*/
    jQuery('.mobile-menu nav').meanmenu({
        meanScreenWidth: "991",
    });

    /*----------------------------
     3. Tooltip Activation
     ------------------------------ */
    $('.pro-actions a').tooltip({
        animated: 'fade',
        placement: 'top',
        container: 'body'
    });

    /*----------------------------
     4. Checkout Page Activation
     -----------------------------*/
    $('#showlogin').on('click', function () {
        $('#checkout-login').slideToggle();
    });
    $('#showcoupon').on('click', function () {
        $('#checkout_coupon').slideToggle();
    });
    $('#cbox').on('click', function () {
        $('#cbox_info').slideToggle();
    });
    $('#ship-box').on('click', function () {
        $('#ship-box-info').slideToggle();
    });

    /*----------------------------
     5. Slider Activation
     -----------------------------*/
    $(".slider-activate").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        autoplay: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items: 1,
        autoplayTimeout: 10000,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: true,
        autoHeight: true,
        lazyLoad: true,
    });

    /*----------------------------------------------------
     6. Our Product Activation
     -----------------------------------------------------*/
    $('.our-pro-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 1
            }
        }
    })

    /*-------------------------------
     7. Blog Activation
     ---------------------------------*/
    $('.blog-activation').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        smartSpeed: 700,
        margin: 30,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    })

    /*----------------------------------------------------
     8. daily-deal-active Activation
     -----------------------------------------------------*/
    $('.daily-deal-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        }
    })

    /*----------------------------------------------------
     9. single deal Activation
     -----------------------------------------------------*/
    $('.single-deal-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1000,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        items:1,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            576: {
                items: 2
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    })

    /*----------------------------------------------------
     10. Tripple Pro Activation
     -----------------------------------------------------*/
    $('.tripple-pro-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    })

    /*----------------------------------------------------
     11. daily-deal-active Activation
     -----------------------------------------------------*/
    $('.arrival-pro-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            480: {
                items: 2
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        }
    })

    /*----------------------------------------------------
     12. Categorie Products Activation
     -----------------------------------------------------*/
    $('.categorie-pro-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    })

    /*-------------------------------------
     13. Thumbnail Product activation
     --------------------------------------*/
    $('.thumb-menu').owlCarousel({
        loop: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 15,
        smartSpeed: 500,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 3,
                autoplay: true,
            },
            768: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    })
    $('.thumb-menu a').on('click', function () {
        $('.thumb-menu a').removeClass('active');
    })

    /*----------------------------
     14. Testmonial Activation
     -----------------------------*/
    $(".testmonial-active").owlCarousel({
        loop: true,
        margin: 0,
        smartSpeed: 500,
        nav: false,
        autoplay: false,
        items: 1,
        dots: true,
    });

    /*----------------------------
     15. Recent Post Activation
     -----------------------------*/
    $(".recent-post-active").owlCarousel({
        loop: true,
        margin: 0,
        smartSpeed: 500,
        nav: false,
        autoplay: false,
        items: 1,
        dots: false,
    });

    /*----------------------------------------------------
     16. Categorie Slider Activation
     -----------------------------------------------------*/
    $('.categorie-slider-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    })

    /*----------------------------
     17. Countdown Js Activation
     -----------------------------*/
    $('[data-countdown]').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<div class="count"><p>%D</p><span>Days</span></div><div class="count"><p>%H</p> <span>Hours</span></div><div class="count"><p>%M</p> <span>Mins</span></div><div class="count"> <p>%S</p> <span>Secs</span></div>'));
        });
    });

    /*----------------------------
     18. ScrollUp Activation
     -----------------------------*/
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '550', // Distance from top before showing element (px)
        topSpeed: 1000, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        scrollSpeed: 900,
        animationInSpeed: 1000, // Animation in speed (ms)
        animationOutSpeed: 1000, // Animation out speed (ms)
        scrollText: '<i class="fa fa-angle-double-up" aria-hidden="true"></i>', // Text for element
        activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });

    /*----------------------------
     19. Sticky-Menu Activation
     ------------------------------ */
    $(window).on('scroll',function() {
        if ($(this).scrollTop() > 50) {
            $('.header-sticky').addClass("sticky");
        } else {
            $('.header-sticky').removeClass("sticky");
        }
    });

    /*----------------------------
     20. Nice Select Activation
     ------------------------------ */
    $('select').niceSelect();

    /*----------------------------
     21. Price Slider Activation
     -----------------------------*/
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 100,
        values: [0, 85],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + "  $" + ui.values[1]);
        }
    });
    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
        "  $" + $("#slider-range").slider("values", 1));

    /*----------------------------------------------------
     22. Brand Logo  Activation
     -----------------------------------------------------*/
    $('.brand-logo-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 300
            },
            340: {
                items: 2
            },
            480: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    })

})(jQuery);