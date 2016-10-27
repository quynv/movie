/**
 * Created by Nguyen Quy on 3/30/2016.
 */
$(document).on('click', '.rating > input', function(){
    var value = $(this).data('value');
    var object = $('.rating');
    var movie = $(object).data('movie');
    $.ajax({
        url: '/movies/rating',
        data: {value: value, movie: movie},
        dataType: 'json',
        method: 'post',
        success: function(data) {

        },
        error: function(data) {

        }
    })
});