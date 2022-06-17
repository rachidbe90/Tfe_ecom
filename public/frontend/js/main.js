
'use strict';

(function ($) {

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*================================
    Sticky Navbar
    ==================================*/
    window.onscroll = function(){
        stickyNavbar();
    }

    var header = document.getElementById("header");
    var header_top = document.getElementsByClassName("header__top");
    var sticky = header.offsetTop;

    function stickyNavbar(){
        if(window.pageYOffset >= sticky){
            header.classList.add("sticky");
        }else{
            header.classList.remove("sticky");
        }
    }

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

     // hero Slider Carousel
     $(document).ready(function(){
        $(".owl-carousel").owlCarousel();
    });


    $(".hero-slider").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 0,
        mouseDrag: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    // Discounted Categories Carousel
    $(".discounted-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });



     /*-----------------------
        Products Slider
    ------------------------*/


    $(".product-slider").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            },
            1600:{
                items: 6
            },
            2000:{
                items: 8
            }
        }
    });


    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:6
            },
            2000:{
                items: 8
            }
        }
    });



    $('.all__categories__wrapper').on('hover', function(){
        $('.all__categories__wrapper ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:6
            },
            2000:{
                items: 8
            }
        }
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

      /*-----------------------------
        Featured Product Slider
    -------------------------------*/
    $(".featured-product__slider").owlCarousel({
        loop: true,
        autoplay: true,
        smartSpeed: 500,
        dots: false,
        nav: true,
        margin: 10,
        mouseDrag: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:6
            },
            2000:{
                items: 8
            }
        }
    });



    /*---------------------------------
        Product Details Image Slider
    ----------------------------------*/
    $(".product__details__images__slider").owlCarousel({
        loop: true,
        items: 6,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });


    /*------------------
        Product Details- Single Product
    --------------------*/
    $('.product__details__images__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__images__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__images__item--large').attr({
                src: imgurl
            });
        }
    });


    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

    // Set the date we're counting down to
    var countDownDate = new Date("Dec 30, 2021 11:34").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("days").innerHTML = days;
    document.getElementById("hours").innerHTML = hours;
    document.getElementById("minutes").innerHTML = minutes;



    // If the count down is over, write some text
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);



    /*================Form Validation=====================*/
    var input = $('.validate-input .input');


    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input').each(function(){
        $(this).focus(function(){
        hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }

        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }



    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }


})(jQuery);
