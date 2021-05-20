<?php include("sessioni.php"); 
    require_once('controller/gestione_utente.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrazione completata</title>

   <?php 
   
   include("head-include.php"); 
   
   ?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

   <?php include ("navbar.php"); ?>

    <?php 
    
    $gestioneUtente = new UtenteController();
    
    try {
        $gestioneUtente->registrazioneUtente($_POST['tipo_utente'], $_POST['nome'], $_POST['cognome'], $_POST['citta'], $_POST['provincia'], 
        $_POST['cap'], $_POST['indirizzo'], $_POST['CF'], $_POST['tel'], $_POST['email'], $_POST['password']);

        $caught = false;

    } catch (Exception $e) {
        
        $caught = true;
    
    }

    if($caught == false) {
    ?>
   <div class="container">
        <div class="row" style="margin: auto 8%">
            <h2 class="centrato" style="margin:8% auto;">Registrazione completata con successo, potrai eseguire l'accesso con l'email e la password selezionata!</h2>
            <form action="index" class="centrato">
                <button type="submit" class="btn btn-outline-primary" style="padding:10px;">TORNA ALL'HOMEPAGE</button>
            </form>
        </div>
   </div>

   <?php } 
    else { ?>
        <div class="container">
        <div class="row" style="margin: auto 8%">
            <h2 class="centrato" style="margin:8% auto;">Email esistente, prova a registrarti con un altro indirizzo email</h2>
            <form action="index" class="centrato">
            <button type="button" class="btn btn-outline-danger" onclick="history.back()">TORNA ALLA REGISTRAZIONE</button>
            </form>
        </div>
   </div>
    <?php }
   
   include ("footer-include.php");
  

   ?>

</body>

</html>