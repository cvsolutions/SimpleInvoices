{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Elenco Fatture</h3>
                </div>
                <div class="panel-body">
                    <table id="fatture" class="table">
                        <thead>
                        <tr>
                            <th>Operazione</th>
                            <th>Numero</th>
                            <th>Anno</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Totale</th>
                            <th>IVA</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
{/block}
