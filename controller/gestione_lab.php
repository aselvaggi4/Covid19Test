<?php 

require_once('model/laboratori_db.php');
require_once('model/user_db.php');

class LaboratorioController {
    //Registra laboratorio nel database dei lab, e lo registra come utente tipo 4
    function registraLaboratorio($regione, $provincia, $citta, $via, $iva, $lab_email, $nome, $lab_psw) {
        
        $lab = new Utente();
        $setLab = new Laboratorio();
        
        $risultato  = $setLab->setLaboratori($lab_email, $lab_psw, $regione, $provincia, $citta, $via, $iva, $nome);
        echo $risultato."<br><br>";
        if($risultato !== false) {
            
            $tipo_utente = 4;
            $cognome = " ";
            $identificatore = " ";
            $cap = " ";
            $tel = " ";
        
            $controllo = $lab->setUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $via, $identificatore, $tel, $lab_email, $lab_psw);
            echo "<span style='color:red'>".$controllo."</span>";

            if ($controllo !== 0) {
                $res = $lab->getUtente($lab_email, $lab_psw);
                $lab->validaSessione($tipo_utente, $res->id, $lab_email, $nome);
                return true;
    
            } else {
                throw new Exception("Email esistente!");
            }
        } 
    }

    function ricercaLaboratori($regione, $provincia, $citta, $data) {
        $ricercaLab = new Laboratorio();

        $laboratori = $ricercaLab->getLaboratori($regione, $provincia, $citta, $data);
        
        if($laboratori) {
            return $laboratori;
        } else {
            return false;
        }
    }

}


?>