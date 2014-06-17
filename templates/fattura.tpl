{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nuova Fattura</h3>
                </div>
                <div class="panel-body">

                    <form id="fattura" role="form" method="post">

                        <div class="row">

                            <div class="col-xs-6">

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Fattura N.</label>
                                            <input type="text" class="form-control input-sm" name="numero" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Data</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm datepicker" name="emissione" value="">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Oggetto</label>
                                            <input type="text" class="form-control input-sm" name="oggetto" value="">
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
                                                        <select class="form-control input-sm" name="id_cliente">
                                                            <option value="">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" name="ragione_sociale" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Codice Fiscale</label>
                                                        <input type="text" class="form-control input-sm" name="codice_fiscale" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Partita IVA</label>
                                                        <input type="text" class="form-control input-sm" name="partita_iva" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Indirizzo</label>
                                                        <input type="text" class="form-control input-sm" name="indirizzo" value="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>CAP</label>
                                                        <input type="text" class="form-control input-sm" name="cap" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label>Città</label>
                                                        <input type="text" class="form-control input-sm" name="citta" value="">
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label>Provincia</label>
                                                        <input type="text" class="form-control input-sm" name="provincia" value="">
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
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Pagamento</label>
                                                    <textarea rows="5" class="form-control input-sm" name="pagamento"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea rows="5" class="form-control input-sm" name="note"></textarea>
                                                </div>
                                            </div>
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
                                                <table id="myTable" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Codice</th>
                                                        <th>Descrizione</th>
                                                        <th>Prezzo</th>
                                                        <th>Qnt</th>
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
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <br/>
                                                        <select class="form-control input-sm" name="">
                                                            <option value="">-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Codice</label>
                                                        <input type="text" class="form-control input-sm" name="codice" id="codice" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Descrizione</label>
                                                        <textarea class="form-control input-sm" name="descrizione" id="descrizione"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Quantità</label>
                                                        <input type="text" class="form-control input-sm" name="quantita" id="quantita" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Prezzo</label>

                                                        <div class="input-group">
                                                            <input type="text" class="form-control input-sm" name="prezzo" id="prezzo" value="">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="inclusa" id="inclusa" value="1"> IVA inclusa
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>IVA</label>
                                                        <select class="form-control input-sm" name="iva" id="iva"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <br/>
                                                    <a href="javascript:void(0)" id="servizi" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus"></span> Aggiungi</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <hr/>
                                <input type="hidden" name="id" value="{$id}">
                                <input type="submit" class="btn btn-default" value="Salva">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
{/block}
