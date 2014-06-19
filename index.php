<?php
use Symfony\Component\HttpFoundation\Request;

/**
 * Defines a named constant
 */
define('SUCCESS_MESSAGE', 'Operazione eseguita con successo!');
define('IMAGES_ONLY_MESSAGE', 'È possibile inserire solo immagini!');
define('DOMPDF_ENABLE_AUTOLOAD', false);
define('ID_RAND', mt_rand(11111, 99999));

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/dompdf/dompdf/dompdf_config.inc.php';

/** @var PDO $DB */
$DB = new PDO('sqlite:data/fatture.db');
$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/** @var Smarty $tpl */
$tpl            = new Smarty();
$tpl->debugging = false;

/** @var \Silex\Application $app */
$app          = new \Silex\Application();
$app['debug'] = true;

/**
 * Elenco Fatture
 */
$app->get('/', function () use ($DB, $tpl) {

    $DB->exec('DELETE FROM servizi WHERE attivo = 0');
    $tpl->display('index.tpl');
    return false;
});

/**
 * Restituisce tutte le fatture in formato JSON
 */
$app->get('/fatture.json', function () use ($DB, $app) {

    $fatture = $DB->prepare('SELECT fatture.*, clienti.ragione_sociale FROM fatture, clienti WHERE fatture.id_cliente = clienti.id ORDER BY fatture.pubblicazione DESC');
    $fatture->execute();

    $obj = array();
    foreach ($fatture->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $date  = new DateTime($row['emissione']);
        $obj[] = array(
            'id' => $row['id'],
            'numero' => $row['numero'],
            'anno' => $row['anno'],
            'emissione' => $date->format('d/m/Y'),
            'ragione_sociale' => $row['ragione_sociale'],
            'totale' => 0,
            'iva' => 0
        );
    }
    return $app->json(array('aaData' => $obj));
});

/**
 * Configurazione
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
            $configurazione->bindParam(1, $request->get('ragione_sociale'), PDO::PARAM_STR);
            $configurazione->bindParam(2, $request->get('codice_fiscale'), PDO::PARAM_STR);
            $configurazione->bindParam(3, $request->get('partita_iva'), PDO::PARAM_STR);
            $configurazione->bindParam(4, $request->get('indirizzo'), PDO::PARAM_STR);
            $configurazione->bindParam(5, $request->get('cap'), PDO::PARAM_STR);
            $configurazione->bindParam(6, $request->get('citta'), PDO::PARAM_STR);
            $configurazione->bindParam(7, $request->get('provincia'), PDO::PARAM_STR);
            $configurazione->bindParam(8, $request->get('telefono'), PDO::PARAM_STR);
            $configurazione->bindParam(9, $request->get('fax'), PDO::PARAM_STR);
            $configurazione->bindParam(10, $request->get('email'), PDO::PARAM_STR);
            $configurazione->bindParam(11, $request->get('pie_di_pagina'), PDO::PARAM_STR);
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
            ), 500);
        }
    }
});

/**
 * Aggiungi Fattura
 */
