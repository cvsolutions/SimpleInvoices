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
                                    <label><span class="text-danger">*</span> Descrizione</label>
                                    <textarea class="form-control" rows="3" name="descrizione" required="" id="descrizione">{$servizi.descrizione}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span> Codice</label>
                                    <input type="text" class="form-control" name="codice" required="" maxlength="5" value="{$servizi.codice}">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span> Quantità</label>
                                    <input type="number" class="form-control" name="quantita" required="" id="quantita" maxlength="3" value="{$servizi.quantita}">
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label><span class="text-danger">*</span> Prezzo</label>
                                    <input type="text" class="form-control" name="prezzo" required="" id="prezzo" value="{$servizi.prezzo}">
                                    <div class="checkbox">
                                        <label><input type="checkbox" {if $servizi.inclusa eq 1}checked{/if} name="inclusa" id="inclusa" value="1"> IVA inclusa</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label>IVA</label>
                                    <select class="form-control" name="aliquota" id="aliquota">
                                        <option value="0">-</option>
                                        {for $foo=1 to 100}
                                            <option value="{$foo}" {if $foo eq $servizi.aliquota}selected{/if}>{$foo}%</option>
                                        {/for}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Operazione</label>
                                    <select class="form-control" name="action" id="action">
                                        <option value="1">Modifica</option>
                                        <option value="2">Cancella</option>
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
