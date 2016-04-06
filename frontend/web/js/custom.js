/* Write here your custom javascript codes */
$(document).ready(function(){
    $('.rating').each(function(){
        var value = $(this).data('rating');
        if(value) {
            $('#stars-rating-'+value).prop('checked', true);
        }

        var movie = $(this).data('movie');
        if(movie) {
            $('#stars-rating-'+value+'-'+movie).prop('checked', true);
        }
    });
});



$(document).on('click', '.rating > input', function(){
    var value = $(this).data('value');
    var object = $(this).parents('.rating');
    var movie = $(object).data('movie');

    $.ajax({
        url: '/movies/rating',
        data: {value: value, movie: movie},
        dataType: 'json',
        method: 'post',
        success: function(data) {
            if(data['required']['is_required'] == true)
            {
                if(data['required']['remain'] == 1)
                    $('#rating-modal').find('.modal-title').html('Please rating '+ data['required']['remain'] + ' movie');
                else $('#rating-modal').find('.modal-title').html('Please rating '+ data['required']['remain'] + ' movies');
            }
            else
            {
                if($('#rating-modal').length){
                    location.reload();
                }
            }
        },
        error: function(data) {

        }
    })
});