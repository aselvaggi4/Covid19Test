<?php 
    include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
    require_once('controller/gestione_lab.php');
    require_once('view/crea-prenotazione.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include("head-include.php"); ?>

    <title>Laboratorio <?php echo "nomeLab"; ?></title>
    <style>
    .select2-results .select2-disabled {
        display:none;
    }
    </style>
</head>

<body style="background: linear-gradient(#141e30, #243b55);">
    <?php include ("navbar.php"); ?>

    <?php 
    
    $lab = new LaboratorioController();
    $laboratorio = $lab->trovaLab($_REQUEST['id']);

?>
    <div class="container">
        <div class="row pagina-lab">

            <h2><?php  echo $laboratorio->nome;  ?></h2>
            <p><?php echo $laboratorio->citta. ", ". $laboratorio->regione .", " . $laboratorio->via;?></p>
            <div class="col-8 ">
                <img class=" shadow mb-5 " src="img/covid19-test-corona-virus.jpg"
                    style="height: 450px; object-fit: none; border-radius: 15px;">

            </div>
            <div class="col-md-4">
                <div class="card shadow mb-5">
                    <h5 class="card-header">Prenota un test diagnostico</h5>
                    <div class="card-body">
                        <p class="card-text">Si possono effettuare test antigenici (rapidi) e test molecolari.</p>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Test antigenico <span
                                    style="float:right; color:green; font-weight:600;"><?php echo $laboratorio->costo_antigenico; ?>
                                    €</span></li>
                            <li class="list-group-item">Test molecolare <span
                                    style="float:right; color:green; font-weight:600;"><?php echo $laboratorio->costo_molecolare; ?>
                                    €</span></li>
                        </ul>

                        <div class="d-grid p-3 gap-2">
                            <form action="#" method="POST">
                                <input type="hidden" name="prenotazione_singola" value="ok">
                                <button class="btn btn-primary" type="submit" style="width:100%;">AVVIA
                                    PRENOTAZIONE</button>
                            </form>
                            <form action="#" method="POST">
                                <input type="hidden" name="prenotazione_multipla" value="ok">
                                <button class="btn btn-primary" type="submit" style="width:100%;">AVVIA PRENOTAZIONE
                                    MULTIPLA</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                
                    <i class="bi bi-exclamation-triangle-fill" width="24" height="24" style="font-size: 2rem; margin-right:0.4rem;"></i>
                    <div>
                        ATTENZIONE: Per prenotare un tampone per terzi avviare una prenotazione multipla.
                    </div>
                </div>
            </div>


            <?php 

            //Classe CreaPrenotazione contiene metodi della vista per la creazione di una prenotazione
            $nuovaPrenotazione = new CreaPrenotazione();

            if(isset($_POST['prenotazione_singola']) || isset($_POST['modifica_data'])) {
                echo "<h3>Prenotazione singola</h3>";
                $prenotazione = 'data_selezionata_singola';
                $nuovaPrenotazione->SelezionaData($prenotazione);
            } 
            if(isset($_POST['data_selezionata_singola'])) {
                $date = new LaboratorioController();

                $data = $_REQUEST['data'];
                $orariDisponibili = $date->controllaDisponibilita($_REQUEST['id'], $_REQUEST['data']);
                $nuovaPrenotazione->FormPrenotazione($orariDisponibili, $data, $laboratorio->id);
            }
            
            if(isset($_POST['prenotazione_multipla'])) {
                echo "<h3>Prenotazione multipla</h3>";

                $prenotazione = 'data_selezionata_multipla';
                $nuovaPrenotazione->SelezionaData($prenotazione);
            }
            if(isset($_POST['data_selezionata_multipla'])) {
                $date = new LaboratorioController();
                $data = $_REQUEST['data'];
                $numTamponi = $_REQUEST['numero'];

                $orariDisponibili = $date->controllaDisponibilita($_REQUEST['id'], $data);
                //print_r($orariDisponibili);
                $nuovaPrenotazione->FormPrenotazioneMultipla($orariDisponibili, $data, $laboratorio->id, $numTamponi);
                if(isset($_POST['pren_comp'])) {
                    echo "prenotazione completata";
                }
            } 

            ?>
        </div>
    </div>
    <?php include("footer-include.php"); ?>
    <script>
    function checkTheDropdowns(){
  var arr  = $('select').find(':selected');
  $('select').find('option').show();
  $.each($('select'), function(){  
    var self = this;
    var selectVal = $(this).val();
    $.each(arr, function(){         
        if (selectVal !== $(this).val()){
                $(self).find('option[value="'+$(this).val()+'"]').hide()
        } else {
                $(self).find('option[value="'+$(this).val()+'"]').show()
        }
    });
 })
};
checkTheDropdowns();
$('select').on('change', checkTheDropdowns);



    </script>
</body>

</html>