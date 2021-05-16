<?php include("sessioni.php"); 
    require_once('model/user_db.php');
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


<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("navbar.php"); 
    
    $tipoUtente = $_GET['id'];

    ?>

    <div class="container form-registrazione">
        <h3 class="centrato white-text">Crea un account <?php if ($tipoUtente == 1) {
            echo "utente";
        } else if ($tipoUtente == 2) {
            echo "aziendale";
        } else if ($tipoUtente == 3) {
            echo "come medico di base";
        }
            ?></h3>
        <form method="POST" action="registrazione-completata.php" style="text-align:center">
            
                <div class="row">
                    <div class="col-6 input-form">
                        <input type="text" id="nome" name="nome" class="form-control" 
                            aria-label="Nome" required>
                            <label>Nome</label>

                    </div>
                    <div class="col-6 input-form">                
                        <input type="text" id="cognome" name="cognome" class="form-control" 
                            aria-label="Cognome" required>
                            <label>Cognome</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="citta" name="citta" class="form-control" 
                            aria-label="Città" required>
                            <label>Città</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="provincia" name="provincia" class="form-control"
                            aria-label="Provincia" required>
                            <label>Provincia</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="tel" id="cap" name="cap" class="form-control" pattern="\d*"
                            oninvalid="setCustomValidity('Inserisci un CAP valido')" aria-label="Cap"
                            required>
                            <label>CAP</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="text" id="indirizzo" name="indirizzo" class="form-control" 
                            aria-label="Indirizzo" required>
                            <label>Indirizzo</label>
                    </div>
                    <div class="col-12 input-form">
                        <input type="tel" id="tel" name="tel" class="form-control" pattern="\d*"
                            oninvalid="setCustomValidity('Inserisci un numero di telefono')" aria-label="Telefono" required>
                            <label>Telefono</label>
                    </div>
                    <div class="col-12 input-form">
                        <?php if ($tipoUtente == 1) { echo 
                "<input type='text' class='form-control' name='CF' id='CF'  aria-label='Codice fiscale' required><label>Codice Fiscale</label>";
                 } else if ($tipoUtente == 2) { echo 
                    "<input type='text' class='form-control' name='CF' id='CF' aria-label='Partita IVA' required><label>Partita IVA</label>";
                 } else if ($tipoUtente == 3) { echo
                    "<input type='text' class='form-control' name='CF' id='CF' aria-label='Codice regionale' required><label>Codice Regionale</label>";
                 }
                ?>
                    </div>
                    <div class="col-6 input-form">
                        <input type="email" id="email" name="email" class="form-control"
                            aria-label="email" required>
                            <label>E-mail</label>
                    </div>
                    <div class="col-6 input-form">
                        <input type="password" id="password" name="password" class="form-control"
                            aria-label="password" required>
                            <label>Password</label>
                    </div>
                    <input type="hidden" id="tipo_utente" name="tipo_utente" value="<?php echo $tipoUtente; ?>">
                    <input type="hidden" name="submit">
                </div>

                <button type="submit" class="btn btn-outline-primary">Conferma</button>
                <button type="button" class="btn btn-outline-danger" onclick="history.back()">Annulla</button>
        </form>
    </div>

    <?php // if(isset($_POST['submit'])) {

       

       // echo "<script>alert('Registrazione effettuata!')</script>";
   // }

    ?>
    <?php include ("footer-include.php"); ?>

</body>

</html>