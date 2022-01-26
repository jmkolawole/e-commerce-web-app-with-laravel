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
        loop: false,
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
                items: 4
            }
        }
    })


    $('.pro-active-loop').owlCarousel({
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
                items: 4
            }
        }
    });







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
        loop: false,
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




function addToCart(clicked) {

    var pro_id = clicked;
    var quantity = $('#quantity'+clicked).val();
    var price = $('#price'+clicked).val();
    var product_name = $('#product_name'+clicked).val();
    var product_code = $('#product_code'+clicked).val();
    var type_select = $('#type-select'+clicked).val();



    var arr = type_select.split('#');
    var type = arr[1];
    var attrId = arr[2];



    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/cart/addItem/"+pro_id,
        data: {quantity:quantity,price:price,product_name:product_name,product_code:product_code,type:type,attrId:attrId},
        success:function (resp) {
            if(resp == "Saved"){
                swal('Success!',"Item Successfully Added To Cart",'success');

            }else if(resp == "Not Available"){
                swal('Error!',"The Requested Quantity Is Not Available. Please Reduce The Quantity",'error');

            }else if(resp == "Exist"){
                swal('Error!',"This Product Already Exist In Your Cart. Please Increase The Quantity In Your Cart",'error');
                $("#add-to-cart"+clicked).hide();
            }else if(resp == "Status"){
                swal('Error!',"This Product Is No Longer Available Or It Has Been Disabled",'error');
            }
            loadCartData();
        }
    });



}

function getProductType(clicked) {



    var id = document.getElementById("type-select"+clicked);
    var item = id.options[id.selectedIndex].value;


    if(item == "0#none"){
        return false;
    }
     
    
    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/get-product-type",
        data: {idSize:item},
        success:function (resp) {


            var arr = resp.split('#');
            var stock = arr[0];
            var type = arr[1];
            var button = arr[2];




            if(stock == 0){

                $("#in-stock"+clicked).show().text("Out of Stock").css("font-weight","bold").css("color","red");
                $("#add-to-cart"+clicked).hide();


            }else {

                $("#in-stock"+clicked).show().text("In Stock").css("font-weight","bold").css("color","black");
                $("#add-to-cart"+clicked).html(button);
                $("#add-to-cart"+clicked).show();

            }

        },error:function(){
            alert('Please Select A Product Type Or Shade');
        }
    });




}


function loadCartData() {
    $.ajax({
        url:"https://alvins-ecommerce.herokuapp.com/fetch-cart",
        method:"POST",
        success:function(data)
        {

            $("#shopping-cart").html(data);

            //$('#shopping_cart').html(data);
        }
    });

}


function addToWishlist(clicked) {


    var pro_id = clicked;
    var price = $('#price'+clicked).val();
    var product_name = $('#product_name'+clicked).val();
    var product_code = $('#product_code'+clicked).val();
    var type_select = $('#type-select'+clicked).val();



    var arr = type_select.split('#');
    var type = arr[1];
    var attrId = arr[2];



    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/wishlist/addItem/"+pro_id,
        data: {price:price,product_name:product_name,product_code:product_code,type:type,attrId:attrId},
        success:function (resp) {
            if (resp == "Saved") {
                swal('Success!', "Item Successfully Added To Wishlist", 'success');

            }else if(resp == "Exist"){
                swal('Error!',"The Item Already Exist In Your Wishlist",'error');
            }else if(resp == "Cart"){
                swal('Error!',"Item Already Exist In Your Wishlist",'error');
            }else if(resp == "Type"){
                swal('Error!',"Please Select A Product Type To Add To Wishlist",'error');
            }
        }
    });


}




function addToCompare(clicked) {

    var pro_id = clicked;
    var price = $('#price'+clicked).val();
    var product_name = $('#product_name'+clicked).val();
    var product_code = $('#product_code'+clicked).val();
    var type_select = $('#type-select'+clicked).val();



    var arr = type_select.split('#');
    var type = arr[1];
    var attrId = arr[2];




    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/compare/addItem/"+pro_id,
        data: {price:price,product_name:product_name,product_code:product_code,type:type,attrId:attrId},
        success:function (resp) {
            if (resp == "Saved") {
                swal('Success!', "Item Successfully Added To Compare Selection", 'success');
            }else if(resp == "Exist"){
                swal('Error!',"The Item Already Exist In Your Compare Selection",'error');
            }
            else if(resp == "Max"){
                swal('Error!',"You Can Only Compare Three (3) Items At Once",'error');
            }else if(resp == "Type"){
                swal('Error!',"Please Select A Product Type To Compare",'error');
            }
        }
    });


}


