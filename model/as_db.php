<?php
require_once('db.php');

class AziendaSanitaria {

    private $mese;

    function trovaPanoramica($mese) {
        global $db;
        $this->mese = $mese;
        $anno = date("Y");
        
        $query1 = "SELECT COUNT(t.id) AS negativi, l.regione FROM tampone t JOIN laboratori l ON laboratorio = l.id WHERE MONTH(t.data) = '$this->mese' AND YEAR(t.data) = '$anno' AND t.stato ='completato' AND esito='negativo' GROUP BY l.regione";
        $statement = $db->prepare($query1);
        $statement->execute();

        $count = $statement->rowCount();
        $listaNegativi = array();
        $lista = array();

        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $listaNegativi[] = $row;
            }
            $lista[] = $listaNegativi;
        } 

        $query2 = "SELECT COUNT(t.id) AS positivi, l.regione FROM tampone t JOIN laboratori l ON laboratorio = l.id WHERE MONTH(t.data) = '$this->mese' AND YEAR(t.data) = '$anno' AND t.stato ='completato' AND esito='positivo' GROUP BY l.regione";
        $statement = $db->prepare($query2);
        $statement->execute();

        $count = $statement->rowCount(); 
        $listaPositivi = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $listaPositivi[] = $row;
            }
            $lista[] = $listaPositivi;
        }
        if(empty($lista)) {
            return false;
        } else {
            return $lista;
            
        }
    }

    function trovaEsiti() {
        global $db;
        $query1 = "SELECT COUNT(t.id) AS positivi, l.username, l.nome, l.regione, l.citta FROM tampone t JOIN laboratori l ON laboratorio = l.id WHERE t.stato = 'completato' AND t.esito = 'positivo' GROUP BY l.nome";
        
        $statement = $db->prepare($query1);
        $statement->execute();

        $count = $statement->rowCount();
        $laboratori = array();
        $positivi = array();

        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $positivi[] = $row;
            }
            $laboratori[] = $positivi;
        } 
        $query2 = "SELECT COUNT(t.id) AS negativi, l.username, l.nome, l.regione, l.citta FROM tampone t JOIN laboratori l ON laboratorio = l.id WHERE t.stato = 'completato' AND t.esito = 'negativo' GROUP BY l.nome";
        $statement = $db->prepare($query2);
        $statement->execute();

        $count = $statement->rowCount(); 
        $negativi = array();
        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $negativi[] = $row;
            }
            $laboratori[] = $negativi;
        }
        if(empty($laboratori)) {
            return false;
        } else {
            return $laboratori;
        }
    }

    function trovaPositivi() {
        global $db;

        $query = "SELECT  u.CF, u.nome, u.cognome, u.tel, u.regione, u.citta, u.email, t.id, t.data FROM utente u JOIN tampone t ON t.utente = u.id WHERE t.stato = 'completato' AND t.esito = 'positivo' ORDER BY t.data DESC LIMIT 200";
        $statement = $db->prepare($query);
        $statement->execute();

        $count = $statement->rowCount();

        $positivi = array();

        if($count > 0) {
            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $positivi[] = $row;
            }
            return $positivi;
        }
    }
}
