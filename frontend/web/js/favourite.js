/**
 * Created by Nguyen Quy on 3/25/2016.
 */

$(".heart_icon").on("click", function(){
    var movie = $(this).data('movie');
    var value = $(this).data('value');
    var object = $(this);
    $.ajax({
        url: '/movies/favourite',
        data: {movie: movie, value: value},
        dataType: 'json',
        method: 'post',
        success: function(data) {
            if(data.success == true) {
                if(value == 1) {
                    $(object).attr('data-original-title', 'In favourite');
                    $(object).data('value', 0);
                    $(object).removeClass("off").addClass("on heartAnimation");
                }
                else
                {
                    $(object).attr('data-original-title', 'Add to favourite');
                    $(object).data('value', 1);
                    $(object).removeClass("on heartAnimation").addClass("off");
                }
            }
            $('.num_vote').html(data.count);
        },
        error: function(data) {

        }
    });

});