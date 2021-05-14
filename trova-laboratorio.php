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


<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("navbar.php"); 
    
    $regione = $_GET["regione"];
    $provincia = $_GET["provincia"];
    $citta = $_GET["citta"];
    $data = $_GET["data"];
    
  //  echo '<p style="color:white;">'.$_GET["regione"] . $_GET["provincia"].$_GET["citta"] .  $_GET["data"].'</p>';
    
    
$servername="localhost";
$username = "root";
$password = "";
$dbname = "sitotamponi";


$conn = new mysqli($servername, $username, $password, $dbname);
    
$query1 = "SELECT * FROM laboratori WHERE citta = '$citta'";
$query2 = "SELECT * FROM laboratori WHERE provincia = '$provincia'";
$query3 = "SELECT * FROM laboratori WHERE regione = '$regione'";

$result1 = $conn->query($query1);
$result2 = $conn->query($query2);
$result3 = $conn->query($query3);


?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 ricerca-lab" style="color: black; background-color:#fff;">
                <h3>Ricerca laboratori: <?php echo $citta; ?></h3>
                <?php

                // SE RICERCATA UNA CITTà < 4 ==> NON MOSTRA PRIMA QUELLI DI QUELLA CITTA'
// Controlla la città
if($result1->num_rows < 4) {
    
    // Se la città è vuota --> Controlla la provincia
    if($result2->num_rows < 5) {
        
        // Se la provincia è vuota --> Controlla la regione
       if($result3->num_rows == 0) {
           echo "errr";
       } else {
        while($row= $result3->fetch_assoc()) { ?>
                <div class="row">
                    <div class="col-5">
                        <img src="img/test-tube.jpg"  width="100%">
                    </div>
                    <div class="col-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item nome-lab"><?php echo $row['nome'];?></li>
                            <li class="list-group-item"><?php echo $row['via'].', '.$row['citta'];?></li>
                        </ul>
                    </div>
                </div>
                <?php } 
       }
    } else {
        while($row = $result2->fetch_assoc()) { ?>
                <div class="row">
                    <div class="col-5">
                        <img src="img/test-tube.jpg" width="100%">
                    </div>
                    <div class="col-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item nome-lab"><?php echo $row['nome'];?></li>
                            <li class="list-group-item"><?php echo $row['via'].', '.$row['citta'];?></li>
                        </ul>
                    </div>
                </div>
                <?php  } 
    }
} else {
    while($row = $result1->fetch_assoc()) { ?>
                <div class="row">
                    <div class="col-5">
                        <img src="img/test-tube.jpg"  width="100%">
                    </div>
                    <div class="col-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item nome-lab"><?php echo $row['nome'];?></li>
                            <li class="list-group-item"><?php echo $row['via'].', '.$row['citta'];?></li>
                        </ul>
                    </div>
                </div>
                <?php    }
}
    ?>
            </div>
            <div class="col-7">

            </div>
        </div>
    </div>


    <?php include ("footer-include.php");
  

  ?>

</body>

</html>