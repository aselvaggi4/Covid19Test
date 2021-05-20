<?php include("sessioni.php"); 
    require_once('controller/gestione_lab.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="col barra-ricerca">
    <form method="POST" action="test-lab-reg.php">
  <h3 class="white-text centrato">Cerca un laboratorio:</h3>
<div class="input-group">
  <div class="form-outline">

    <input class="form-control bordo-regione" name="email" id="username" type="text" placeholder="username" aria-label="regione"  required>
    <input class="form-control bordo-regione" name="password" id="password" type="text" placeholder="password" aria-label="password" required>
    <input class="form-control bordo-regione" name="nome" id="nome" type="text" placeholder="Nome" aria-label="nome" required>
    <input class="form-control bordo-regione" name="indirizzo" id="indirizzo" type="text" placeholder="indirizzo" required>
    <input class="form-control bordo-regione" name="iva" id="iva" type="text" placeholder="iva">
    <input class="form-control bordo-regione" name="regione" id="regione" type="text" placeholder="Regione" aria-label="regione" pattern="[A-Za-z]{1,}" oninvalid="setCustomValidity('Formato non valido')" required>
    <input class="form-control bordo-centrale" name="provincia" id="provincia" type="text" placeholder="Provincia" aria-label="provincia" pattern="[A-Za-z]{2}" oninvalid="setCustomValidity('Formato non valido. Es: BA, MI..')" required>
    <input class="form-control bordo-centrale" name="citta" id="citta" type="text" placeholder="Città" aria-label="citta" pattern="[A-Za-z]{1,}" oninvalid="setCustomValidity('Formato non valido')" required>
    
    <input type="hidden" name="submit">
    <button id="search-button" type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
    
  </div>
 
</div>

</form>

    </div>

    <?php 

    if(isset($_POST['submit'])) {
        
        $gestioneLab = new LaboratorioController();
        try {
            $gestioneLab->registraLaboratorio($_POST['regione'],$_POST['provincia'], $_POST['citta'],$_POST['indirizzo'],$iva = $_POST['iva'], $_POST['email'], $_POST['nome'], $_POST['password']);
        } catch (Exception $e) {
            echo $e;
        }
}
    ?>
</body>
</html>
