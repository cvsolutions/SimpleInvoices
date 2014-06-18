<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/vendor/autoload.php';

define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once __DIR__ . '/vendor/dompdf/dompdf/dompdf_config.inc.php';

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
 * Elenco Fatture
 * Elimino i servizi non necessari
 */
$app->get('/', function () use ($DB, $tpl) {

    $servizi = $DB->prepare('DELETE FROM servizi WHERE attivo = 0');
    $servizi->execute();

    $tpl->display('index.tpl');
    return false;
});

/**
 * Restituisce tutte le fatture in formato JSON
 */
$app->get('/fatture.json', function () use ($DB, $app) {

    $fatture = $DB->prepare('SELECT fatture.*, clienti.ragione_sociale  FROM fatture, clienti WHERE fatture.id_cliente = clienti.id');
    $fatture->execute();

    $obj = array();
    foreach ($fatture->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $obj[] = array(
            'id' => $row['id'],
            'numero' => $row['numero'],
            'anno' => $row['anno'],
            'emissione' => $row['emissione'],
            'ragione_sociale' => $row['ragione_sociale'],
            'totale' => 0,
            'iva' => 0
        );
    }
    return $app->json(array('aaData' => $obj));
});

/**
 * Configurazione
 * Intestatario Fatture & Layout pagina
 */
$app->get('/configurazione', function () use ($DB, $tpl) {

    $configurazione = $DB->prepare('SELECT * FROM configurazione LIMIT 0,1');
    $configurazione->execute();

    $tpl->assign('row', $configurazione->fetch(PDO::FETCH_ASSOC));
    $tpl->display('configurazione.tpl');
    return false;
});

/**
 * POST Configurazione
 * Aggiorno i dati nel database
 */
$app->post('/configurazione', function (Request $request) use ($DB, $app) {

    $error    = $_FILES['logo']['error'];
    $type     = $_FILES['logo']['type'];
    $tmp_name = $_FILES['logo']['tmp_name'];

    if (is_uploaded_file($tmp_name)) {

        if ($error == 0) {

            if ($type == 'image/jpeg') {

                if (move_uploaded_file($tmp_name, 'data/logo.jpg')) {
                    return $app->json(array(
                        'notice' => 'success',
                        'messages' => SUCCESS_MESSAGE,
                        'logo' => 1,
                        'img' => '../data/logo.jpg'
                    ));
                }

            } else {

                return $app->json(array(
                    'notice' => 'danger',
                    'logo' => 0,
                    'messages' => IMAGES_ONLY_MESSAGE
                ));
            }
        }

    } else {

        try {

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
            $configurazione->execute();

            return $app->json(array(
                'notice' => 'success',
                'logo' => 0,
                'messages' => SUCCESS_MESSAGE
            ));

        } catch (PDOException $Exception) {

            return $app->json(array(
                'notice' => 'danger',
                'logo' => 0,
                'code' => $Exception->getCode(),
                'messages' => $Exception->getMessage()
            ));
        }
    }
});

/**
 * Aggiungi Fattura
 */
