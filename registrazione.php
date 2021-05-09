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

    <?php include ("navbar.php"); 
    
    $tipoUtente = $_GET['id'];

    ?>

    <div class="container form-registrazione" style="padding:5% 20%;">
        <form method="POST" action="registrazione-completata" style="text-align:center">
            <div class="row">
                <div class="col-6">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" aria-label="Nome"
                        required>
                </div>
                <div class="col-6">
                    <input type="text" id="cognome" name="cognome" class="form-control" placeholder="Cognome"
                        aria-label="Cognome" required>
                </div>
                <div class="col-6">
                    <input type="text" id="citta" name="citta" class="form-control" placeholder="Città"
                        aria-label="Città" required>
                </div>
                <div class="col-6">
                    <input type="text" id="provincia" name="provincia" class="form-control" placeholder="Provincia"
                        aria-label="Provincia" required>
                </div>
                <div class="col-6">
                    <input type="tel" id="cap" name="cap" class="form-control" pattern="\d*"
                        oninvalid="setCustomValidity('Inserisci un CAP valido')" placeholder="Cap" aria-label="Cap"
                        required>
                </div>
                <div class="col-6">
                    <input type="text" id="indirizzo" name="indirizzo" class="form-control" placeholder="Indirizzo"
                        aria-label="Indirizzo" required>
                </div>
                <div class="col-12">
                    <input type="tel" id="tel" name="tel" class="form-control" pattern="\d*"
                        oninvalid="setCustomValidity('Inserisci un numero di telefono')"
                        placeholder="Inserisci il tuo numero di telefono" aria-label="Telefono" required>
                </div>
                <div class="col-12">
                    <?php if ($tipoUtente == 1) { echo 
                "<input type='text' class='form-control' name='CF' id='CF' placeholder='Codice Fiscale' aria-label='Codice fiscale' required>";
                 } else if ($tipoUtente == 2) { echo 
                    "<input type='text' class='form-control' name='IVA' id='IVA' placeholder='Partita IVA' aria-label='Partita IVA' required>";
                 } else if ($tipoUtente == 3) { echo
                    "<input type='text' class='form-control' name='CR' id='CR' placeholder='Codice regionale' aria-label='Codice regionale' required>";
                 }
                ?>
                </div>
                <div class="col-6">
                    <input type="email" id="email" name="email" class="form-control"
                        placeholder="Inserisci la tua email" aria-label="email" required>
                </div>
                <div class="col-6">
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Inserisci la password desiderata" aria-label="password" required>
                </div>
                <input type="hidden" id="tipo_utente" name="tipo_utente" value="<?php echo $tipoUtente; ?>">

            </div>

            <button type="submit" class="btn btn-primary">Conferma</button>
            <button type="button" class="btn btn-outline-danger">Annulla</button>

        </form>
    </div>
    <?php include ("footer-include.php"); ?>

</body>

</html>