$app->get('/aggiungi-fattura', function () use ($DB, $tpl) {

    $fatture = $DB->prepare('SELECT COUNT(numero) AS totale FROM fatture LIMIT 0,1');
    $fatture->execute();

    $clienti = $DB->prepare('SELECT * FROM clienti ORDER BY ragione_sociale ASC');
    $clienti->execute();

    $servizi = $DB->prepare('SELECT * FROM servizi ORDER BY pubblicazione DESC');
    $servizi->execute();

    $tpl->assign('fatture', $fatture->fetchColumn());
    $tpl->assign('clienti', $clienti->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('servizi', $servizi->fetchAll(PDO::FETCH_ASSOC));
    $tpl->assign('id', ID_RAND);
    $tpl->display('aggiungi-fattura.tpl');
    return false;
});

/**
 * POST Aggiungi Fattura
 * Aggiorno i dati nel database
 */
$app->post('/aggiungi-fattura', function (Request $request) use ($DB, $app) {

    $cliente    = $request->get('id_cliente');
    $id_cliente = $cliente == 0 ? ID_RAND : $cliente;
    $date       = new DateTime('NOW');

    try {

        $fatture = $DB->prepare('INSERT INTO fatture (id, numero, anno, emissione, oggetto, pagamento, note, id_cliente, pubblicazione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $fatture->bindParam(1, $request->get('id'), PDO::PARAM_INT);
        $fatture->bindParam(2, $request->get('numero'), PDO::PARAM_INT);
        $fatture->bindParam(3, $date->format('Y'));
        $fatture->bindParam(4, $request->get('emissione'), PDO::PARAM_STR);
        $fatture->bindParam(5, $request->get('oggetto'), PDO::PARAM_STR);
        $fatture->bindParam(6, $request->get('pagamento'), PDO::PARAM_STR);
        $fatture->bindParam(7, $request->get('note'), PDO::PARAM_STR);
        $fatture->bindParam(8, $id_cliente, PDO::PARAM_INT);
        $fatture->bindParam(9, $date->format('Y-m-d H:i:s'));
        $fatture->execute();

        if ($cliente == 0) {

            $clienti = $DB->prepare('INSERT INTO clienti (id, ragione_sociale, codice_fiscale, partita_iva, indirizzo, cap, citta, provincia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $clienti->bindParam(1, $id_cliente, PDO::PARAM_INT);
            $clienti->bindParam(2, $request->get('ragione_sociale'), PDO::PARAM_STR);
            $clienti->bindParam(3, $request->get('codice_fiscale'), PDO::PARAM_STR);
            $clienti->bindParam(4, $request->get('partita_iva'), PDO::PARAM_STR);
            $clienti->bindParam(5, $request->get('indirizzo'), PDO::PARAM_STR);
            $clienti->bindParam(6, $request->get('cap'), PDO::PARAM_STR);
            $clienti->bindParam(7, $request->get('citta'), PDO::PARAM_STR);
            $clienti->bindParam(8, $request->get('provincia'), PDO::PARAM_STR);

        } else {

            $clienti = $DB->prepare('UPDATE clienti SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ? WHERE id = ?');
            $clienti->bindParam(1, $request->get('ragione_sociale'), PDO::PARAM_STR);
            $clienti->bindParam(2, $request->get('codice_fiscale'), PDO::PARAM_STR);
            $clienti->bindParam(3, $request->get('partita_iva'), PDO::PARAM_STR);
            $clienti->bindParam(4, $request->get('indirizzo'), PDO::PARAM_STR);
            $clienti->bindParam(5, $request->get('cap'), PDO::PARAM_STR);
            $clienti->bindParam(6, $request->get('citta'), PDO::PARAM_STR);
            $clienti->bindParam(7, $request->get('provincia'), PDO::PARAM_STR);
            $clienti->bindParam(8, $id_cliente, PDO::PARAM_INT);
        }

        $clienti->execute();

        /**
         * UPDATE Servizi
         */
        $servizi = $DB->prepare('UPDATE servizi SET attivo = 1 WHERE id_fattura = ? AND attivo = 0');
        $servizi->bindParam(1, $request->get('id'), PDO::PARAM_INT);
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
        ), 500);
    }

});

/**
 * POST Aggiungi Servizio
 * Aggiorno i dati nel database
 */
$app->post('/aggiungi-servizi', function (Request $request) use ($DB, $app) {

    try {

        $date = new DateTime('NOW');

        $servizi = $DB->prepare('INSERT INTO servizi (id, codice, descrizione, quantita, prezzo, totale, iva, id_fattura, attivo, pubblicazione) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?)');
        $servizi->bindValue(1, ID_RAND);
        $servizi->bindParam(2, $request->get('codice'), PDO::PARAM_STR);
        $servizi->bindParam(3, $request->get('descrizione'), PDO::PARAM_STR);
        $servizi->bindParam(4, $request->get('quantita'), PDO::PARAM_INT);
        $servizi->bindParam(5, $request->get('prezzo'), PDO::PARAM_STR);
        $servizi->bindValue(6, ($request->get('prezzo') * $request->get('quantita')), PDO::PARAM_STR);
        $servizi->bindParam(7, $request->get('iva'), PDO::PARAM_INT);
        $servizi->bindParam(8, $request->get('id_fattura'), PDO::PARAM_INT);
        $servizi->bindParam(9, $date->format('Y-m-d H:i:s'));
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
        ), 500);
    }
});

