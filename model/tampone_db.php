<?php

require_once('db.php');

class Tampone {
    
    private $prenotazione;
    private $anamnesi;
    private $utente;
    private $medico;
    private $stato;
    private $orario;
    private $esito;
    private $data;
    private $id;

    
    function setTampone($prenotazione, $utente, $laboratorio, $data, $orario) {
        $this->laboratorio = $laboratorio;
        $this->utente = $utente;
        $this->orario = $orario;
        $this->prenotazione = $prenotazione;
        $this->data = $data;

        global $db;
        $query = "INSERT INTO tampone (prenotazione, utente, laboratorio, data, orario) VALUES ('$this->prenotazione','$this->utente','$this->laboratorio','$this->data', '$this->orario')";
    
        $statement = $db->prepare($query);
        $statement->execute();

        $id_inserito = $db->lastInsertId();

        $this->statoTampone("in corso", $id_inserito);
        
        return true;
    }

    function statoTampone($stato, $id) {
        $this->stato = $stato;
        $this->id = $id;

        global $db;
        $query = "UPDATE tampone SET stato = '$this->stato' WHERE id = '$this->id'";
        
        $statement = $db->prepare($query);
        $statement->execute();
    }
    // Funzione che mostra tutte le informazioni dei tamponi di un utente 
    function getTamponi($utente) {
        global $db;
        $this->utente = $utente;

        $query = "SELECT t.id, l.nome, t.stato, t.data, t.orario, t.esito FROM tampone t JOIN laboratori l ON t.laboratorio = l.id WHERE utente = '$this->utente' ORDER BY data";
       

        $statement = $db->prepare($query);
        $statement->execute();

        $count = $statement->rowCount(); 

        $tampone = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $tampone[] = $row;
            }
            return $tampone;
        } else {
            return false;
        }
    }

    function eliminaTampone($id) {
        global $db;
        $this->id = $id;
        $query = "DELETE FROM tampone WHERE id = '$id'";
        $statement = $db->prepare($query);
        $statement->execute();
    }
    //mostraTampone mostra le informazioni di uno specifico tampone
    //usata nella pagina Dashboard
    function mostraTampone($id, $utente) {
        
        $this->id = $id;
        $this->utente = $utente;
        global $db;
        if($_SESSION['tipo_utente'] == 4) {
            $query= "SELECT t.id, t.prenotazione, u.nome AS utente, u.cognome, u.CF, u.tel, u.email, l.nome, t.stato, t.data, t.orario, t.anamnesi, l.via FROM tampone t JOIN laboratori l ON t.laboratorio = l.id JOIN utente u ON t.utente = u.id WHERE t.id = '$this->id'";
        } else {
            $query= "SELECT t.id, t.prenotazione, u.nome AS utente, u.cognome, u.email, l.nome, t.stato, t.data, t.orario, t.anamnesi, l.via FROM tampone t JOIN laboratori l ON t.laboratorio = l.id JOIN utente u ON t.utente = u.id WHERE utente = '$this->utente' AND t.id = '$this->id'";
        }

        $statement = $db->prepare($query);
        $statement->execute();

        $count = $statement->rowCount(); 
        if($count == 1) {
            $datiTampone = $statement->fetch(PDO::FETCH_LAZY);
            return $datiTampone;
        } else {
            return false;
        }
    }
    // funzione che mostrerà tutti i tamponi all'interno di una prenotazione 
    function trovaTamponi($prenotazione) {
        global $db;
        $query = "SELECT t.id, u.nome AS utente, u.cognome, l.nome, t.stato, t.data, t.orario, t.esito FROM tampone t JOIN laboratori l ON t.laboratorio = l.id JOIN utente u ON t.utente = u.id  WHERE prenotazione = '$prenotazione' ORDER BY data";

        $statement = $db->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();

        $tamponi = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $tamponi[] = $row;
            }
            return $tamponi;
        }
    }
    // Inserisce esito tampone
    function esitoTampone($datiTampone, $esito) {
        global $db;
        $this->id = $datiTampone->id;
        $this->esito = $esito;

        $query = "UPDATE tampone SET esito = '$this->esito' WHERE id = '$datiTampone->id'";
        $statement = $db->prepare($query);
        $statement->execute();
        // Aggiorna lo stato a completato
        $this->statoTampone("completato", $this->id);
        $this->emailEsito($datiTampone, $this->esito);
    }

    function emailEsito($tampone, $esito) {
        $to_email = $tampone->email;
            $subject = "Esito tampone";
            $body = "Ciao " .$tampone->utente." " . $tampone->cognome. " . Ti scriviamo per comunicarti che è stato inserito l'esito del tuo tampone del: ". $tampone->data. ". L'esito è: " .$esito ;
            $headers = "From: Covid19Test piattaforma";

            if (mail($to_email, $subject, $body, $headers)) {
                return true;
            } else {
                echo "Email sending failed...";
            }

    }
}

?>