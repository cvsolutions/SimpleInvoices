$(document).ready(function () {

    $(':file').filestyle();

    $('.datepicker').datepicker()

    $('#fatture').dataTable({
        'processing': true,
        'serverSide': true,
        'ajax': "/fatture.json"
    });

    $('#my-form').submit(function (event) {
        $.ajax({
            url: '/configurazione',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                $.isLoading({
                    text: 'Loading...'
                });
            },
            success: function (data) {
                // alert('ok');
                $.isLoading('hide');
            }
        });
        return false;
    });
});