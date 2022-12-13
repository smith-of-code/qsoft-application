$(function() {
    $('form').submit(function(e) {
        if ($(this).hasClass('search') && !$(this).find('#q').val().length) {
            e.preventDefault();
            return false;
        }
    });
});