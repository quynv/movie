/**
 * Created by Nguyen Quy on 4/22/2016.
 */
$('.change-role').change(function(){
    var user = $(this).data('user');
    var role = $(this).val();
    if(role) {
        var r = confirm("Are you sure?");
        if (r != true) return;
        $.ajax({
            url: '/admins/change_role',
            data: {role: role, id: user},
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