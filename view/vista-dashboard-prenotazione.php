<?php

class MostraPrenotazione {

    function __construct($infoTampone, $tipoUtente) {

        if(is_object($infoTampone)) {
            if($tipoUtente != 4) {
                if($infoTampone->anamnesi == NULL) {
                    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">

                    <i class="bi bi-exclamation-triangle-fill" width="24" height="24" style="font-size: 2rem; margin-right:0.4rem;"></i>
                    <div>
                        ATTENZIONE: Per completare la prenotazione devi compilare e caricare il questionario
                        anamnestico!
                    </div>
                </div>
                <p>Clicca qui per scaricare il form del <a href="..\questionario.pdf">questionario anamnestico</a></p>
                <form action="#" method="post" enctype="multipart/form-data">
                    Dopo averlo compilato carica il questionario anamnestico qui!<br>
                    <input type="hidden" name="file_inserito">
                
                    <input class="form-control" type="file" name="anamnesi" id="fileToUpload" style="margin:0.5rem;">
                
                    <input class="btn btn-primary" type="submit" name="submit" value="Carica il questionario" style="margin-top:1rem;">
                </form>';
                } else {
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill flex-shrink-0 me-2" width="24" height="24" role="img" style="font-size: 2rem; margin-right:0.4rem;" aria-label="Success:"></i>
                    <div>
                      Hai già compilato il form anamnestico! Se vuoi modificarlo puoi caricarlo nuovamente.
                    </div>
                  </div>
                  <p> <a href=".\\'.$infoTampone->anamnesi.'">Guarda il tuo form anamnestico caricato</a></p>
                <p>Clicca qui per scaricare il form del <a href=".\questionario.pdf">questionario anamnestico</a></p>
                <form action="#" method="post" enctype="multipart/form-data">
                    Dopo averlo compilato carica il questionario anamnestico qui!<br>
                    <input type="hidden" name="file_inserito">
                
                    <input class="form-control" type="file" name="anamnesi" id="fileToUpload" style="margin:0.5rem;">
                
                    <input class="btn btn-primary" type="submit" name="submit" value="Carica il questionario" style="margin-top:1rem;">
                </form>';
                } if($infoTampone->stato != "completato") {
                    echo '<form method="POST" action="#" style="padding-top:2rem;">
                    <input type="hidden" name="annulla_prenotazione" value="annullata">
                    <button type="submit" class="btn btn-danger" onClick="return confirm(\'Sicuro di voler eliminare la prenotazione?\')">ANNULLA PRENOTAZIONE</button>

                </form>';
                }
            } else {
                echo '<p><strong>Paziente: </strong>' . $infoTampone->utente .' '. $infoTampone->cognome.'</p>
                <p><strong>Codice Fiscale: </strong>'.$infoTampone->CF.' </p>
                <p><strong>Contatti: </strong></p>'.  $infoTampone->tel. '<p>'. $infoTampone->email .'</p>';
                if($infoTampone->anamnesi == NULL) {
                    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">

                    <i class="bi bi-exclamation-triangle-fill" width="24" height="24" style="font-size: 2rem; margin-right:0.4rem;"></i>
                    <div>
                        ATTENZIONE: Non è ancora stato inserito il questionario anamnestico!
                    </div>
                </div>';
                } else {
                    echo '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill flex-shrink-0 me-2" width="24" height="24" role="img" style="font-size: 2rem; margin-right:0.4rem;" aria-label="Success:"></i>
                    <div>
                      Il paziente ha inserito il proprio questionario anamnestico.
                    </div>
                  </div>
                  <p> <a href=".\\'.$infoTampone->anamnesi.'">Guarda l\'anamnesi del paziente.</a></p>';
                
                }
                
                if(isset($_REQUEST['esito'])||isset($_GET['esito'])) {
                    echo '<h3>Inserisci esito tampone</h3>
                    <form method="POST" action="#">
                    <select class="form-control" name="esito_inserito" required>
                    <option value="Positivo">Positivo</option>
                    <option value="Negativo">Negativo</option>
                    </select>
                    <button type="submit" class="btn btn-primary" style="margin-top:2rem;">INSERISCI</button>
                    </form>';
                } else {
                    echo '<form action="#" method="GET"><input type="hidden" name="esito">
                    <input type="hidden" name="pren" value="'.$_REQUEST['pren'].'">
                    <button type="submit" class="btn btn-primary" style="margin-top:2rem;">INSERISCI ESITO</button>
                    </form>';
                }
            }
        }
    }
}
?>
