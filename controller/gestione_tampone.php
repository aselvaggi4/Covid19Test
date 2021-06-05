<?php
require_once('model/tampone_db.php');
require_once('model/anamnesi_db.php');
require_once('gestione_prenotazione.php');

class TamponeController {
    
    function creaTampone($prenotazione, $utente, $laboratorio, $data, $orario) {
        
        $tampone = new Tampone();
        $tampone->setTampone($prenotazione, $utente, $laboratorio, $data, $orario);
        
    }

    function aggiungiAnamnesi($file, $tampone) {

        $anamnesi = new Anamnesi($file, $tampone);
        
       $aggiornaStato=new Tampone();
       $aggiornaStato->statoTampone("Anamnesi caricata", $tampone);
    }

    // getTamponi deve restituirci l'id del tampone di un determinato utente
    function mostraTamponi($utente) {
        $tampone = new Tampone();
        $tamponi = $tampone->getTamponi($utente);
        return $tamponi;
    }
    
    function datiTampone($id, $utente) {
        $tampone = new Tampone();
        $infoTampone = $tampone->mostraTampone($id, $utente);

        if($infoTampone == false) {
            return "Errore, riprova!";
        } else {
            return $infoTampone;
        }
    }
    // annullaTampone chiamerà il metodo eliminaTampone per rimuovere dal db il record del tampone
    function annullaTampone($id, $idPrenotazione) {
        $tampone = new Tampone();
        $tampone->eliminaTampone($id);

        $prenotazione = new PrenotazioneController();
        $prenotazione->controllaPrenotazione($idPrenotazione);

    }
    //mostraPrenotazione restituirà tutti i tamponi contenuti in una prenotazione
    // aggiungere seq. diagram controllo in cui la prenotazione non esiste 
    function mostraPrenotazione($prenotazione) {
        $query = "SELECT * FROM tampone t JOIN prenotazioni p ON t.prenotazione = id";
    }
}