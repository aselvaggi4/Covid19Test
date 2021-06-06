<?php

require_once('db.php');

class Prenotazione {
    
    private $laboratorio;
    private $tipo_prenotazione;
    private $utente;
    private $data;
    private $tipo_test;
    public $id_inserito;
    public $id;
    
    //Modificare il costruttore di Prenotazione
   
    function nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $utente, $data){
        
        global $db;
        
        $this->laboratorio = $laboratorio;
        $this-> tipo_prenotazione = $tipo_prenotazione;
        $this->utente = $utente;
        $this->data = $data;
        $this->tipo_test = $tipo_test;
   
        $query = "INSERT INTO prenotazioni (laboratorio, tipo_prenotazione, prenotante, tipo_test, data) VALUES ('$this->laboratorio','$this->tipo_prenotazione', '$this->utente', '$this->tipo_test', '$this->data')";
    
        $statement = $db->prepare($query);
        $statement->execute();

        $id_inserito = $db->lastInsertId();

        $this->id_inserito = $id_inserito;

    }

    function eliminaPrenotazione($id) {
        global $db;
        
        $this->id = $id;
        
        $query = "DELETE FROM prenotazioni WHERE id = '$id'";
        $statement = $db->prepare($query);
        $statement->execute();

    }

    function trovaPrenotazioniUtente($azienda) {
        global $db;
        $this->utente = $azienda;
        $query = "SELECT * FROM prenotazioni WHERE prenotante = '$this->utente'";

        $statement = $db->prepare($query);
        $statement->execute();

        $count = $statement->rowCount(); 

        $prenotazioni = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $prenotazioni[] = $row;
            }
            //print_r($prenotazioni);
            return $prenotazioni;
        } else {
            return false;
        }
    }
    function trovaPrenotazioniLaboratorio($laboratorio) {
        global $db;
        $this->laboratorio = $laboratorio;
        $query = "SELECT * FROM prenotazioni WHERE laboratorio = '$this->laboratorio'";

        $statement = $db->prepare($query);
        $statement->execute();

        $count = $statement->rowCount(); 

        $prenotazioni = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $prenotazioni[] = $row;
            }
            return $prenotazioni;
        } else {
            return false;
        }
    }
}

?>