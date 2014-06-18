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
                inclusa: inclusa,
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
                                return '<div class="btn-group">' +
                                    '<a href="#" class="btn btn-default btn-xs">' + data + '</a>' +
                                    '<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">' +
                                    '<span class="caret"></span>' +
                                    '<span class="sr-only">Toggle Dropdown</span>' +
                                    '</button>' +
                                    '<ul class="dropdown-menu" role="menu">' +
                                    '<li><a href="#">Modifica</a></li>' +
                                    '<li><a href="javascript:void(0)" id="cancella_servizio" data-fattura="' + row.id + '">Cancella</a></li>' +
                                    '</ul>' +
                                    '</div>';
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
     * change Ragione Sociale
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
     * change Aggiungi Servizio
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
                $('#inclusa').val(data.inclusa);
                $('#iva').val(data.iva);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
        return false;
    });

    /**
     * click Cancella Servizio
     */
    $('#cancella_servizio').click(function () {

        var fattura = $(this).data('fattura');
        alert(fattura);


    });


    //...
});