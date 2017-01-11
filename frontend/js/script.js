$(function(){
    $(document).ready(function(){
        $('.switcher').on('click', function() {
            var element = $('.' + $(this).attr('id'));
            if (element.hasClass('hidden')) {
                element.removeClass('hidden');
            } else {
                element.addClass('hidden');
            }
        })
    });
})