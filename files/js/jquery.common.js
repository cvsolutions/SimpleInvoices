$(document).ready(function () {

    /**
     * delay fade Timeout
     * @type {number}
     */
    var delay = 3000;

    /**
     * id fattura
     * @type {*|jQuery}
     */
    var id_fattura = $('#id').val();

    /**
     * filestyle
     */
    $(':file').filestyle();

    /**
     * datepicker
     */
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
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
                render: function (data, type, row) {
                    return '<div class="btn-group">' +
                        '<a href="/modifica-fattura/' + data + '" class="btn btn-default">Modifica</a>' +
                        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">' +
                        '<span class="caret"></span>' +
                        '<span class="sr-only">Toggle Dropdown</span>' +
                        '</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                        '<li><a href="/pdf/' + row.id + '.pdf"><span class="glyphicon glyphicon-download-alt"></span> Esporta in PDF</a></li>' +
                        '<li class="divider"></li>' +
                        '<li><a href="/elimina-fattura/' + row.id + '"><span class="glyphicon glyphicon-trash"></span> Cancella</a></li>' +
                        '</ul>' +
                        '</div>';
                }
            }
        ]
    });

    /**
     * Submit Configurazione
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
     * Submit Aggiungi Fattura
     */
    $('#aggiungi_fattura').submit(function () {

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
     * Submit Servizi
     */
    $('#servizi').click(function () {

        var codice = $('#codice').val();
        var descrizione = $('#descrizione').val();
        var quantita = $('#quantita').val();
        var prezzo = $('#prezzo').val();
        var iva = $('#iva').val();
        var id_fattura = $('#id').val();
        var id_servizio = $('#id_servizio').val();

        $.ajax({
            url: '/aggiungi-servizi',
            type: 'POST',
            data: {
                codice: codice,
                descrizione: descrizione,
                quantita: quantita,
                prezzo: prezzo,
                iva: iva,
                inclusa: $('#inclusa').is(':checked') ? 1 : 0,
                id_fattura: id_fattura,
                id_servizio: id_servizio
            },
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('.btn').attr('disabled', false);
                $("#lista-servizi").dataTable().fnDestroy();
                $('#lista-servizi').dataTable({
                    ajax: '/servizi/' + data.fattura + '.json',
                    aLengthMenu: [
                        [3, 2, 1],
                        [3, 2, 1]
                    ],
                    columns: [
                        { data: 'codice' },
                        { data: 'descrizione' },
                        { data: 'prezzo' },
                        { data: 'quantita' },
                        { data: 'totale' },
                        { data: 'iva' }
                    ],
                    columnDefs: [
                        {
                            targets: -6,
                            data: 'codice',
                            render: function (data, type, row) {
                                return '<a href="/modifica-servizi/' + row.id + '" class="btn btn-default btn-xs open-box" data-fancybox-type="iframe">' + data + '</a>';
                            }
                        }
                    ]
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
        return false;
    });

    /**
     * Change Ragione Sociale
     */
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
                alert(thrownError);
            }
        });
        return false;
    });

    /**
     * Change Servizio
     */
    $('#id_servizio').change(function () {

        var id = $(this).val();

        $.ajax({
            url: '/servizio',
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            cache: false,
            success: function (data) {
                $('#codice').val(data.codice);
                $('#descrizione').val(data.descrizione);
                $('#quantita').val(data.quantita);
                $('#prezzo').val(data.prezzo);

                if (data.inclusa == 1) {
                    $('#inclusa').attr('checked', true);
                } else {
                    $('#inclusa').attr('checked', false);
                }

                $('#iva').val(data.iva);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
        return false;
    });

    /**
     * dataTable
     * Tutti i servizi della Fattura
     */
    $('#lista-servizi').dataTable({
        ajax: '/servizi/' + id_fattura + '.json',
        aLengthMenu: [
            [3, 2, 1],
            [3, 2, 1]
        ],
        columns: [
            { data: 'codice' },
            { data: 'descrizione' },
            { data: 'prezzo' },
            { data: 'quantita' },
            { data: 'totale' },
            { data: 'iva' }
        ],
        columnDefs: [
            {
                targets: -6,
                data: 'codice',
                render: function (data, type, row) {
                    return '<a href="/modifica-servizi/' + row.id + '" class="btn btn-default btn-xs open-box" data-fancybox-type="iframe">' + data + '</a>';
                }
            }
        ]
    });

    /**
     * Submit Modifica Fattura
     */
    $('#modifica_fattura').submit(function () {

        var result = $('#result');
        var id_fattura = $('#id').val();

        $.ajax({
            url: '/modifica-fattura/' + id_fattura,
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
     * fancybox
     */
    $('.open-box').fancybox({
        maxWidth: 800,
        maxHeight: 600,
        fitToView: false,
        width: '70%',
        height: '70%',
        autoSize: false,
        closeClick: false,
        openEffect: 'none',
        closeEffect: 'none'
    });

    //...
});