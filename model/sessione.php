<?php

class Sessione {
    
    public $tipo_utente;
    public $id;
    public $email;
    public $nome;

    public function __construct($tipo_utente, $id, $email, $nome) {
        
        $_SESSION['valid'] = true;
        $_SESSION["tipo_utente"] = $tipo_utente;
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;

    }
}

?>