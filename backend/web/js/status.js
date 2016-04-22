/**
 * Created by Nguyen Quy on 4/22/2016.
 */
$('.change-status').change(function(){

    var user = $(this).data('user');
    var status = $(this).val();
    if(status) {
        var r = confirm("Are you sure?");
        if (r != true) return;
        $.ajax({
            url: '/users/change_status',
            data: {status: status, id: user},
            dataType: 'json',
            method: 'post',
            success: function(data)
            {
                if(data.success == false)
                {
                    alert("An error occurred while trying to update the record.");
                }
            },
            error: function(data)
            {
                alert("An error occurred while trying to update the record.");
            }

        });
    }
});