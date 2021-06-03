<?php
require_once('model/tampone_db.php');
require_once('model/anamnesi_db.php');

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
    // getTampone deve restituirci l'id del tampone di un determinato utente

    function mostraTamponi($utente) {
        $tampone = new Tampone();
        $tamponi = $tampone->getTampone($utente);
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
    
}