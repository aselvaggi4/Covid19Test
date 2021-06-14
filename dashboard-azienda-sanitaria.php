<?php include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
    require_once('view/azienda-sanitaria.php');

    if($_SESSION['tipo_utente'] != 0 || !isset($_SESSION['valid'])) {
        header("Location: index.php");
    }

    $dashboard = new DashboardAziendaSanitaria();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Azienda sanitaria</title>

    <?php 
   
   include("head-include.php"); 
   
   ?>

</head>


<body class="dashboard-azienda" style="background: linear-gradient(#141e30, #243b55);">

    <!-- The sidebar -->
    <div class="sidebar">
        <h5 class="active" style="padding:2rem">Dashboard azienda sanitaria</h5>
        <a class="" href="?panoramica">Visualizza panoramica casi</a>
        <a href="?positivi">Visualizza pazienti positivi</a>
        <a href="?esiti">Visualizza esiti laboratori</a>
    </div>

    <!-- Page content -->
    <div class="content">
        <div class="row ">
            <div class="container">
                <?php 
                    if(isset($_REQUEST['panoramica'])) {
                        $dashboard->panoramicaCasi();
                    } else if(isset($_REQUEST['positivi'])) {
                        $dashboard->pazientiPositivi();
                    }  else if(isset($_REQUEST['esiti'])) {
                        $dashboard->esitiLaboratori();
                    }
                /* 
                <div class="card w-75">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <?php $dashboard->selezionaMese(); ?>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Button</a>
                    </div>
                </div>
                */ ?>
            </div>
        </div>
    </div>


    <?php include ("footer-include.php");
  

   ?>

</body>

</html>