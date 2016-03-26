/* Write here your custom javascript codes */
$(document).ready(function(){
    $('.tooltips-image').tooltip({html: true});
    var value = $('.rating').data('rating');
    if(value) {
        $('#stars-rating-'+value).prop('checked', true);
    }
});

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