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
            success: function () {
                $.isLoading('hide');
                $('#result').fadeIn().show();
                $('#result').append($('<div/>').attr({
                    'class': 'alert alert-success alert-dismissable'
                }).append('<div/>').html('Operazione eseguita con successo!'));
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.isLoading('hide');
                $('#result').fadeIn().show();
                $('#result').append($('<div/>').attr({
                    'class': 'alert alert-danger alert-dismissable'
                }).append('<div/>').html(thrownError));
            }
        });
        return false;
    });
});