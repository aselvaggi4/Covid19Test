<?php include("sessioni.php"); ?>

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

   <?php include ("navbar.php"); ?>
   
   <?php 
   // Check delle variabili di sessione
   var_dump($_SESSION);?>

   <div class="row ricerca">
      <div class="container-fluid ">
      
         <div class="col barra-ricerca">
         <?php  include("cerca-laboratorio.php"); ?>
         </div>
   
      </div>
   </div>

   <?php include ("footer-include.php");
  

   ?>

</body>

</html>
