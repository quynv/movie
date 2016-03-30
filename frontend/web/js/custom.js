/* Write here your custom javascript codes */
$(document).ready(function(){
    var value = $('.rating').data('rating');
    if(value) {
        $('#stars-rating-'+value).prop('checked', true);
    }
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
                location.reload();
            }
        },
        error: function(data) {

        }
    })
});