<?php 

require_once('model/laboratori_db.php');
require_once('model/user_db.php');

class GestioneLaboratorio {
    //Registra laboratorio nel database dei lab, e lo registra come utente tipo 4
    function registraLaboratorio($regione, $provincia, $citta, $via, $iva, $lab_email, $nome, $lab_psw) {
        
        $risultato  = registerLab($lab_email, $lab_psw, $regione, $provincia, $citta, $via, $iva, $nome);
        echo $risultato."<br><br>";
        if($risultato !== false) {
            
            $tipo_utente = 4;
            $cognome = " ";
            $CF = " ";
            $cap = " ";
            $tel = " ";
        
            $controllo = registerUser($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $via, $CF, $tel, $lab_email, $lab_psw);
            echo "<span style='color:red'>".$controllo."</span>";

            if ($controllo !== 0) {
                $res = getUser($lab_email, $lab_psw);
                validateSession($tipo_utente, $res->id, $lab_email, $nome);
                return true;
    
            } else {
                throw new Exception("Email esistente!");
            }
        } 
    }


}


?>