<?php

class Sessioni {

    function __construct($tipo_utente, $id, $nome, $email)
    {
        $_SESSION['valid'] = true;
        $_SESSION["tipo_utente"] = $tipo_utente;
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
        $_SESSION["nome"] = $nome;

    }
}