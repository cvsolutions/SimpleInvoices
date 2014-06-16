<?php
require_once __DIR__ . '/vendor/autoload.php';

/** @var PDO $DB */
$DB = new PDO('sqlite:data/fatture.db');
$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/** @var Smarty $tpl */
$tpl            = new Smarty();
$tpl->debugging = false;

/** @var \Silex\Application $app */
$app          = new Silex\Application();
$app['debug'] = true;

/**
 * Homepage
 */
$app->get('/', function () use ($tpl) {
    $tpl->display('index.tpl');

    return false;
});

$app->get('/configurazione', function () use ($tpl) {
    $tpl->display('configurazione.tpl');

    return false;
});


$app->get('/aggiungi', function () use ($tpl) {
    $tpl->display('fattura.tpl');

    return false;
});


$app->run();