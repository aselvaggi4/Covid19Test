<?php include("sessioni.php"); 
    require_once('model/user_db.php');
    require_once('controller/gestione_utente.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convenziona Laboratorio</title>

    <?php 
   
   include("head-include.php"); 
   $page_id = 2;
   ?>

</head>


<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("navbar.php"); 
    var_dump($_SESSION);
    ?>

    <div class="container form-registrazione">
        <div class="row">
            <h3 class="centrato white-text">Convenziona il tuo laboratorio</h3>
            <form method="POST" action="conferma-registrazione.php" enctype="multipart/form-data" style="text-align:center">

                <div class="row">
                    <div class="col-12 input-form">
                        <input type="text" id="nome" name="nome" class="form-control" aria-label="Nome" required>
                        <label>Nome laboratorio *</label>

                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="regione" name="regione" class="form-control" aria-label="regione"
                            required>
                        <label>Regione *</label>
                    </div>
                   
                    <div class="col-6 input-form">
                        <input type="text" id="provincia" name="provincia" class="form-control" aria-label="Provincia"
                            required>
                        <label>Provincia *</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="citta" name="citta" class="form-control" aria-label="Città" required>
                        <label>Città *</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="indirizzo" name="indirizzo" class="form-control" aria-label="Indirizzo"
                            required>
                        <label>Indirizzo *</label>
                    </div>
                    <div class="col-12 input-form">
                        <input type="tel" id="tel" name="tel" class="form-control" pattern="\d*"
                            oninvalid="setCustomValidity('Inserisci un numero di telefono')" aria-label="Telefono"
                            required>
                        <label>Telefono *</label>
                    </div>
                    <div class="col-12 input-form">
                        <input type='text' class='form-control' name='iva' id='iva' aria-label='Partita IVA'
                            required><label>Partita IVA *</label>
                    </div>
                    
                    <div class="col-6 input-form">
                        <input type="number" id="costo_antigenico" name="costo_antigenico" class="form-control" aria-label="costo_antigenico"
                            required>
                        <label>Costo test antigenico *</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="number" id="costo_molecolare" name="costo_molecolare" class="form-control" aria-label="costo_molecolare"
                            required>
                        <label>Costo test molecolare *</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="email" id="email" name="email" class="form-control" aria-label="email" required>
                        <label>E-mail *</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="password" id="password" name="password" class="form-control" aria-label="password"
                            required>
                        <label>Password *</label>
                    </div>
                    <div class="col-12 input-form">
                        <input type="file" name="immagine_lab" class="form-control" aria-label="immagine-lab">
                        <label>Immagine laboratorio</label>
                    </div>
                    <input type="hidden" id="tipo_utente" name="tipo_utente" value="4">
                    <input type="hidden" name="submit">
                </div>

                <button type="submit" class="btn btn-outline-primary">Conferma</button>
                <button type="button" class="btn btn-outline-danger" onclick="history.back()">Annulla</button>
            </form>
        </div>

    </div>
    </div>
    <div class="container">
        <div class="row" style="padding-top:50px;">

        </div>
    </div>
    <?php include ("footer-include.php"); ?>

</body>

</html>