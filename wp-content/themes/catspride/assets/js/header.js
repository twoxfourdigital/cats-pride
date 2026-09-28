import global from '../components/global';

$(function() {

    $(".search-open").on('click', function () {
        $('.search-popup').addClass('search-opened');
        global.$dom.body.addClass('overflowHidden');

    });

    $(".search-close").on('click', function () {
        $('.search-popup').removeClass('search-opened');
        global.$dom.body.removeClass('overflowHidden');

    });

});