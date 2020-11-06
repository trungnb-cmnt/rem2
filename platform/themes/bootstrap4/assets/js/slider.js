import './owl.carousel.min';

// :: 4.0 Sliders Active Code
if ($.fn.owlCarousel) {

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
}

