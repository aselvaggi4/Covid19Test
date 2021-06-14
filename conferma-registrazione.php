<?php include("sessioni.php"); 
    require_once('controller/gestione_utente.php');
    require_once('controller/gestione_lab.php');

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

   <?php include ("view/navbar.php"); ?>

    <?php 
    $gestioneUtente = new UtenteController();
    
    try {
        // Se il tipo utente è qualsiasi MA NON Laboratorio
        if($_POST['tipo_utente'] != 4) {
            $gestioneUtente->registrazioneUtente($_POST['tipo_utente'], $_POST['nome'], $_POST['cognome'], $_POST['citta'], $_POST['provincia'], 
            $_POST['cap'],$_POST['regione'], $_POST['indirizzo'], $_POST['CF'], $_POST['tel'], $_POST['email'], $_POST['password']);

            $caught = false;   
            $registrazioneLab = 5;
            // Altrimenti registra il laboratorio
        } else if ($_POST['tipo_utente'] == 4) {
            if($_FILES['immagine_lab']['name']){
                move_uploaded_file($_FILES['immagine_lab']['tmp_name'], "lab_img/".$_FILES['immagine_lab']['name']);
                $img="lab_img/".$_FILES['immagine_lab']['name'];
                $gestioneLab = new LaboratorioController();
                $registrazioneLab = $gestioneLab->registraLaboratorio($_POST['regione'],$_POST['provincia'], $_POST['citta'],$_POST['indirizzo'],$_POST['iva'], $_POST['email'], $_POST['nome'], $_POST['password'], $img, $_POST['tel'], $_POST['costo_molecolare'], $_POST['costo_antigenico']);
                $caught = false;
            } else {
                $img = NULL;
                $gestioneLab = new LaboratorioController();
                $registrazioneLab = $gestioneLab->registraLaboratorio($_POST['regione'],$_POST['provincia'], $_POST['citta'],$_POST['indirizzo'],$_POST['iva'], $_POST['email'], $_POST['nome'], $_POST['password'], $img, $_POST['tel'], $_POST['costo_molecolare'], $_POST['costo_antigenico']);
                $caught = false; 
            }
        }

    } catch (Exception $e) {

        $caught = true;

    }

    if($caught == false && $registrazioneLab != false || $caught == false && $_POST['tipo_utente'] != 4) {
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
    else if ($caught == true) { ?>
        <div class="container">
        <div class="row" style="margin: auto 8%">
            <h2 class="centrato" style="margin:8% auto;">Email esistente, prova a registrarti con un altro indirizzo email</h2>
            <form action="index" class="centrato">
            <button type="button" class="btn btn-outline-danger" onclick="history.back()">TORNA ALLA REGISTRAZIONE</button>
            </form>
        </div>
   </div>
    <?php } else if($registrazioneLab == false && $_POST['tipo_utente'] == 4) { ?>
        <div class="container">
        <div class="row" style="margin: auto 8%">
            <h2 class="centrato" style="margin:8% auto;">Non è stato trovato l'indirizzo inserito, prova a scriverlo senza abbreviazioni.</h2>
            <br>
            <h3 class="centrato m-3 p-3">Inserisci l'indirizzo senza virgole tra la via ed il numero.</h3>
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