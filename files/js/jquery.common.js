$(document).ready(function () {

    /**
     * delay fade Timeout
     * @type {number}
     */
    var delay = 3000;

    /**
     * filestyle
     */
    $(':file').filestyle();

    /**
     * datepicker
     */
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    /**
     * dataTable
     */
    $('#fatture').dataTable({
        ajax: '/fatture.json',
        columns: [
            { data: 'id' },
            { data: 'numero' },
            { data: 'anno' },
            { data: 'emissione' },
            { data: 'ragione_sociale' },
            { data: 'totale' },
            { data: 'iva' }
        ],
        columnDefs: [
            {
                targets: -7,
                data: 'id',
                render: function (data, type, full) {
                    return '<div class="btn-group">' +
                        '<a href="/modifica-fattura/' + data + '" class="btn btn-default">Modifica</a>' +
                        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">' +
                        '<span class="caret"></span>' +
                        '<span class="sr-only">Toggle Dropdown</span>' +
                        '</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                        '<li><a href="#">Esporta in PDF</a></li>' +
                        '<li class="divider"></li>' +
                        '<li><a href="#">Cancella</a></li>' +
                        '</ul>' +
                        '</div>';
                }
            }
        ]
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
                $('.btn').isLoading();
            },
            success: function (data) {
                $('.btn').isLoading('hide');
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
                }, delay);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('.btn').isLoading('hide');
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
                $('.btn').isLoading();
            },
            success: function (data) {
                $('.btn').isLoading('hide');
                result.fadeIn().show();
                result.append($('<div/>').attr({
                    'class': 'alert alert-' + data.notice + ' alert-dismissable'
                }).append('<div/>').html(data.messages));
                setTimeout(function () {
                    result.fadeOut();
                    $('.alert-dismissable').remove();
                }, delay);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('.btn').isLoading('hide');
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
                codice: codice,
                descrizione: descrizione,
                quantita: quantita,
                prezzo: prezzo,
                iva: iva,
                inclusa: inclusa,
                id_fattura: id_fattura
            },
            dataType: 'json',
            cache: false,
            beforeSend: function () {
                $('.btn').isLoading();
            },
            success: function (data) {
                $('.btn').isLoading('hide');
                $('#myTable').dataTable({
                    'bProcessing': true,
                    'sAjaxSource': '/servizi/' + data.fattura + '.json'
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('.btn').isLoading('hide');
            }
        });
        return false;
    });


    $('#id_cliente').change(function () {

        var id = $(this).val();

        $.ajax({
            url: '/cliente',
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('#ragione_sociale').val(data.ragione_sociale);
                $('#codice_fiscale').val(data.codice_fiscale);
                $('#partita_iva').val(data.partita_iva);
                $('#indirizzo').val(data.indirizzo);
                $('#cap').val(data.cap);
                $('#citta').val(data.citta);
                $('#provincia').val(data.provincia);
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
        return false;
    });

    //...
});