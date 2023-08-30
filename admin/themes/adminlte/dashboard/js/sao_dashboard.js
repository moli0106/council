$(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
        type: 'default',
        width: 'auto',
        fit: true,
        closed: 'accordion',
        activate: function(event) {
            var $tab = $(this);
            $name.text($tab.text());
            $info.show();
        }
    });
  
    var owl = $('.owlthumb');
    owl.owlCarousel({
        loop: false,
        margin: 10,
        autoplay: true,
        autoplayHoverPause:true,
        autoplayTimeout: 4000,
        navRewind: false,
        nav: true,
        dots: false,
        navText: ["<div class='nav-btn prev-slide'><i class='fa fa-angle-left'></i></div>", "<div class='nav-btn next-slide'><i class='fa fa-angle-right'></i></div>"],
        responsive: {
            0: {items: 1},
            600: {items: 3},
            1000: {items: 4}
        }
    });
});