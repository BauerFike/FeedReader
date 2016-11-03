/**
 * Created by luca on 2/11/2016.
 */
jQuery(document).ready(function() {
    var page = 2;
    var loading = false;

    $(window).scroll(function () {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10 && !loading) {
            loading = true;
            $.ajax({
                url: window.location.pathname+'?ajax=1&page='+page,
                dataType: 'html',
                // 	data: {param1: 'value1'}
            })
            .done(function(data) {
                loading = false;
                page+=1;
                $('.content').append(data);
            });
        }
    });
});

