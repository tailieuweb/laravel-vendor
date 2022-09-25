$('document').ready(function () {
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
});
$('document').ready(function () {
    var swiper = new Swiper('.swiper-container1', {

        slidesPerView: 3,
        spaceBetween: 22,
        slidesPerGroup: 1,
        nextButton: '.swiper-button-next', // tao ra nút next
        prevButton: '.swiper-button-prev', // tao ra nút prev
        loop: true, // lặp lại khi chạy
        breakpointsInverse: true,
        breakpoints: {
            1024: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            991: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            980: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            955: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            880: {
                slidesPerView: 3,
                spaceBetween: 40,
            },
            800: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            780: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,

            },
            740: {
                slidesPerView: 2,
                spaceBetween: 20,

            },
            720: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 10,

            },
            620: {
                slidesPerView: 2,
                spaceBetween: 15,

            },
            600: {
                slidesPerView: 2,
                spaceBetween: 15,

            },
            568: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            563: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            549: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            534: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 15,
            },
            360: {
                slidesPerView: 1,
                spaceBetween: 10,

            },
            338: {
                slidesPerView: 1,
                spaceBetween: 10,

            },
            330: {
                slidesPerView: 1,
                spaceBetween: 10,

            },
            320: {
                slidesPerView: 1,
                spaceBetween: 10,

            }
        }
    });
});

