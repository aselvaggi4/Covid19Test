<?php 
    require_once('db.php');

    function getUser($user_email, $user_psw) {
        
        global $db;

        $query = "SELECT id, tipo_utente, nome, email, password 
        FROM utente WHERE email = '$user_email' AND password = '$user_psw'";

        $statement = $db->prepare($query);
        
        $statement->execute();
        
        $count = $statement->rowCount();
        if($count > 0) {

            $result = $statement->fetch(PDO::FETCH_LAZY);
            return $result;

        } else {
            return false;
        }
        
    }

    function validateSession($tipo_utente, $id, $email, $nome) {

        $_SESSION['valid'] = true;
        $_SESSION["tipo_utente"] = $tipo_utente;
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;

    }

    function registerUser($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $indirizzo, $CF, $tel, $user_email, $user_psw) {
        global $db;

        $sql = "SELECT * FROM utente WHERE email = '$user_email'";
        $check = $db->prepare($sql);
        $check->execute();

        $count = $check->rowCount(); 

        if($count == 0) {
            if ($tipo_utente == 1 ) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, CF, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$CF', '$user_email', '$user_psw')";
            } else if($tipo_utente == 2) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, IVA, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$CF', '$user_email', '$user_psw')";        
            } else if($tipo_utente == 3) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, Codice_regionale, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$CF', '$user_email', '$user_psw')";
            }
            $statement = $db->prepare($query);
            $statement->execute();
            return true;

        } else {
            return false;
        }

        
    }

?>