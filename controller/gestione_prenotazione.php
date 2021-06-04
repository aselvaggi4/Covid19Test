<?php
require_once('model/db.php');
require_once('model/prenotazione_db.php');
require_once('gestione_tampone.php');
require_once('gestione_utente.php');

class PrenotazioneController {
    
    function creaPrenotazione($utente, $tipo_test, $data, $orario, $laboratorio) {
        
        $tipo_prenotazione = "singola";
        //prenotazione riceverà l'id appena inserito
        $prenotazione = new Prenotazione();
        $prenotazione->nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $utente, $data);
        $tampone = new TamponeController();

        $tampone->creaTampone($prenotazione->id_inserito, $utente, $laboratorio, $data, $orario);
    }

    function creaPrenotazioneMultipla($prenotante, $tipo_test, $data, $laboratorio, $prenotanti) {
        
        $tipo_prenotazione = "multipla";
        //Prenotazione restituisce l'id appena inserito
        $prenotazione = new Prenotazione();
        $prenotazione->nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $prenotante, $data);
        
        $tampone = new TamponeController();
        // Per ogni prenotante (Gli viene passato un array multidimensionale contenente i dati di ogni persona prenotata)
        // Controlla se l'utente esiste, se non esiste lo registra automaticamente
        // Crea un record in Tampone nel DB
        foreach($prenotanti as $persona) {

            $utente = new UtenteController();
            //Funzione omessa dal diagramma di sequenza per eccessiva complessità e specificità
            // Viene restituito l'id dell'utente appena inserito nel db
            $id_utente = $utente->utenteEsistente($persona['email'], $persona['CF'], $persona['nome'], $persona['cognome']);
            
            $tampone->creaTampone($prenotazione->id_inserito, $id_utente, $laboratorio, $data, $persona['orario']);
        }
    }

    function controllaPrenotazione($idPrenotazione) {
        global $db;
        $prenotazione = new Prenotazione();

        $query = "SELECT * FROM tampone WHERE prenotazione = '$idPrenotazione'";

        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();

        if($count == 0) {
            $prenotazione->eliminaPrenotazione($idPrenotazione);
        }
    }
    //Funzione che restituisce la prenotazione di un azienda
    function prenotazioniUtente($azienda) {
        $prenotazione = new Prenotazione();
        $prenotazioniAzienda = $prenotazione->trovaPrenotazioniUtente($azienda);

        if($prenotazioniAzienda == false) {
            return false;
        } else {
            $tamponiDipendenti = array();
            $tampone = new Tampone();
            foreach($prenotazioniAzienda as $prenotazioneAzienda) {
                $tamponiDipendenti = $tampone->trovaTamponi($prenotazioneAzienda["id"]);
            }
            return $tamponiDipendenti;
        }
    }
}

// Tutte le prenotazioni effettuate da un utente di tipo 2
    // Trovare id dell'utente
    // Trovare prenotazione da quell'id
// Tutte quelle prenotazioni --> Tamponi di ogni prenotazione 
    // Trovare id dell'utente di un dato tampone
    // Mostrare i dati
// Ordine cronologico
// Divisi in "in corso" e "completati";