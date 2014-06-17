<?php /* Smarty version Smarty-3.1.19-dev, created on 2014-06-16 15:53:49
         compiled from "./templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:595052866539ee7c9279d31-59830449%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0360d049dff10f364dfc53ba2cc3958abf6ee6d' => 
    array (
      0 => './templates/index.tpl',
      1 => 1402925242,
      2 => 'file',
    ),
    '9e6b070c8cb75a2b091a59dcbc2131b5d5a97bf5' => 
    array (
      0 => './templates/layout.tpl',
      1 => 1402926641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '595052866539ee7c9279d31-59830449',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19-dev',
  'unifunc' => 'content_539ee7c92e1644_43256064',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539ee7c92e1644_43256064')) {function content_539ee7c92e1644_43256064($_smarty_tpl) {?><!DOCTYPE html>
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
                    <h3 class="panel-title">Fatture</h3>
                </div>
                <div class="panel-body">
                    <table id="fatture" class="table">
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
                    </table>
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
