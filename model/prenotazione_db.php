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
    function __construct($laboratorio, $tipo_test, $tipo_prenotazione, $utente, $data) {

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
        $this->id = $id;
    }
}

?>