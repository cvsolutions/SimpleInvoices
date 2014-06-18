{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Modifica Servizio</h3>
                </div>
                <div class="panel-body">
                    <form id="modifica_servizi" role="form" autocomplete="off" method="post">

                        <div class="row">

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Descrizione</label>
                                    <textarea class="form-control input-sm" name="descrizione" id="descrizione">{$servizi.descrizione}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Codice</label>
                                    <input type="text" class="form-control input-sm" name="codice" value="{$servizi.codice}">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Quantità</label>
                                    <input type="text" class="form-control input-sm" name="quantita" id="quantita" value="{$servizi.quantita}">
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>Prezzo</label>
                                    <input type="text" class="form-control input-sm" name="prezzo" id="prezzo" value="{$servizi.prezzo}">
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="inclusa" id="inclusa" {if $servizi.inclusa eq 1}checked{/if} value="1"> IVA inclusa</label>
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>IVA</label>
                                    <select class="form-control input-sm" name="iva" id="iva">
                                        <option value="0">-</option>
                                        {for $foo=1 to 100}
                                            <option value="{$foo}" {if $foo eq $servizi.iva}selected{/if}>{$foo}%</option>
                                        {/for}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <hr/>
                                <input type="hidden" name="id" value="{$servizi.id}">
                                <input type="submit" class="btn btn-default" value="Salva">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}
