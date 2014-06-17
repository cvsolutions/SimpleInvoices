$(document).ready(function () {

    /**
     * filestyle
     */
    $(':file').filestyle();

    /**
     * datepicker
     */
    $('.datepicker').datepicker()

    /**
     * dataTable
     */
    $('#fatture').dataTable({
        'processing': true,
        'serverSide': true,
        'ajax': "/fatture.json"
    });

    /**
     * submit configurazione
     */
    $('#configurazione').submit(function () {
        var result = $('#result');
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
                $.isLoading('hide');
                result.fadeIn().show();

                if (data.img) {
                    $('.img-thumbnail').attr({
                        'src': data.img
                    });
                }

                result.append($('<div/>').attr({
                    'class': 'alert alert-' + data.notice + ' alert-dismissable'
                }).append('<div/>').html(data.messages));
                setTimeout(function () {
                    result.fadeOut();
                    $('.alert-dismissable').remove();
                }, 3000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.isLoading('hide');
                result.fadeIn().show();
                result.append($('<div/>').attr({
                    'class': 'alert alert-danger alert-dismissable'
                }).append('<div/>').html(thrownError));
            }
        });
        return false;
    });
});