/**
 * Servizi fattura JSON
 */
$app->get('/servizi/{fattura}.json', function ($fattura) use ($DB, $app) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id_fattura = ? ORDER BY pubblicazione DESC');
    $servizi->bindParam(1, $fattura, PDO::PARAM_INT);
    $servizi->execute();

    $obj = array();
    foreach ($servizi->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $obj[] = array(
            'id' => $row['id'],
            'codice' => $row['codice'],
            'descrizione' => sprintf('%s...', substr($row['descrizione'], 0, 17)),
            'prezzo' => $row['prezzo'],
            'quantita' => $row['quantita'],
            'totale' => $row['totale'],
            'iva' => sprintf('%d%%', $row['iva'])
        );
    }
    return $app->json(array('aaData' => $obj));
});

/**
 * Cliente JSON
 */
$app->post('/cliente', function (Request $request) use ($DB, $app) {

    $clienti = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $clienti->bindParam(1, $request->get('id'), PDO::PARAM_INT);
    $clienti->execute();
    return $app->json($clienti->fetch(PDO::FETCH_ASSOC));
});

/**
 * Servizio JSON
 */
$app->post('/servizio', function (Request $request) use ($DB, $app) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id = ? LIMIT 0,1');
    $servizi->bindParam(1, $request->get('id'), PDO::PARAM_INT);
    $servizi->execute();
    return $app->json($servizi->fetch(PDO::FETCH_ASSOC));
});

/**
 * Modifico la Fattura
 */
$app->get('/modifica-fattura/{id}', function ($id) use ($DB, $tpl) {

    $fatture = $DB->prepare('SELECT * FROM fatture WHERE id = ? LIMIT 0,1');
    $fatture->bindParam(1, $id, PDO::PARAM_INT);
    $fatture->execute();
    $row = $fatture->fetch(PDO::FETCH_ASSOC);

    $cliente = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $cliente->bindParam(1, $row['id_cliente'], PDO::PARAM_INT);
    $cliente->execute();

    $clienti = $DB->prepare('SELECT * FROM clienti ORDER BY ragione_sociale ASC');
    $clienti->execute();

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE attivo = 1 ORDER BY pubblicazione DESC');
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
 * Aggiorno i dati nel database
 */
$app->post('/modifica-fattura/{id}', function ($id, Request $request) use ($DB, $app) {

    try {

        $date = new DateTime('NOW');

        $fatture = $DB->prepare('UPDATE fatture SET numero = ?, emissione = ?, oggetto = ?, pagamento = ?, note = ?, id_cliente = ? , pubblicazione = ? WHERE id = ?');
        $fatture->bindParam(1, $request->get('numero'), PDO::PARAM_INT);
        $fatture->bindParam(2, $request->get('emissione'), PDO::PARAM_STR);
        $fatture->bindParam(3, $request->get('oggetto'), PDO::PARAM_STR);
        $fatture->bindParam(4, $request->get('pagamento'), PDO::PARAM_STR);
        $fatture->bindParam(5, $request->get('note'), PDO::PARAM_STR);
        $fatture->bindParam(6, $request->get('id_cliente'), PDO::PARAM_INT);
        $fatture->bindParam(7, $date->format('Y-m-d H:i:s'));
        $fatture->bindParam(8, $id, PDO::PARAM_INT);
        $fatture->execute();

        $clienti = $DB->prepare('UPDATE clienti SET ragione_sociale = ?, codice_fiscale = ?, partita_iva = ?, indirizzo = ?, cap = ?, citta = ?, provincia = ? WHERE id = ?');
        $clienti->bindParam(1, $request->get('ragione_sociale'), PDO::PARAM_STR);
        $clienti->bindParam(2, $request->get('codice_fiscale'), PDO::PARAM_STR);
        $clienti->bindParam(3, $request->get('partita_iva'), PDO::PARAM_STR);
        $clienti->bindParam(4, $request->get('indirizzo'), PDO::PARAM_STR);
        $clienti->bindParam(5, $request->get('cap'), PDO::PARAM_STR);
        $clienti->bindParam(6, $request->get('citta'), PDO::PARAM_STR);
        $clienti->bindParam(7, $request->get('provincia'), PDO::PARAM_STR);
        $clienti->bindParam(8, $request->get('id_cliente'), PDO::PARAM_INT);
        $clienti->execute();

        /**
         * UPDATE Servizi
         */
        $servizi = $DB->prepare('UPDATE servizi SET attivo = 1 WHERE id_fattura = ? AND attivo = 0');
        $servizi->bindParam(1, $id, PDO::PARAM_INT);
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
        ), 500);
    }
});