function wishToCart(clicked, attr) {
    var pro_id = clicked;
    var quantity = 1;
    var price = $('#price'+clicked).val();
    var product_name = $('#product_name'+clicked).val();
    var product_code = $('#product_code'+clicked).val();
    var product_attr = $('#product_attr'+clicked+attr).val();


    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/wishToCart/"+pro_id,
        data: {quantity:quantity,price:price,product_name:product_name,product_code:product_code,attrId:product_attr},
        success:function (resp) {
            if(resp == "Saved"){
                swal('Success!',"Item Successfully Added To Cart",'success');
            }
            else if(resp == "Not Available"){
                swal('Error!',"The Requested Item Is Not Yet Available",'error');

            }else if(resp == "Exist"){
                swal('Error!',"This Product Already Exist In Your Cart. Please Increase The Quantity In Your Cart",'error');
            }
            loadCartData();
        }
    });

}


function compareToCart(clicked,attr) {
    var pro_id = clicked;
    var quantity = 1;
    var price = $('#price'+clicked).val();
    var product_name = $('#product_name'+clicked).val();
    var product_code = $('#product_code'+clicked).val();
    var product_attr = $('#product_attr'+clicked+attr).val();


    //alert(product_attr);
    $.ajax({
        type:'get',
        url: "https://alvins-ecommerce.herokuapp.com/compareToCart/"+pro_id,
        data: {quantity:quantity,price:price,product_name:product_name,product_code:product_code,attrId:product_attr},
        success:function (resp) {
            if(resp == "Saved"){
                swal('Success!',"Item Successfully Added To Cart",'success');

            }
            else if(resp == "Not Available"){
                swal('Error!',"The Requested Item Is Not Yet Available Or Product Is Out Of Stock",'error');

            }else if(resp == "Exist"){
                swal('Error!',"This Product Already Exist In Your Cart. Please Increase The Quantity In Your Cart",'error');
            }
            loadCartData();
        }
    });

}

function deleteCompare(id,clicked,attr) {
    var pro_id = id;
    swal({
        title: "Are you sure?",
        text: "Are You Sure You Want To Delete This Item From Your Compare Selection?",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],

        dangerMode: true,
    }).then(function (e) {
        if(e){
            $.ajax({
                type:'get',
                url: "https://alvins-ecommerce.herokuapp.com/deleteCompare/"+pro_id,
                success:function (resp) {
                    if (resp == "deleted") {
                        $('.item_'+clicked+'_'+attr).hide();
                        swal('Success!',"Item Successfully Removed From Compare Selection",'success');
                    }
                }
            });
        }else{
            swal('Item Still In Your Compare Selection');
        }


    })

}



function deleteList(clicked) {
    var pro_id = clicked;

    swal({
        title: "Are you sure?",
        text: "Are You Sure You Want To Delete This Item From Wishlist?",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],

        dangerMode: true,
    }).then(function (e) {
        if(e){
            $.ajax({
                type:'get',

                url: "https://alvins-ecommerce.herokuapp.com/deleteWish/"+pro_id,

                success:function (resp) {

                    if (resp == "deleted") {

                        $('.delete'+clicked).hide();

                        swal('Success!',"Item Successfully Removed From Wishlist",'success');
                    }

                }


            });
        }else{
            swal('Item Still In Your Wishlist');
        }

    })


}



function removeItem(clicked){
    swal({
        title: "Are you sure?",
        text: "Are You Sure You Want To Delete This Item From Cart?",
        icon: "warning",
        buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
        ],

        dangerMode: true,
    }).then(function (e) {
        if(e){
            document.getElementById('myForm'+clicked).submit();
        }else{
            swal('Item Still In Cart');
        }

    })

}