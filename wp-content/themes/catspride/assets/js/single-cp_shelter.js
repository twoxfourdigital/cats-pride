require('slick-carousel');

$(function() {
    console.log('slider');
    $(".shelter-slider").slick({
        slidesToScroll: 1,
        slidesToShow: 1,
        centerPadding: 100,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 5000,
        prevArrow: '<button class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
        nextArrow: '<button class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>'
    });

});