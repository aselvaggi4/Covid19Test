<?php

include("sessioni.php"); 
require_once('model/user_db.php');
require_once('controller/gestione_utente.php');
require_once('controller/gestione_lab.php');
require_once('controller/gestione_prenotazione.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifica disponibilità</title>

	<?php include("head-include.php");  
	
	$labController = new LaboratorioController();
	$laboratorio = $labController->idLaboratorio();

	$orari;
	?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

	<?php include ("view/navbar.php"); ?>


	<div class="container">
		<div class="row" style="padding-top:50px;">
			<div class="col-md-8 margin-auto" style="color:black;">
				<div class="card shadow mb-5 centrato" style="padding:3rem;">
					<h3>Modifica disponibilità</h3>
					<form method="POST" action="#">
						<div class="row form-prenotazione">
							<div class="col-md-6 input-form margin-auto" style="margin-bottom:2rem;">
								<label>Seleziona data</label>
								<input type="date" name="data" min="<?php echo date("Y-m-d"); ?>" id="data" class="form-control" aria-label="Data"
									placeholder="Data" required>
							</div>
							<div class="col-md-12 input-form">
								<button class="btn btn-primary" type="submit">CONFERMA DATA</button>
							</div>
						</div>
					</form>
					<?php if(isset($_POST['data'])) {

						$orariDisponibili = $labController->controllaDisponibilita($laboratorio['id'], $_POST['data']);
						$orari = $orariDisponibili;
						if(empty($orari)) {
							echo '<h3 style="padding:2rem;">Non ci sono orari disponibili per il giorno <br>'. $_POST['data'].'</h3>';
						} else {
							echo '<h3 style="padding:2rem;">Rimuovi orari disponibili per il giorno <br> '. $_POST['data'].'</h3>';
						}
						 ?>
					<form method="POST" action="#">
					<div class="row form-prenotazione">
						<div class="col-md-6 input form">
							<label>Dalle ore:</label>
							<select class="form-control" id="orario" name="inizio" required>
								<?php foreach($orariDisponibili as $orario){
							echo '<option value='.$orario.'>'. $orario .'</option>' ;
						}
					 ?>
							</select>
							</div>
							<div class="col-md-6 input form">
							<label>Alle ore:</label>

							<select class="form-control" id="orario" name="fine" required>
								<?php foreach($orariDisponibili as $orario){
							echo '<option value='.$orario.'>'. $orario .'</option>' ;
						} ?>
					
							</select>
							</div>
							</div>
							<input type="hidden" name="data" value="<?php echo $_POST['data']; ?>">
							<button class="btn btn-primary" type="submit">CONFERMA ORARI</button>
					</form>
				<?php } ?>
				</div>
			</div>
		</div>

		<?php if(isset($_POST['inizio'])) {
				if($_POST['inizio'] > $_POST['fine']) {
					echo '<script>alert("Non puoi selezionare un orario di fine precedente al orario di inizio!")</script>';
					echo "<meta http-equiv='refresh' content='0'>";
				}	else {
						// Controlla la chiave in cui si trova l'orario di inizio all'interno dell'array di orari disponibili
						$eliminaOrari = array();
						$variabile = array_search($_POST['inizio'], $orari, TRUE);
					 	//Finchè, partendo da quella chiave, l'array non raggiunge l'orario di fine
						while($orari[$variabile] != $_POST['fine']) {
							// Aggiunge gli orari da eliminare ad un nuovo array
							$eliminaOrari[] = $orari[$variabile];
							$variabile++;
						}
						// Aggiunge l'ultimo orario selezionato
						$eliminaOrari[] = $_POST['fine'];

						$prenotazione = new PrenotazioneController();

						foreach($eliminaOrari as $orarioElimina) {
							$nuovoOrario = $_POST['data'] . " " . $orarioElimina;
							$costo = 0;
							$prenotazione->creaPrenotazione($_SESSION['id'], "NULL", $_POST['data'], $nuovoOrario, $laboratorio['id'],$costo);
						}
				}
		}?>
		<?php include ("footer-include.php"); ?>
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