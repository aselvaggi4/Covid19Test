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
    private $costo;
    
    //Modificare il costruttore di Prenotazione
   
    function nuovaPrenotazione($laboratorio, $tipo_test, $tipo_prenotazione, $utente, $data, $costo){
        
        global $db;
        
        $this->laboratorio = $laboratorio;
        $this-> tipo_prenotazione = $tipo_prenotazione;
        $this->utente = $utente;
        $this->data = $data;
        $this->tipo_test = $tipo_test;
        $this->costo = $costo;
   
        $query = "INSERT INTO prenotazioni (laboratorio, tipo_prenotazione, prenotante, tipo_test, data, costo) VALUES ('$this->laboratorio','$this->tipo_prenotazione', '$this->utente', '$this->tipo_test', '$this->data', '$this->costo')";
    
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

    function trovaPrenotazioniUtente($prenotante) {
        global $db;
        $this->utente = $prenotante;
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
        $query = "SELECT * FROM prenotazioni WHERE laboratorio = '$this->laboratorio' AND tipo_test <> 'NULL'";

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