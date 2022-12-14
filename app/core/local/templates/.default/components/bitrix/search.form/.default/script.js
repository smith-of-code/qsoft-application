$(function() {
    $('form').submit(function(e) {
        if ($(this).find('#q').length && !$(this).find('#q').val().length) {
            e.preventDefault();
            return false;
        }
    });
});