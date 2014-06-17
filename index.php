<?php
use Symfony\Component\HttpFoundation\Request;

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
 * define var
 */
define('SUCCESS_MESSAGE', 'Operazione eseguita con successo!');
define('IMAGES_ONLY_MESSAGE', 'È possibile inserire solo immagini!');

/**
 * Homepage
 */
$app->get('/', function () use ($tpl) {
    $tpl->display('index.tpl');
    return false;
});

/**
 * nnnn
 */
$app->get('/fatture.json', function () use ($app) {
    return $app->json(array(
        'recordsTotal' => 1,
        'data' => array('a', '', '', '', '', '', '')
    ));
});

/**
 * Configurazione
 */
$app->get('/configurazione', function () use ($DB, $tpl) {
    $sth = $DB->prepare('SELECT * FROM configurazione LIMIT 0,1');
    $sth->execute();
    $tpl->assign('row', $sth->fetch(PDO::FETCH_ASSOC));
    $tpl->display('configurazione.tpl');
    return false;
});

/**
 * POST Configurazione
 */
$app->post('/configurazione', function (Request $request) use ($DB, $app) {

    $error    = $_FILES['logo']['error'];
    $type     = $_FILES['logo']['type'];
    $tmp_name = $_FILES['logo']['tmp_name'];

    if (is_uploaded_file($tmp_name)) {

        if ($error == 0) {

            if ($type == 'image/jpeg') {

                if (move_uploaded_file($tmp_name, 'data/logo.png')) {
                    return $app->json(array(
                        'notice' => 'success',
                        'messages' => SUCCESS_MESSAGE,
                        'img' => 'data/logo.png'
                    ));
                }

            } else {

                return $app->json(array(
                    'notice' => 'danger',
                    'messages' => IMAGES_ONLY_MESSAGE
                ));
            }
        }

    } else {

        $query = 'UPDATE configurazione SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ?, telefono = ?, fax = ?, email = ?, pie_di_pagina = ?';
        $stmt  = $DB->prepare($query);

        $stmt->bindParam(1, $request->get('ragione_sociale'));
        $stmt->bindParam(2, $request->get('codice_fiscale'));
        $stmt->bindParam(3, $request->get('partita_iva'));
        $stmt->bindParam(4, $request->get('indirizzo'));
        $stmt->bindParam(5, $request->get('cap'));
        $stmt->bindParam(6, $request->get('citta'));
        $stmt->bindParam(7, $request->get('provincia'));
        $stmt->bindParam(8, $request->get('telefono'));
        $stmt->bindParam(9, $request->get('fax'));
        $stmt->bindParam(10, $request->get('email'));
        $stmt->bindParam(11, $request->get('pie_di_pagina'));

        if ($stmt->execute()) {
            return $app->json(array(
                'notice' => 'success',
                'messages' => SUCCESS_MESSAGE
            ));
        }
    }
});

/**
 * Aggiungi Fattura
 */
$app->get('/aggiungi-fattura', function () use ($tpl) {
    $tpl->display('fattura.tpl');
    return false;
});

$DB = null;
$app->run();