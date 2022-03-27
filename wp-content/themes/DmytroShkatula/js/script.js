$('.swiper-wrapper').slick({
    centerMode: true,
    variableWidth: true,
    centerPadding: '60px',
    slidesToShow: 1,
    prevArrow: $(".prev"),
    nextArrow: $(".next"),
    infinite: false,
    lazyLoad: 'progressive',
});
function setProgress(index) {
    const calc = ((index + 1) / ($slider.slick('getSlick').slideCount)) * 100;

    $progressBar
        .css('background-size', `${calc}% 100%`)
        .attr('aria-valuenow', calc);
}

const $slider = $('.swiper-wrapper');
const $progressBar = $('.progress');

$slider.find('.swiper-slide:nth-child(2)').addClass('next');

$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    setProgress(nextSlide);

    $('.swiper-slide').removeClass('next');

    $slider.find('.swiper-slide:nth-child('+(nextSlide + 2)+')').addClass('next');
});

setProgress(0);