/**
 * Modifica Servizi
 */
$app->get('/modifica-servizi/{id}', function ($id) use ($DB, $tpl) {

    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id = ? LIMIT 0,1');
    $servizi->bindParam(1, $id, PDO::PARAM_INT);
    $servizi->execute();

    $tpl->assign('servizi', $servizi->fetch(PDO::FETCH_ASSOC));
    $tpl->display('modifica-servizi.tpl');
    return false;
});

/**
 * POST Modifica Servizi
 * Aggiorno i dati nel database
 */
$app->post('/modifica-servizi', function (Request $request) use ($DB, $app) {

    try {

        $date = new DateTime('NOW');

        switch ($request->get('action')) {

            case 1:
                $servizi = $DB->prepare('UPDATE servizi SET codice = ?, descrizione = ?, quantita = ?, prezzo = ?, totale = ?, iva = ?, pubblicazione = ? WHERE id = ?');
                $servizi->bindParam(1, $request->get('codice'), PDO::PARAM_STR);
                $servizi->bindParam(2, $request->get('descrizione'), PDO::PARAM_STR);
                $servizi->bindParam(3, $request->get('quantita'), PDO::PARAM_INT);
                $servizi->bindParam(4, $request->get('prezzo'), PDO::PARAM_STR);
                $servizi->bindValue(5, ($request->get('prezzo') * $request->get('quantita')), PDO::PARAM_STR);
                $servizi->bindParam(6, $request->get('iva'), PDO::PARAM_INT);
                $servizi->bindParam(7, $date->format('Y-m-d H:i:s'));
                $servizi->bindParam(8, $request->get('id'), PDO::PARAM_INT);
                $servizi->execute();
                break;

            case 2:
                $servizi = $DB->prepare('UPDATE servizi SET id_fattura = 0, attivo = 0 WHERE id = ?');
                $servizi->bindParam(1, $request->get('id'), PDO::PARAM_INT);
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
        ), 500);
    }
});

/**
 * Elimino la fattura
 */
$app->get('/elimina-fattura/{id}', function ($id) use ($DB, $app) {

    $fatture = $DB->prepare('DELETE FROM fatture WHERE id = ?');
    $fatture->bindParam(1, $id, PDO::PARAM_INT);
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
     * SELECT configurazione
     */
    $configurazione = $DB->prepare('SELECT * FROM configurazione LIMIT 0,1');
    $configurazione->execute();

    /**
     * SELECT fatture
     */
    $fatture = $DB->prepare('SELECT * FROM fatture WHERE id = ? LIMIT 0,1');
    $fatture->bindParam(1, $id, PDO::PARAM_INT);
    $fatture->execute();
    $row = $fatture->fetch(PDO::FETCH_ASSOC);

    /**
     * SELECT clienti
     */
    $clienti = $DB->prepare('SELECT * FROM clienti WHERE id = ? LIMIT 0,1');
    $clienti->bindParam(1, $row['id_cliente'], PDO::PARAM_INT);
    $clienti->execute();

    /**
     * SELECT servizi
     */
    $servizi = $DB->prepare('SELECT * FROM servizi WHERE id_fattura = ?');
    $servizi->bindParam(1, $row['id'], PDO::PARAM_INT);
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