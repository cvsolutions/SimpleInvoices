<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-06-17 09:51:28
         compiled from "./templates/configurazione.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1185421414539ff380f0bbc2-34906373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ca52e8210ca96928f16120911ff903181585cc0' => 
    array (
      0 => './templates/configurazione.tpl',
      1 => 1402991092,
      2 => 'file',
    ),
    '9e6b070c8cb75a2b091a59dcbc2131b5d5a97bf5' => 
    array (
      0 => './templates/layout.tpl',
      1 => 1402991092,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1185421414539ff380f0bbc2-34906373',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_539ff3810eb150_93635114',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539ff3810eb150_93635114')) {function content_539ff3810eb150_93635114($_smarty_tpl) {?><!DOCTYPE html>
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
                    <h3 class="panel-title">Configurazione</h3>
                </div>
                <div class="panel-body">
                    <form id="configurazione" role="form" method="post">

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
                                                <label>Ragione Sociale</label>
                                                <input type="text" class="form-control input-sm" name="ragione_sociale" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['ragione_sociale'];?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Codice Fiscale</label>
                                                <input type="text" class="form-control input-sm" name="codice_fiscale" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['codice_fiscale'];?>
">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Partita IVA</label>
                                                <input type="text" class="form-control input-sm" name="partita_iva" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['partita_iva'];?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Indirizzo</label>
                                                <input type="text" class="form-control input-sm" name="indirizzo" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['indirizzo'];?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>CAP</label>
                                                <input type="text" class="form-control input-sm" name="cap" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['cap'];?>
">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Città</label>
                                                <input type="text" class="form-control input-sm" name="citta" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['citta'];?>
">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Provincia</label>
                                                <input type="text" class="form-control input-sm" name="provincia" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['provincia'];?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input type="text" class="form-control input-sm" name="telefono" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['telefono'];?>
">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>FAX</label>
                                                <input type="text" class="form-control input-sm" name="fax" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['fax'];?>
">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Indirizzo E-mail</label>
                                                <input type="text" class="form-control input-sm" name="email" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
">
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
                                                <textarea rows="5" class="form-control input-sm" name="pie_di_pagina"><?php echo $_smarty_tpl->tpl_vars['row']->value['pie_di_pagina'];?>
</textarea>
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
                                                <input type="file" name="logo">

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
