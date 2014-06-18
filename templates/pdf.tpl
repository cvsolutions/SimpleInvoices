<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <link rel="stylesheet" href="/files/css/bootstrap.css">
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-xs-6">
            <img src="/data/logo.jpg" class="" alt=""/>
        </div>
        <div class="col-xs-6">
            <ul class="list-unstyled text-right">
                <li><strong>{$configurazione.ragione_sociale}</strong></li>
                <li>P.IVA {$configurazione.partita_iva}</li>
                <li>Cod. Fisc. {$configurazione.codice_fiscale}</li>
                <li>{$configurazione.indirizzo}</li>
                <li>{$configurazione.cap} {$configurazione.citta} {$configurazione.provincia}</li>
                <li>Tel: {$configurazione.telefono}</li>
                <li>Fax: {$configurazione.fax}</li>
                <li>Email: {$configurazione.email}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <ul class="list-unstyled">
                <li><strong>pippo srl</strong></li>
                <li>P.IVA 2</li>
                <li>Cod. Fisc. 1</li>
                <li>3</li>
                <li>4 5 6</li>
            </ul>
        </div>
        <div class="col-xs-6">
            <ul class="list-unstyled text-right">
                <li><strong>Fattura n. 1/2014</strong></li>
                <li><strong>Data Emissione: 18-06-2014</strong></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p><strong>Oggetto: test</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>CODICE</th>
                    <th>DESCRIZIONE</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>01</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <p>&nbsp;</p>
        </div>
    </div>

</div>
</body>
</html>