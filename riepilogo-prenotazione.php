<?php include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
    require_once('controller/gestione_prenotazione.php');
    require_once('controller/gestione_lab.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <?php 
   
   include("head-include.php"); 
   
   ?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

   <?php include ("navbar.php"); ?>

   <div class="container">
   <div class="row pagina-riepilogo" style="color:black; text-align:center; margin:2rem; ">
         <?php

      $prenotazione = new PrenotazioneController();

      $laboratorio = new LaboratorioController();
      $datiLab = $laboratorio->trovaLab($_POST['laboratorio']);

      if($_POST['tipo'] == 'antigenico') {
         $prezzo = $datiLab -> costo_antigenico;
      } else if ($_POST['tipo'] == 'molecolare') {
         $prezzo = $datiLab -> costo_molecolare;
      }

      if(!isset($_POST['entry_id'])) {
        $orario = $_POST['data'] . " " . $_POST['orario'].":10:00";
        
        $prenotazione->creaPrenotazione($_SESSION['id'], $_POST['tipo'], $_POST['data'], $orario, $_POST['laboratorio']);
        // Stampa in caso di prenotazione singola
        echo '
        <div class="card shadow">
         <div class="card-header">
           <h3>Prenotazione completata</h3> 
        </div>
        <div class="card-body" style="margin:2rem;">
           <h5 class="card-title">Prenotazione presso '.  $datiLab->nome.'</h5> 
           <p class="card-text">La tua prenotazione presso il laboratorio' . $datiLab->nome . 'in '. $datiLab->via . ' è stata confermata per le ore: ' . $_POST["orario"] .'</p> 
           <p>Per un costo totale di: ' . $prezzo. ' €</p>
           <p>Ricorda di completare il <strong>questionario anamnestico</strong> prima del'. $_POST["data"].'</p>
           <a href="dashboard" class="btn btn-primary">COMPILA IL QUESTIONARIO</a>
        </div>
      </div>';

      }
      
      //Se è settata una variabile che indica la prenotazione multipla, cicla per ogni tampone
      else if (isset($_POST['entry_id'])) {
         // $prenotazione->creaPrenotazioneMultipla($_SESSION['id'])
         $prenotanti[] = array();
         $prezzoTot = 0;
         foreach ($_POST['entry_id'] as $key => $val) {

            $prenotanti[$key]['entry_id'] = $_POST['entry_id'][$key];
            $prenotanti[$key]['nome'] = $_POST['nome'][$key];
            $prenotanti[$key]['cognome'] = $_POST['cognome'][$key];
            $prenotanti[$key]['email'] = $_POST['email'][$key];
            $prenotanti[$key]['CF'] = $_POST['CF'][$key];
            $prenotanti[$key]['orario'] = $_POST['data']." ".$_POST['orario'][$key];
            //echo "Prenotazione per " . $entry_id . " " . $nome;
            $prezzoTot += $prezzo;
         }

         $prenotazione->creaPrenotazioneMultipla($_SESSION['id'], $_POST['tipo'], $_POST['data'],$_POST['laboratorio'], $prenotanti);
         
         echo '
         <div class="card shadow">
          <div class="card-header">
            <h3>Prenotazione completata</h3> 
         </div>
         <div class="card-body" style="margin:2rem;">
            <h5 class="card-title">Prenotazione presso '.  $datiLab->nome.'</h5>
            <br>
            <p class="card-text">La tua prenotazione presso il laboratorio ' . $datiLab->nome . ' in '. $datiLab->via . ' è stata confermata per la data: ' . $_POST["data"] .'</p> 
            <p><strong>Per un costo totale di: ' . $prezzoTot. ' €</strong></p>
            <p>È stata inviata una email a tutti i prenotanti <strong>non ancora registrati,</strong> contenente una password generata automaticamente.</p>
            <p>Ricorda a tutti i prenotanti di completare il <strong>questionario anamnestico</strong> accedendo alla loro dashboard prima del '. $_POST["data"].'</p>
            
         </div>
       </div>';
      }
        ?>
      </div>
   </div>

   <?php include ("footer-include.php");
  

   ?>

</body>

</html>