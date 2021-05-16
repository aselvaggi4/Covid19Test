<?php include("sessioni.php"); 
require_once('model/laboratori_db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca un laboratorio</title>

    <?php include("head-include.php"); 
   
    $page_id = 0;

   ?>

</head>

<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("navbar.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-5 ricerca-lab" style="color: black; background-color:#fff;">
                <h3>Ricerca laboratori: <?php echo $_GET["citta"]; ?></h3>

                <?php  
                    $laboratori = getLaboratori($_GET["regione"], $_GET["provincia"], $_GET["citta"], $_GET["data"]);
                    
                    foreach($laboratori as $laboratorio) {
                ?>
                <div class="row">
                    <div class="col-5">
                        <img src="img/test-tube.jpg" width="100%">
                    </div>
                    <div class="col-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item nome-lab"><?php echo $laboratorio['nome'];?></li>
                            <li class="list-group-item"><?php echo $laboratorio['via'].', '.$laboratorio['citta'] . ', ' . $laboratorio['provincia'];?></li>
                        </ul>
                    </div>
                </div>

                <?php }  ?>
            </div>
            <div class="col-7">
            
            </div>
        </div>
    </div>

    <?php include ("footer-include.php"); ?>

</body>

</html>