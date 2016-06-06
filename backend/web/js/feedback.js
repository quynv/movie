/**
 * Created by Nguyen Quy on 4/22/2016.
 */
$('.change-status').change(function(){
    var feedback = $(this).data('feedback');
    var status = $(this).val();
    if(status) {
        var r = confirm("Are you sure?");
        if (r != true) return;
        $.ajax({
            url: '/feedback/change_status',
            data: {id: feedback, status: status},
            dataType: 'json',
            method: 'post',
            success: function(data)
            {
                if(data.success == false)
                {
                    alert("An error occurred while trying to update the record.");
                }
                if(status == 2)
                {

                }
            },
            error: function(data)
            {
                alert("An error occurred while trying to update the record.");
            }

        });
    }
});

$('#sendmailmodal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);
    modal.find('.modal-title').text('New message to ' + recipient);
    modal.find('.modal-body .recipient').val(recipient);
});