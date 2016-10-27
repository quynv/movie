/**
 * Created by Nguyen Quy on 4/7/2016.
 */

$('.request-checkbox').change(function(){
    var user = $(this).data('value');
    var movie = $(this).data('movie');
    var object = $(this);
    if(this.checked) {
        $.ajax({
            url: '/requests/check',
            data: {id: user, movie: movie},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if(data.success == false)
                {
                    $(object).prop('checked',false);
                }
            },
            error: function() {
                $(object).prop('checked',false);
            }
        });
    }else{
        $.ajax({
            url: '/requests/uncheck',
            data: {id: user, movie: movie},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if(data.success == false)
                {
                    $(object).prop('checked',true);
                }
            },
            error: function() {
                $(object).prop('checked',true);
            }
        });
    }
});