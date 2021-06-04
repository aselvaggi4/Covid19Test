<?php include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
    require_once('controller/gestione_tampone.php');

    if(!isset($_SESSION['valid'])) {
        header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <?php 
   
   include("head-include.php"); 
 

   ?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("view/navbar.php");
   
   // Check delle variabili di sessione
   //var_dump($_SESSION); 
   $tamponeController = new TamponeController();

   $tamponi = $tamponeController->mostraTamponi($_SESSION['id']);
   
   ?>
<div class="container"style="margin-top:1.5rem;">
    <div class="row dashboard-card">
        
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Laboratorio</th>
                        <th scope="col">Data</th>
                        <th scope="col">Orario</th>
                        <th scope="col">Stato</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                    $contatore = 1;
                foreach($tamponi as $tampone) {
                    echo '<tr class="clickable-row" data-href="prenotazione?pren='.$tampone["id"].'">
                    <th scope="row">'.$contatore.'</th>
                    
                    <td>'.$tampone["nome"].'</td>
                    <td>'.$tampone["data"].'</td>
                    <td>'.$tampone["orario"].'</td>
                    <td>'.$tampone["stato"].'</td>
                    </tr>';
                    $contatore++;
                }
                
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include ("footer-include.php"); ?>
    <script>
    
    jQuery(document).ready(function($) {
        
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
    });
    
    </script>

</body>

</html>