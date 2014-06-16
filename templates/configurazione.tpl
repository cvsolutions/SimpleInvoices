{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Configurazione</h3>
                </div>
                <div class="panel-body">
                    <form role="form">

                        <div class="row">
                            <div class="col-xs-6">
                                <fieldset>
                                    <legend>Intestatario Fatture</legend>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Ragione Sociale</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Codice Fiscale</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Partita IVA</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Indirizzo</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>CAP</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Città</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Provincia</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>FAX</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Indirizzo E-mail</label>
                                                <input type="text" class="form-control input-sm" name="" value="">
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
                                                <textarea rows="5" class="form-control input-sm"></textarea>
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
                                            <img src="data/logo.png" class="img-responsive img-thumbnail" alt=""/>
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="form-group">
                                                <input type="file" name="">

                                                <p class="help-block">Selezionare un file immagine</p>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>

                        </div>

                        <hr/>
                        <a href="" class="btn btn-default">Salva</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}