$app->get('/aggiungi-fattura', function () use ($DB, $tpl) {

    $fatture = $DB->prepare('SELECT COUNT(numero) AS totale FROM fatture LIMIT 0,1');
    $fatture->execute();

    $clienti = $DB->prepare('SELECT * FROM clienti');
    $clienti->execute();

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE attivo = 1');
    $servizi->execute();

    $tpl->assign('fatture', $fatture->fetch(PDO::FETCH_ASSOC));
    $tpl->assign('clienti', $clienti->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('servizi', $servizi->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('id', mt_rand(11111, 99999));
    $tpl->display('aggiungi-fattura.tpl');
    return false;
});

/**
 * POST Aggiungi Fattura
 */
$app->post('/aggiungi-fattura', function (Request $request) use ($DB, $app) {

    $cliente    = $request->get('id_cliente');
    $id_cliente = $cliente == 0 ? mt_rand(11111, 99999) : $cliente;

    try {

        $fatture = $DB->prepare('INSERT INTO fatture (id, numero, anno, emissione, oggetto, pagamento, note, id_cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $fatture->bindParam(1, $request->get('id'));
        $fatture->bindParam(2, $request->get('numero'));
        $fatture->bindParam(3, date('Y', time()));
        $fatture->bindParam(4, $request->get('emissione'));
        $fatture->bindParam(5, $request->get('oggetto'));
        $fatture->bindParam(6, $request->get('pagamento'));
        $fatture->bindParam(7, $request->get('note'));
        $fatture->bindParam(8, $id_cliente);
        $fatture->execute();

        if ($cliente == 0) {

            $clienti = $DB->prepare('INSERT INTO clienti (id, ragione_sociale, codice_fiscale, partita_iva, indirizzo, cap, citta, provincia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $clienti->bindParam(1, $id_cliente);
            $clienti->bindParam(2, $request->get('ragione_sociale'));
            $clienti->bindParam(3, $request->get('codice_fiscale'));
            $clienti->bindParam(4, $request->get('partita_iva'));
            $clienti->bindParam(5, $request->get('indirizzo'));
            $clienti->bindParam(6, $request->get('cap'));
            $clienti->bindParam(7, $request->get('citta'));
            $clienti->bindParam(8, $request->get('provincia'));

        } else {

            $clienti = $DB->prepare('UPDATE clienti SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ? WHERE id = ?');
            $clienti->bindParam(1, $request->get('ragione_sociale'));
            $clienti->bindParam(2, $request->get('codice_fiscale'));
            $clienti->bindParam(3, $request->get('partita_iva'));
            $clienti->bindParam(4, $request->get('indirizzo'));
            $clienti->bindParam(5, $request->get('cap'));
            $clienti->bindParam(6, $request->get('citta'));
            $clienti->bindParam(7, $request->get('provincia'));
            $clienti->bindParam(8, $id_cliente);
        }

        $clienti->execute();

        /**
         * Dopo aver salvato la fattura
         * abilito i servizi attivi
         */
        $servizi = $DB->prepare('UPDATE servizi SET attivo = 1 WHERE id_fattura = ? AND attivo = 0');
        $servizi->bindParam(1, $request->get('id'));
        $servizi->execute();

        return $app->json(array(
            'notice' => 'success',
            'fattura' => $request->get('id'),
            'messages' => SUCCESS_MESSAGE
        ));

    } catch (PDOException $Exception) {

        return $app->json(array(
            'notice' => 'danger',
            'code' => $Exception->getCode(),
            'messages' => $Exception->getMessage()
        ));
    }

});

/**
 * POST Aggiungi Servizi Fattura
 */
$app->post('/aggiungi-servizi', function (Request $request) use ($DB, $app) {

    try {

        $totale = ($request->get('prezzo') * $request->get('quantita'));

        $servizi = $DB->prepare('INSERT INTO servizi (id, codice, descrizione, quantita, prezzo, totale, iva, id_fattura, attivo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)');
        $servizi->bindParam(1, mt_rand(11111, 99999));
        $servizi->bindParam(2, $request->get('codice'));
        $servizi->bindParam(3, $request->get('descrizione'));
        $servizi->bindParam(4, $request->get('quantita'));
        $servizi->bindParam(5, $request->get('prezzo'));
        $servizi->bindParam(6, $totale);
        $servizi->bindParam(7, $request->get('iva'));
        $servizi->bindParam(8, $request->get('id_fattura'));
        $servizi->execute();

        return $app->json(array(
            'notice' => 'success',
            'fattura' => $request->get('id_fattura'),
            'messages' => SUCCESS_MESSAGE
        ));

    } catch (PDOException $Exception) {

        return $app->json(array(
            'notice' => 'danger',
            'fattura' => $request->get('id_fattura'),
            'code' => $Exception->getCode(),
            'messages' => $Exception->getMessage()
        ));
    }
});

/**
 * Servizi fattura JSON
 */
$app->get('/servizi/{fattura}.json', function ($fattura) use ($DB, $app) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id_fattura = ?');
    $servizi->bindParam(1, $fattura);
    $servizi->execute();

    $obj = array();
    foreach ($servizi->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $obj[] = array(
            'id' => $row['id'],
            'codice' => $row['codice'],
            'descrizione' => $row['descrizione'],
            'prezzo' => $row['prezzo'],
            'quantita' => $row['quantita'],
            'totale' => $row['totale'],
            'iva' => sprintf('%s%%', $row['iva'])
        );
    }
    return $app->json(array('aaData' => $obj));
});

/**
 * Cliente JSON
 */
$app->post('/cliente', function (Request $request) use ($DB, $app) {

    $clienti = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $clienti->bindParam(1, $request->get('id'));
    $clienti->execute();
    return $app->json($clienti->fetch(PDO::FETCH_ASSOC));
});

/**
 * Servizio JSON
 */
$app->post('/servizio', function (Request $request) use ($DB, $app) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id = ? LIMIT 0,1');
    $servizi->bindParam(1, $request->get('id'));
    $servizi->execute();
    return $app->json($servizi->fetch(PDO::FETCH_ASSOC));
});

/**
 * Modifico la Fattura
 */
$app->get('/modifica-fattura/{id}', function ($id) use ($DB, $tpl) {

    $fatture = $DB->prepare('SELECT * FROM fatture WHERE id = ? LIMIT 0,1');
    $fatture->bindParam(1, $id);
    $fatture->execute();
    $row = $fatture->fetch(PDO::FETCH_ASSOC);

    $cliente = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $cliente->bindParam(1, $row['id_cliente']);
    $cliente->execute();

    $clienti = $DB->prepare('SELECT * FROM clienti');
    $clienti->execute();

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE attivo = 1');
    $servizi->execute();

    $tpl->assign('clienti', $clienti->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('servizi', $servizi->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('cliente', $cliente->fetch(PDO::FETCH_ASSOC));
    $tpl->assign('fatture', $row);
    $tpl->display('modifica-fattura.tpl');
    return false;
});

/**
 * POST Modifico la Fattura
 */
$app->post('/modifica-fattura/{id}', function ($id, Request $request) use ($DB, $app) {

    try {

        $fatture = $DB->prepare('UPDATE fatture SET numero = ?, emissione = ?, oggetto = ?, pagamento = ?, note = ?, id_cliente = ? WHERE id = ?');
        $fatture->bindParam(1, $request->get('numero'));
        $fatture->bindParam(2, $request->get('emissione'));
        $fatture->bindParam(3, $request->get('oggetto'));
        $fatture->bindParam(4, $request->get('pagamento'));
        $fatture->bindParam(5, $request->get('note'));
        $fatture->bindParam(6, $request->get('id_cliente'));
        $fatture->bindParam(7, $id);
        $fatture->execute();

        $clienti = $DB->prepare('UPDATE clienti SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ? WHERE id = ?');
        $clienti->bindParam(1, $request->get('ragione_sociale'));
        $clienti->bindParam(2, $request->get('codice_fiscale'));
        $clienti->bindParam(3, $request->get('partita_iva'));
        $clienti->bindParam(4, $request->get('indirizzo'));
        $clienti->bindParam(5, $request->get('cap'));
        $clienti->bindParam(6, $request->get('citta'));
        $clienti->bindParam(7, $request->get('provincia'));
        $clienti->bindParam(8, $request->get('id_cliente'));
        $clienti->execute();

        /**
         * Dopo aver salvato la fattura
         * abilito i servizi attivi
         */
        $servizi = $DB->prepare('UPDATE servizi SET attivo = 1 WHERE id_fattura = ? AND attivo = 0');
        $servizi->bindParam(1, $id);
        $servizi->execute();

        return $app->json(array(
            'notice' => 'success',
            'fattura' => $id,
            'messages' => SUCCESS_MESSAGE
        ));

    } catch (PDOException $Exception) {
        return $app->json(array(
            'notice' => 'danger',
            'code' => $Exception->getCode(),
            'messages' => $Exception->getMessage()
        ));
    }
});

/**
 * Modifica Servizi
 */
$app->get('/modifica-servizi/{id}', function ($id) use ($DB, $tpl) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id = ?');
    $servizi->bindParam(1, $id);
    $servizi->execute();

    $tpl->assign('servizi', $servizi->fetch(PDO::FETCH_ASSOC));
    $tpl->display('modifica-servizi.tpl');
    return false;
});

/**
 * POST Modifica Servizi
 */
$app->post('/modifica-servizi', function (Request $request) use ($DB, $app) {

    try {

        switch ($request->get('action')) {

            case 1:
                $totale = ($request->get('prezzo') * $request->get('quantita'));

                $servizi = $DB->prepare('UPDATE servizi SET codice = ?, descrizione = ?, quantita = ?, prezzo = ?, totale = ?, iva = ? WHERE id = ?');
                $servizi->bindParam(1, $request->get('codice'));
                $servizi->bindParam(2, $request->get('descrizione'));
                $servizi->bindParam(3, $request->get('quantita'));
                $servizi->bindParam(4, $request->get('prezzo'));
                $servizi->bindParam(5, $totale);
                $servizi->bindParam(6, $request->get('iva'));
                $servizi->bindParam(7, $request->get('id'));
                $servizi->execute();
                break;

            case 2:
                $servizi = $DB->prepare('UPDATE servizi SET id_fattura = 0, attivo = 0 WHERE id = ?');
                $servizi->bindParam(1, $request->get('id'));
                $servizi->execute();
                break;

        }

        return $app->json(array(
            'notice' => 'success',
            'fattura' => $request->get('id'),
            'messages' => SUCCESS_MESSAGE
        ));

    } catch (PDOException $Exception) {
        return $app->json(array(
            'notice' => 'danger',
            'code' => $Exception->getCode(),
            'messages' => $Exception->getMessage()
        ));
    }
});

/**
 * Elimino la fattura
 */
$app->get('/elimina-fattura/{id}', function ($id) use ($DB, $app) {

    $fatture = $DB->prepare('DELETE FROM fatture WHERE id = ?');
    $fatture->bindParam(1, $id);
    $fatture->execute();

    $servizi = $DB->prepare('DELETE FROM servizi WHERE id_fattura = ?');
    $servizi->bindParam(1, $id);
    $servizi->execute();
    return $app->redirect('/');

});

/**
 * PDF Fattura
 */
$app->get('/pdf/{id}.pdf', function ($id) use ($DB, $tpl, $app) {

    /**
     * Recupero i parametri di configurazione
     */
    $configurazione = $DB->prepare('SELECT * FROM configurazione LIMIT 0,1');
    $configurazione->execute();

    /**
     * Il dettaglio della fattura
     */
    $fatture = $DB->prepare('SELECT * FROM fatture WHERE id = ? LIMIT 0,1');
    $fatture->bindParam(1, $id);
    $fatture->execute();
    $row = $fatture->fetch(PDO::FETCH_ASSOC);

    /**
     * Il dettaglio del cliente
     */
    $clienti = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $clienti->bindParam(1, $row['id_cliente']);
    $clienti->execute();

    /**
     * Tutti i servizi della fattura
     */
    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id_fattura = ?');
    $servizi->bindParam(1, $row['id']);
    $servizi->execute();

    $tpl->assign('configurazione', $configurazione->fetch(PDO::FETCH_ASSOC));
    $tpl->assign('fatture', $row);
    $tpl->assign('clienti', $clienti->fetch(PDO::FETCH_ASSOC));
    $tpl->assign('servizi', $servizi->fetchAll(PDO::FETCH_ASSOC));

    /** @var DOMPDF $dompdf */
    $dompdf = new DOMPDF();
    $dompdf->load_html($tpl->fetch('pdf.tpl'));
    $dompdf->render();
    $dompdf->stream(sprintf('%d.pdf', $id), array('Attachment' => 0));
    //$tpl->display('pdf.tpl');
    return false;
});

$DB = null;
$app->run();