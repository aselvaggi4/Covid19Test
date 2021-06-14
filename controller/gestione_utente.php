<?php 

require_once('model/user_db.php');

class UtenteController {

    function loginUtente($usr, $psw) {
        
        $utente = new Utente();

        $risultato = $utente->getUtente($usr, $psw);
        
        if($risultato !== false) {
            $utente->validaSessione(
                $risultato->tipo_utente, 
                $risultato->id, 
                $risultato->email, 
                $risultato->nome,
                $risultato->cognome
            );
        } else {
            return false;
        }
    }

    function registrazioneUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $regione ,$indirizzo, $CF, $tel, $user_email, $user_psw) {
        
        $utente = new Utente();

        $check = $utente->setUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $regione, $indirizzo, $CF, $tel, $user_email, $user_psw);

        if ($check == true) {
            $result = $utente->getUtente($user_email, $user_psw);
            $utente->validaSessione($tipo_utente, $result->id, $user_email, $nome, $cognome);
            return true;

        } else {

            throw new Exception("Email esistente!");

        }
    }

    function utenteEsistente($email, $CF, $nome, $cognome, $regione, $citta, $telefono) {

        $utente = new Utente();

        $risultato = $utente->trovaUtente($email);
        
        if($risultato == false) {

            $password = $utente->generaPassword();
            // Aggiungi anche città regione e telefono
            $utenteInserito = $utente->registraUtente($email,$password, $CF, $nome, $cognome, $regione, $citta, $telefono);

            // Invia un email con la password appena registrata 
            $utente->emailRegistrazione($email, $password, $nome, $cognome);
            
            return $utenteInserito;
        } else {
            return $risultato->id;
        }
    }
}



?>