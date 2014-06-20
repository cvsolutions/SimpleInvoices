<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
</head>
<body>

<table border="0" style="width: 100%;">
    <tr>
        <td><img src="{$SERVER_NAME}data/logo.jpg" width="300"/></td>
        <td>
            <ul style="list-style: none; text-align: right;">
                <li><strong>{$configurazione.ragione_sociale}</strong></li>
                <li>P.IVA {$configurazione.partita_iva}</li>
                <li>Cod. Fisc. {$configurazione.codice_fiscale}</li>
                <li>{$configurazione.indirizzo}</li>
                <li>{$configurazione.cap} {$configurazione.citta} {$configurazione.provincia}</li>
                <li>Tel: {$configurazione.telefono}</li>
                {if $configurazione.fax neq ""}
                    <li>Fax: {$configurazione.fax}</li>
                {/if}
                <li>Email: {$configurazione.email}</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td style="border-top: 1px solid #000000;" colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td>
            <ul style="list-style: none; padding: 0;">
                <li>Spett.le</li>
                <li><strong>{$clienti.ragione_sociale}</strong></li>
                <li>P.IVA {$clienti.partita_iva}</li>
                <li>Cod. Fisc. {$clienti.codice_fiscale}</li>
                <li>{$clienti.indirizzo}</li>
                <li>{$clienti.cap} {$clienti.citta} {$clienti.provincia}</li>
            </ul>
        </td>
        <td>
            <ul style="list-style: none; text-align: right;">
                <li><strong>Fattura n. {$fatture.numero}/{$fatture.anno}</strong></li>
                <li><strong>Data Emissione: {$fatture.emissione}</strong></li>
            </ul>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    {if $fatture.oggetto neq ""}
        <tr>
            <td colspan="2">
                <ul style="list-style: none; padding: 0;">
                    <li><strong>Oggetto: {$fatture.oggetto}</strong></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
    {/if}

    <tr>
        <td colspan="2">
            <table border="0" style="width: 100%; border: 1px solid #000000;">
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
                    <tr style="text-align: center;">
                        <td style="border-top: 1px solid #999999;">{$row.codice}</td>
                        <td style="border-top: 1px solid #999999;">{$row.descrizione}</td>
                        <td style="border-top: 1px solid #999999;">€ {$row.prezzo|number_format:2}</td>
                        <td style="border-top: 1px solid #999999;">{$row.quantita}</td>
                        <td style="border-top: 1px solid #999999;">€ {$row.totale|number_format:2}</td>
                        <td style="border-top: 1px solid #999999;">{$row.iva}%</td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    {foreach from=$servizi item=row}
        {assign var="t" value=""}
        <tr>
            <td style=""><strong>TOTALE IMPONIBILE</strong></td>
            <td style="text-align: right;">€ {$row.totale|number_format:2}</td>
        </tr>
        <tr>
            <td style="padding-bottom: 10px;"><strong>IVA ({$row.iva}%)</strong></td>
            <td style="text-align: right; padding-bottom: 10px;">€ {math|number_format:2 equation="((imponibile * (iva)) / 100)" imponibile=$row.totale iva=$row.iva}</td>
        </tr>
    {/foreach}

    <tr>
        <td style="border-top: 1px solid #000000; padding-top: 5px;"><strong>TOTALE FATTURA</strong></td>
        <td style="text-align: right; border-top: 1px solid #000000; padding-top: 5px;">€ 0</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    {if $fatture.note neq ""}
        <tr>
            <td colspan="2">{$fatture.note}</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
    {/if}

    {if $fatture.pagamento neq ""}
        <tr>
            <td colspan="2">{$fatture.pagamento}</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
    {/if}

    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

    {if $configurazione.pie_di_pagina neq ""}
        <tr>
            <td colspan="2">{$configurazione.pie_di_pagina}</td>
        </tr>
    {/if}

</table>
</body>
</html>