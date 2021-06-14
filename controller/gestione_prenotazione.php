<?php
require_once('model/db.php');
require_once('model/prenotazione_db.php');
require_once('gestione_tampone.php');
require_once('gestione_utente.php');
require_once('gestione_lab.php');

class PrenotazioneController {
    
    function creaPrenotazione($utente, $tipo_test, $data, $orario, $laboratorio, $costo) {
        
        $tipo_prenotazione = "singola";
        //prenotazione riceverà l'id appena inserito
        $prenotazione = new Prenotazione();
        $prenotazione->nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $utente, $data, $costo);
        
        $tampone = new TamponeController();
        $tampone->creaTampone($prenotazione->id_inserito, $utente, $laboratorio, $data, $orario);

    }

    function creaPrenotazioneMultipla($prenotante, $tipo_test, $data, $laboratorio, $prenotanti, $costo) {
        
        $tipo_prenotazione = "multipla";
        //Prenotazione restituisce l'id appena inserito
        $prenotazione = new Prenotazione();
        $prenotazione->nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $prenotante, $data, $costo);
        
        $tampone = new TamponeController();
        // Per ogni prenotante (Gli viene passato un array multidimensionale contenente i dati di ogni persona prenotata)
        // Controlla se l'utente esiste, se non esiste lo registra automaticamente
        // Crea un record in Tampone nel DB
        foreach($prenotanti as $persona) {

            $utente = new UtenteController();
            //Aggiungere dati regione, città e telefono in utenteEsistente
            //Funzione omessa dal diagramma di sequenza per eccessiva complessità e specificità
            // Viene restituito l'id dell'utente appena inserito nel db
            $id_utente = $utente->utenteEsistente($persona['email'], $persona['CF'], $persona['nome'], $persona['cognome'], $persona['regione'], $persona['citta'], $persona['telefono']);
            
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
    function prenotazioniUtente($prenotante) {
        $prenotazione = new Prenotazione();
        $prenotazioniUtente = $prenotazione->trovaPrenotazioniUtente($prenotante);

        if($prenotazioniUtente == false) {
            return false;
        } else {
            $tamponiDipendenti = array();
            $tampone = new Tampone();
            
            foreach($prenotazioniUtente as $prenotazioneUtente) {
                $tamponiDipendenti[] = $tampone->trovaTamponi($prenotazioneUtente["id"]);
            }
            return $tamponiDipendenti;
        }
    }

    function prenotazioniLaboratorio() {
        // Trova l'id del laboratorio;
        $lab = new LaboratorioController();
        $laboratorio = $lab->idLaboratorio();

        $prenotazione = new Prenotazione();
        $prenotazioni = $prenotazione->trovaPrenotazioniLaboratorio($laboratorio['id']);
        
        if($prenotazioni == false) {
            return false;
        } else {
            $tamponiLaboratorio = array();
            $tampone = new Tampone();
            foreach($prenotazioni as $prenotazione) {
                $tamponiLaboratorio[] = $tampone->trovaTamponi($prenotazione['id']);
            }
            return $tamponiLaboratorio; 
        }
    }
}
