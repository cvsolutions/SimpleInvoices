{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Aggiungi Fattura</h3>
                </div>
                <div class="panel-body">

                    <form id="aggiungi_fattura" role="form" autocomplete="off" method="post">

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
                                            <label><span class="text-danger">*</span> Fattura N.</label>
                                            <input type="number" class="form-control" name="numero" required="" value="{$fatture.totale + 1}">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label><span class="text-danger">*</span> Data</label>

                                            <div class="input-group date" id="datetimepicker1" data-date-format="YYYY-MM-DD">
                                                <input type="text" class="form-control" name="emissione" required="" value="{$smarty.now|date_format:"%Y-%m-%d"}" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Oggetto</label>
                                            <input type="text" class="form-control" name="oggetto" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Cliente</legend>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <label><span class="text-danger">*</span> Ragione Sociale</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="id_cliente" id="id_cliente">
                                                            <option value="0">-</option>
                                                            {foreach from=$clienti item=row}
                                                                <option value="{$row.id}">{$row.ragione_sociale}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="ragione_sociale" required="" id="ragione_sociale" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Codice Fiscale</label>
                                                        <input type="text" class="form-control" name="codice_fiscale" required="" id="codice_fiscale" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Partita IVA</label>
                                                        <input type="text" class="form-control" name="partita_iva" required="" id="partita_iva" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Indirizzo</label>
                                                        <input type="text" class="form-control" name="indirizzo" required="" id="indirizzo" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> CAP</label>
                                                        <input type="text" class="form-control" name="cap" required="" id="cap" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Città</label>
                                                        <input type="text" class="form-control" name="citta" required="" id="citta" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label><span class="text-danger">*</span> Provincia</label>
                                                        <input type="text" class="form-control" name="provincia" required="" id="provincia" value="">
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
                                            <textarea rows="5" class="form-control" name="pagamento"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Note</label>
                                            <textarea rows="5" class="form-control" name="note"></textarea>
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

                                <div class="row">
                                    <div class="col-xs-12">
                                        <ul class="list-inline">
                                            <li>Totale Imp. <strong class="badge">0</strong></li>
                                            <li>IVA <strong class="badge">0</strong></li>
                                            <li>Totale <strong class="badge">0</strong></li>
                                        </ul>
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
                                                <select class="form-control" name="id_servizio" id="id_servizio">
                                                    <option value="0">-</option>
                                                    {foreach from=$servizi item=row}
                                                        <option value="{$row.id}">{$row.codice}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Codice</label>
                                                <input type="text" class="form-control ignore" name="codice" id="codice" required="" maxlength="5" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Descrizione</label>
                                                <textarea class="form-control ignore" name="descrizione" required="" id="descrizione"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Qta</label>
                                                <input type="number" class="form-control ignore" name="quantita" required="" maxlength="3" id="quantita" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Prezzo</label>
                                                <input type="text" class="form-control ignore" name="prezzo" required="" id="prezzo" value="">

                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="inclusa" id="inclusa" value="1"> IVA inclusa</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="form-group">
                                                <label>IVA</label>
                                                <select class="form-control" name="aliquota" id="aliquota">
                                                    <option value="0">-</option>
                                                    {for $aliquota = 1 to 100}
                                                        <option value="{$aliquota}">{$aliquota}%</option>
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
                                <input type="hidden" name="id" id="id" required="" value="{$id}">
                                <input type="submit" class="btn btn-default" disabled value="Salva">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
{/block}
