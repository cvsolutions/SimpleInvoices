{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Aggiungi Fattura</h3>
                </div>
                <div class="panel-body">

                    <form id="modifica_fattura" role="form" autocomplete="off" method="post">

                        <div class="row">
                            <div class="col-xs-12">
                                <div id="result" style="display: none"></div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-xs-6">

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Fattura N.</label>
                                            <input type="text" class="form-control input-sm" name="numero" value="{$fatture.numero}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Data</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm datepicker" name="emissione" value="{$fatture.emissione}" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Oggetto</label>
                                            <input type="text" class="form-control input-sm" name="oggetto" value="{$fatture.oggetto}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Cliente</legend>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label>Ragione Sociale</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control input-sm" name="id_cliente" id="id_cliente">
                                                            {foreach from=$clienti item=row}
                                                                <option value="{$row.id}" {if $row.id eq $cliente.id}selected{/if}>{$row.ragione_sociale}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" name="ragione_sociale" id="ragione_sociale" value="{$cliente.ragione_sociale}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Codice Fiscale</label>
                                                        <input type="text" class="form-control input-sm" name="codice_fiscale" id="codice_fiscale" value="{$cliente.codice_fiscale}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Partita IVA</label>
                                                        <input type="text" class="form-control input-sm" name="partita_iva" id="partita_iva" value="{$cliente.partita_iva}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Indirizzo</label>
                                                        <input type="text" class="form-control input-sm" name="indirizzo" id="indirizzo" value="{$cliente.indirizzo}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>CAP</label>
                                                        <input type="text" class="form-control input-sm" name="cap" id="cap" value="{$cliente.cap}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>Città</label>
                                                        <input type="text" class="form-control input-sm" name="citta" id="citta" value="{$cliente.citta}">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Provincia</label>
                                                        <input type="text" class="form-control input-sm" name="provincia" id="provincia" value="{$cliente.provincia}">
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-6">

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Pagamento</label>
                                            <textarea rows="5" class="form-control input-sm" name="pagamento">{$fatture.pagamento}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea rows="5" class="form-control input-sm" name="note">{$fatture.note}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <p>&nbsp;</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <table id="lista-servizi" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Codice</th>
                                                        <th>Descrizione</th>
                                                        <th>Prezzo</th>
                                                        <th>Qta</th>
                                                        <th>Totale</th>
                                                        <th>IVA</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <fieldset>
                                    <legend>Aggiungi Servizio</legend>

                                    <div class="row">

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <br/>
                                                <select class="form-control input-sm" name="id_servizio" id="id_servizio">
                                                    <option value="0">-</option>
                                                    {foreach from=$servizi item=row}
                                                        <option value="{$row.id}">{$row.codice}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label>Codice</label>
                                                <input type="text" class="form-control input-sm" name="codice" id="codice" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Descrizione</label>
                                                <textarea class="form-control input-sm" name="descrizione" id="descrizione"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label>Quantità</label>
                                                <input type="text" class="form-control input-sm" name="quantita" id="quantita" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Prezzo</label>
                                                <input type="text" class="form-control input-sm" name="prezzo" id="prezzo" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label>IVA</label>
                                                <select class="form-control input-sm" name="iva" id="iva">
                                                    <option value="0">-</option>
                                                    {for $foo=1 to 100}
                                                        <option value="{$foo}">{$foo}%</option>
                                                    {/for}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <br/>
                                            <a href="javascript:void(0)" id="servizi" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus"></span> Aggiungi</a>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <hr/>
                                <input type="hidden" name="id" id="id" value="{$fatture.id}">
                                <input type="submit" class="btn btn-default" value="Salva">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
{/block}
