// :: 4.0 Sliders Active Code
if ($.fn.owlCarousel) {

    console.log('hix');

    var welcomeSlides = $('.hero-area');

    welcomeSlides.owlCarousel({
        items: 1,
        margin: 0,
        loop: true,
        nav: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000
    });

    var productSlides = $('.products-area');

    productSlides.owlCarousel({
        loop: true,
        nav: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        margin: 10,
        responsiveClass:true,
        responsive: {
            0 : {
                items: 1
            },
            // breakpoint from 480 up
            480 : {
                items: 2
            },
            // breakpoint from 768 up
            768 : {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
}
