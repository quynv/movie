/**
 * Created by Nguyen Quy on 3/25/2016.
 */

$('.change-avatar').change(function() {
    var id = $(this).attr('value');
    var object = $(this);
    if (this.checked) {
        $.ajax({
            url: '/settings/select_avatar',
            data: {id: id},
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data.success == false) {
                    $(object).prop('checked', false);
                }
            },
            error: function () {
                $(object).prop('checked', false);
            }
        });
    }
});