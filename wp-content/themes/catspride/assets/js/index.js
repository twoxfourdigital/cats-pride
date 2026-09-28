import '../components/filter';

$(function () {


    $('input[type="checkbox"]').each(function () {
        if ($(this).prop('checked')) {
            $(this).closest('.post-filters__term').addClass('filter-active');
        }
    });


    $('input[type="checkbox"]').click(function () {
        if ($(this).prop('checked')) {
            $(this).closest('.post-filters__term').addClass('filter-active');
        } else {
            $(this).closest('.post-filters__term').removeClass('filter-active');
        }
    });

});