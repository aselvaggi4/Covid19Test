<?php 

require_once('model/user_db.php');

class GestioneUtente {

    function loginUtente($usr, $psw) {
        
        $result = getUser($usr, $psw);
        echo $result;
        if($result !== false) {
            validateSession(
                $result->tipo_utente, 
                $result->id, 
                $result->email, 
                $result->nome
            );
        } else {
            throw new Exception("Dati errati!");
        }
    }

    function registrazioneUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $indirizzo, $CF, $tel, $user_email, $user_psw) {
        
        $check = registerUser($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $indirizzo, $CF, $tel, $user_email, $user_psw);

        if ($check == true) {
            $result = getUser($user_email, $user_psw);
            validateSession($tipo_utente, $result->id, $user_email, $nome);
            return true;

        } else {

            throw new Exception("Email esistente!");

        }
    }

}



?>