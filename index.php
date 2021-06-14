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


<body>

   <?php include ("view/navbar.php");
   
   // Check delle variabili di sessione
   //var_dump($_SESSION); ?>

   <div class="row ricerca">
      <div class="container-fluid ">

         <div class="col barra-ricerca">
            <?php  include("view/cerca-laboratorio.php"); ?>
         </div>

      </div>
   </div>
   <div class="container">
      <div class="row" id="faq" style="padding-top:50px;">
         <?php include("view/faq.php");?>
      </div>
   </div>
   <?php include ("footer-include.php");
  

   ?>

<script></script>
</body>

</html>