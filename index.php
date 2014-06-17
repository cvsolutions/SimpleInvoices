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
 * Fatture json
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

        $configurazione = $DB->prepare('UPDATE configurazione SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ?, telefono = ?, fax = ?, email = ?, pie_di_pagina = ?');
        $configurazione->bindParam(1, $request->get('ragione_sociale'));
        $configurazione->bindParam(2, $request->get('codice_fiscale'));
        $configurazione->bindParam(3, $request->get('partita_iva'));
        $configurazione->bindParam(4, $request->get('indirizzo'));
        $configurazione->bindParam(5, $request->get('cap'));
        $configurazione->bindParam(6, $request->get('citta'));
        $configurazione->bindParam(7, $request->get('provincia'));
        $configurazione->bindParam(8, $request->get('telefono'));
        $configurazione->bindParam(9, $request->get('fax'));
        $configurazione->bindParam(10, $request->get('email'));
        $configurazione->bindParam(11, $request->get('pie_di_pagina'));

        if ($configurazione->execute()) {
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
    $tpl->assign('id', mt_rand(11111, 99999));
    $tpl->display('fattura.tpl');
    return false;
});

/**
 * POST Aggiungi Fattura
 */
$app->post('/aggiungi-fattura', function (Request $request) use ($DB, $app) {

    $fatture = $DB->prepare('INSERT INTO fatture (id, numero, emissione, oggetto, pagamento, note, id_cliente) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $fatture->bindParam(1, $request->get('id'));
    $fatture->bindParam(2, $request->get('numero'));
    $fatture->bindParam(3, $request->get('emissione'));
    $fatture->bindParam(4, $request->get('oggetto'));
    $fatture->bindParam(5, $request->get('pagamento'));
    $fatture->bindParam(6, $request->get('note'));
    $fatture->bindParam(6, $request->get('id_cliente'));

    $clienti = $DB->prepare('INSERT INTO clienti (id, ragione_sociale, codice_fiscale, partita_iva, indirizzo, cap, citta, provincia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $clienti->bindParam(1, $request->get('id'));
    $clienti->bindParam(2, $request->get('ragione_sociale'));
    $clienti->bindParam(3, $request->get('codice_fiscale'));
    $clienti->bindParam(4, $request->get('partita_iva'));
    $clienti->bindParam(5, $request->get('indirizzo'));
    $clienti->bindParam(6, $request->get('cap'));
    $clienti->bindParam(7, $request->get('citta'));
    $clienti->bindParam(8, $request->get('provincia'));

    return true;
});

/**
 * POST Aggiungi Servizi Fattura
 */
$app->post('/aggiungi-servizi', function (Request $request) use ($DB, $app) {

    $servizi = $DB->prepare('INSERT INTO servizi (id, codice, descrizione, quantita, prezzo, iva, inclusa, id_fattura) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $servizi->bindParam(1, $request->get('id'));
    $servizi->bindParam(2, $request->get('codice'));
    $servizi->bindParam(3, $request->get('descrizione'));
    $servizi->bindParam(4, $request->get('quantita'));
    $servizi->bindParam(5, $request->get('prezzo'));
    $servizi->bindParam(6, $request->get('iva'));
    $servizi->bindParam(7, $request->get('inclusa'));
    $servizi->bindParam(8, $request->get('id_fattura'));
    return $app->json(array(
        'codice' => $request->get('codice')
    ));

});

$DB = null;
$app->run();