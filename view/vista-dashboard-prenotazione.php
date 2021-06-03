<?php

class MostraPrenotazione {

    function __construct($infoTampone) {

        if(is_object($infoTampone)) {

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
            }
        } else {
            echo '<div class="alert alert-danger d-flex align-items-center" role="alert">

            <i class="bi bi-exclamation-triangle-fill" width="24" height="24" style="font-size: 2rem; margin-right:0.4rem;"></i>
            <div>
                ERRORE: Non è stato possibile trovare la prenotazione, prova a tornare indietro!
            </div>
        </div>
        <button class="btn btn-danger" type="submit" name="submit"  onclick="history.back()" style="margin-top:1rem;">Torna indietro</button>
        ';
        }
    }
}
?>
