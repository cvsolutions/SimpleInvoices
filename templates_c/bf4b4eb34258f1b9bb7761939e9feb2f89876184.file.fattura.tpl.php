<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-06-17 08:12:28
         compiled from "./templates/fattura.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1072826009539eeb5ca4a3f4-57542278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf4b4eb34258f1b9bb7761939e9feb2f89876184' => 
    array (
      0 => './templates/fattura.tpl',
      1 => 1402923663,
      2 => 'file',
    ),
    '9e6b070c8cb75a2b091a59dcbc2131b5d5a97bf5' => 
    array (
      0 => './templates/layout.tpl',
      1 => 1402985272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1072826009539eeb5ca4a3f4-57542278',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_539eeb5cadf926_15211956',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539eeb5cadf926_15211956')) {function content_539eeb5cadf926_15211956($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple invoices 1.0 by Concetto Vecchio</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/datepicker.css">
    <link rel="stylesheet" href="../css/style.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <div class="row">
        <div class="col-xs-6">
            <h1><img src="../files/folder-invoices-icon.png" alt=""/> Simple invoices 1.0</h1>
        </div>
        <div class="col-xs-6">
            <br/>

            <div class="btn-group pull-right">
                <a href="/configurazione" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Configurazione</a>
                <a href="/aggiungi-fattura" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Nuova Fattura</a>
                <a href="/" class="btn btn-default"><span class="glyphicon glyphicon-th-list"></span> Fatture</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">&nbsp;</div>
    </div>

    
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Nuova Fattura</h3>
                </div>
                <div class="panel-body">

                    <form role="form">

                        <div class="row">

                            <div class="col-xs-6">

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Fattura N.</label>
                                            <input type="text" class="form-control input-sm" name="" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Data</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control input-sm datepicker" name="" value="">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Oggetto</label>
                                            <input type="text" class="form-control input-sm" name="" value="">
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
                                                        <select class="form-control input-sm"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-8">
                                                    <div class="form-group">
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
                                                    <textarea rows="5" class="form-control input-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea rows="5" class="form-control input-sm"></textarea>
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
                                                    <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    </tbody>
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
                                                        <select class="form-control input-sm"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Codice</label>
                                                        <input type="text" class="form-control input-sm" name="" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Descrizione</label>
                                                        <textarea class="form-control input-sm"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-1">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <label>Quantità</label>
                                                        <input type="text" class="form-control input-sm" name="" value="">
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
                                                            <input type="text" class="form-control input-sm" name="" value="">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> IVA inclusa
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
                                                        <select class="form-control input-sm"></select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <br/>
                                                    <a href="" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus"></span> Aggiungi</a>
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
                                <a href="" class="btn btn-default">Salva</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/bootstrap-filestyle.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/jquery.isloading.js"></script>
<script src="../js/jquery.common.js"></script>

</body>
</html>
<?php }} ?>
