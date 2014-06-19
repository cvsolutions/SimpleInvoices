{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Configurazione</h3>
                </div>
                <div class="panel-body">
                    <form id="configurazione" enctype="multipart/form-data" autocomplete="off" role="form" method="post">

                        <div class="row">
                            <div class="col-xs-12">
                                <div id="result" style="display: none"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <fieldset>
                                    <legend>Intestatario Fatture</legend>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Ragione Sociale</label>
                                                <input type="text" class="form-control" name="ragione_sociale" required="" value="{$row.ragione_sociale}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Codice Fiscale</label>
                                                <input type="text" class="form-control" name="codice_fiscale" required="" value="{$row.codice_fiscale}">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Partita IVA</label>
                                                <input type="text" class="form-control" name="partita_iva" required="" value="{$row.partita_iva}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Indirizzo</label>
                                                <input type="text" class="form-control" name="indirizzo" required="" value="{$row.indirizzo}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> CAP</label>
                                                <input type="text" class="form-control" name="cap" required="" value="{$row.cap}">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Città</label>
                                                <input type="text" class="form-control" name="citta" required="" value="{$row.citta}">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Provincia</label>
                                                <input type="text" class="form-control" name="provincia" required="" value="{$row.provincia}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Telefono</label>
                                                <input type="tel" class="form-control" name="telefono" required="" value="{$row.telefono}">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>FAX</label>
                                                <input type="tel" class="form-control" name="fax" value="{$row.fax}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label><span class="text-danger">*</span> Indirizzo E-mail</label>
                                                <input type="email" class="form-control" name="email" required="" value="{$row.email}">
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>

                            <div class="col-xs-6">
                                <fieldset>
                                    <legend>Layout pagina</legend>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Piè di pagina</label>
                                                <textarea rows="5" class="form-control" name="pie_di_pagina">{$row.pie_di_pagina}</textarea>
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
                                            <label>Logo</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <img src="../data/logo.jpg" id="logo" class="img-responsive img-thumbnail" alt=""/>
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="form-group">
                                                <input type="file" accept="image/jpeg" name="logo">

                                                <p class="help-block">Selezionare un file immagine</p>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>

                        </div>

                        <hr/>
                        <input type="submit" class="btn btn-default" value="Salva">

                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}
