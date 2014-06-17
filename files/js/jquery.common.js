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
            dataType: 'json',
            cache: false,
            beforeSend: function () {
                $.isLoading({
                    text: 'Loading...'
                });
            },
            success: function (data) {
                $.isLoading('hide');
                result.fadeIn().show();

                if (data.img) {
                    $('#logo').attr({
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

    /**
     * submit fattura
     */
    $('#fattura').submit(function () {

        var result = $('#result');

        $.ajax({
            url: '/aggiungi-fattura',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            cache: false,
            beforeSend: function () {
                $.isLoading({
                    text: 'Loading...'
                });
            },
            success: function (data) {
                $.isLoading('hide');

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

    /**
     * submit servizi
     */
    $('#servizi').click(function () {

        var codice = $('#codice').val();
        var descrizione = $('#descrizione').val();
        var quantita = $('#quantita').val();
        var prezzo = $('#prezzo').val();
        var iva = $('#iva').val();
        var inclusa = $('#inclusa').val();
        var id_fattura = $('#id').val();

        $.ajax({
            url: '/aggiungi-servizi',
            type: 'POST',
            data: {
                'codice': codice,
                'descrizione': descrizione,
                'quantita': quantita,
                'prezzo': prezzo,
                'iva': iva,
                'inclusa': inclusa,
                'id_fattura': id_fattura
            },
            dataType: 'json',
            cache: false,
            beforeSend: function () {
                $.isLoading({
                    text: 'Loading...'
                });
            },
            success: function (data) {
                $.isLoading('hide');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $.isLoading('hide');
            }
        });
        return false;
    });


    //...
});