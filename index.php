<?php include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <?php 
   
   include("head-include.php"); 
   
    $page_id = 0;

   ?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

   <?php include ("view/navbar.php");
   
   // Check delle variabili di sessione
   //var_dump($_SESSION); ?>

   <div class="row ricerca">
      <div class="container-fluid ">

         <div class="col barra-ricerca">
            <?php  include("cerca-laboratorio.php"); ?>
         </div>

      </div>
   </div>
   <div class="container">
      <div class="row" style="padding-top:50px;">
         <div class="col-md-4 white-text centrato " >
            <i class="fas fa-user-secret " style="font-size:60px;"></i>
            <h3 style="margin:15px;">PRIVACY</h3>
            <p >Covid-19 Test Booking adotta adeguate misure di sicurezza per proteggere la privacy di ogni utente.</p>
         </div>
         <div class="col-md-4 white-text centrato" >
            <i class="fas fa-user-secret " style="font-size:60px;"></i>
            <h3 style="margin:15px;">TESTO</h3>
            <p>Altro Testo da scrivere qui</p>
         </div>
         <div class="col-md-4 white-text centrato" >
            <i class="fas fa-user-secret " style="font-size:60px;"></i>
            <h3 style="margin:15px;">TESTO</h3>
            <p>Altro Testo da scrivere qui</p>
         </div>
      </div>
   </div>
   <?php include ("footer-include.php");
  

   ?>

</body>

</html>