<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
</head>
<body>

<table border="0" style="width: 100%">
    <tr>
        <td><img src="data/logo.jpg" width="300"/></td>
        <td>
            <ul style="list-style: none; text-align: right">
                <li><strong>{$configurazione.ragione_sociale}</strong></li>
                <li>P.IVA {$configurazione.partita_iva}</li>
                <li>Cod. Fisc. {$configurazione.codice_fiscale}</li>
                <li>{$configurazione.indirizzo}</li>
                <li>{$configurazione.cap} {$configurazione.citta} {$configurazione.provincia}</li>
                <li>Tel: {$configurazione.telefono}</li>
                <li>Fax: {$configurazione.fax}</li>
                <li>Email: {$configurazione.email}</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr/>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <ul style="list-style: none; padding: 0">
                <li>Spett.le</li>
                <li><strong>{$clienti.ragione_sociale}</strong></li>
                <li>P.IVA {$clienti.partita_iva}</li>
                <li>Cod. Fisc. {$clienti.codice_fiscale}</li>
                <li>{$clienti.indirizzo}</li>
                <li>{$clienti.cap} {$clienti.citta} {$clienti.provincia}</li>
            </ul>
        </td>
        <td>
            <ul style="list-style: none; text-align: right">
                <li><strong>Fattura n. {$fatture.numero}/{$fatture.anno}</strong></li>
                <li><strong>Data Emissione: {$fatture.emissione}</strong></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <ul style="list-style: none; padding: 0">
                <li><strong>Oggetto: {$fatture.oggetto}</strong></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <table border="0" style="width: 100%; border: 1px solid #000000">
                <thead>
                <tr style="background-color: #999999">
                    <th>CODICE</th>
                    <th>DESCRIZIONE</th>
                    <th>IMP. UN.</th>
                    <th>QTA</th>
                    <th>IMP. TOT.</th>
                    <th>IVA</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$servizi item=row}
                    <tr style="text-align: center; border-top: 1px solid #999999">
                        <td>{$row.codice}</td>
                        <td>{$row.descrizione}</td>
                        <td>€ {$row.prezzo}</td>
                        <td>{$row.quantita}</td>
                        <td>€ {$row.totale}</td>
                        <td>{$row.iva}%</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">{$fatture.note}</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">{$fatture.pagamento}</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">{$configurazione.pie_di_pagina}</td>
    </tr>
</table>
</body>
</html>