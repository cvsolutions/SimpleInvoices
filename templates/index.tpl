{extends file="layout.tpl"}

{block name="container"}
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Fatture</h3>
                </div>
                <div class="panel-body">
                    <table id="myTable" class="table">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Numero</th>
                            <th>Anno</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Totale</th>
                            <th>IVA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-default btn-sm">Modifica</a>
                                    <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Stampa con quantità</a></li>
                                        <li><a href="#">Stampa</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Cancella</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td>111</td>
                            <td>111</td>
                            <td>111</td>
                            <td>111</td>
                            <td>111</td>
                            <td>111</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{/block}
