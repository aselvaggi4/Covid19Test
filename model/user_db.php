<?php 
    require_once('db.php');
    // Cerca utente nel DB / Login

class Utente {

    private $id;
    private $tipo_utente;
    private $nome;
    private $cognome;
    private $citta;
    private $provincia;
    private $cap;
    private $indirizzo;
    private $identificatore;
    private $telefono;
    private $email;
    private $password;


    function getUtente($user_email, $user_psw) {
        
        global $db;

        $this->email = $user_email;
        $this->password = $user_psw;

        $query = "SELECT id, tipo_utente, nome, email, cognome, password 
        FROM utente WHERE email = '$this->email' AND password = '$this->password'";

        $statement = $db->prepare($query);
        
        $statement->execute();
        
        $count = $statement->rowCount();

        if($count == 1) {

            $result = $statement->fetch(PDO::FETCH_LAZY);
            return $result;

        } else {
            return false;
        }
        
    }
    // Inizializza le variabili di sessione
    function validaSessione($tipo_utente, $id, $email, $nome, $cognome) {

        $_SESSION['valid'] = true;
        $_SESSION["tipo_utente"] = $tipo_utente;
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;
        $_SESSION["cognome"] = $cognome;

    }
    // Crea un utente
    function setUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $indirizzo, $identificatore, $tel, $user_email, $user_psw) {
        global $db;

        $this->tipo_utente = $tipo_utente;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->citta = $citta; 
        $this->provincia = $provincia;
        $this->cap = $cap;
        $this->indirizzo = $indirizzo;
        $this->identificatore = $identificatore;
        $this->telefono = $tel;
        $this->email = $user_email;
        $this->password = $user_psw;

        $sql = "SELECT * FROM utente WHERE email = '$user_email'";
        $check = $db->prepare($sql);
        $check->execute();

        $count = $check->rowCount(); 

        if($count == 0) {
            if ($tipo_utente == 1 ) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, CF, email, password) VALUES ('$this->tipo_utente','$this->nome', '$this->cognome', '$this->citta', '$this->provincia', '$this->cap', '$this->indirizzo', '$this->telefono', '$this->identificatore', '$this->email', '$this->password')";
            } else if($tipo_utente == 2) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, IVA, email, password) VALUES ('$this->tipo_utente','$this->nome', '$this->cognome', '$this->citta', '$this->provincia', '$this->cap', '$this->indirizzo', '$this->telefono', '$this->identificatore', '$this->email', '$this->password')";        
            } else if($tipo_utente == 3) {
                $query = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, Codice_regionale, email, password) VALUES ('$this->tipo_utente','$this->nome', '$this->cognome', '$this->citta', '$this->provincia', '$this->cap', '$this->indirizzo', '$this->telefono', '$this->identificatore', '$this->email', '$this->password')";
            } else if($tipo_utente == 4) {
                $query = "INSERT INTO utente (tipo_utente, Nome, citta, provincia, cap, Indirizzo, tel, email, password) VALUES ('$this->tipo_utente', '$this->nome', '$this->citta', '$this->provincia', '$this->cap', '$this->indirizzo', '$this->telefono', '$this->email', '$this->password')";
            }
            $statement = $db->prepare($query);
            $statement->execute();
            
            return true;

        } else {
            return false;
        } 
    }

    function trovaUtente($user_email) {
        
        global $db;
        $this->email = $user_email;
        $query = "SELECT id, email
        FROM utente WHERE email = '$this->email'";

        $statement = $db->prepare($query);
        
        $statement->execute();
        
        $count = $statement->rowCount();

        if($count == 1) {
            $result = $statement->fetch(PDO::FETCH_LAZY);
            return $result;
        } else {
            return false;
        }
    }
    // Registra un utente quando viene inserito da una prenotazione multipla / per terzi
    // Genera una password automatica
    function registraUtente($user_email, $user_psw, $identificatore, $nome, $cognome) {
        global $db;

        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->identificatore = $identificatore;
        $this->email = $user_email;
        $this->password = $user_psw;

        $query = "INSERT INTO utente (tipo_utente, password, nome, cognome, CF, email) VALUES ('1', '$this->password', '$this->nome', '$this->cognome', '$this->identificatore', '$this->email')";

        $check = $db->prepare($query);
        $check->execute();
        //Controlla l'id dell'ultimo utente inserito e lo restituisce
        $utenteInserito = $db->lastInsertId();
        return $utenteInserito;
    }
    // Genera password per un utente da registrare
    function generaPassword(){
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
    // Invia una email all'utente dopo averlo registrato
    function emailRegistrazione($user_email, $user_psw, $nome, $cognome) {
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->email = $user_email;
        $this->password = $user_psw;

        $to_email = $this->email;
            $subject = "Utente registrato presso la piattaforma";
            $body = "Ciao " .$this->nome." " . $this->cognome. " sei stato registrato automaticamente presso la piattaforma perchè qualcuno ha prenotato un test diagnostico per te!" . " Accedi alla piattaforma con questo indirizzo email e la tua nuova password: ". $this->password;
            $headers = "From: Covid19Test piattaforma";

            if (mail($to_email, $subject, $body, $headers)) {
                return true;
            } else {
                echo "Email sending failed...";
            }

    }

    function informazioniUtente($id) {
        global $db;
        $this->id = $id;
        $query = "SELECT * FROM utente WHERE id='$this->id'";

        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_LAZY);
        return $result;
    }
}


?>