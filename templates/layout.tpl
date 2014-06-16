<!DOCTYPE html>
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

    {block name="container"}{/block}

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/bootstrap-filestyle.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/jquery.isloading.js"></script>
<script src="../js/common.jquery.js"></script>

</body>
</html>
