/**
 * Created by Nguyen Quy on 4/6/2016.
 */
$(".follow-btn").change(function() {
    var user = $(this).data('user');
    var object = $(this);
    if(this.checked) {
        $.ajax({
            url: '/follow/follow',
            data: {id: user},
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
            url: '/follow/unfollow',
            data: {id: user},
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