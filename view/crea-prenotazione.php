<?php 

class CreaPrenotazione {

    private $orariDisponibili;
    private $data;
    private $laboratorio;
    private $prenotazione;
    private $numTamponi;

    function FormPrenotazione($orariDisponibili, $data, $laboratorio) {
        $this->orariDisponibili = $orariDisponibili;
        $this->data = $data;
        $this->laboratorio = $laboratorio;
        echo '
        <form action="#" method="POST" id="inputId" style="text-align:center;">
            <input type="hidden" name="modifica_data" value="ok">
            <button class="btn btn-link" type="submit" style="margin-right:5%;">Seleziona una nuova data</button>
        </form>
        <form method="POST" action="riepilogo-prenotazione.php" id="inputId" style="text-align:center; padding: 3rem 8rem;">
        <div class="row form-prenotazione ">
            <div class="col-md-6 input form">
                <label>Tipo di tampone</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="antigenico">Test antigenico</option>
                    <option value="molecolare">Test molecolare</option>
                </select>
            </div>
            <div class="col-md-6 input form">
            <label>Seleziona Orario</label>
            <select class="form-control" id="orario" name="orario" required>';
            foreach($this->orariDisponibili as $orario){
                echo '<option value='.$orario.'>'. $orario .'</option>' ;
            }
            echo '</select></div>
            <div class="col-md-3 input-form">
                <input type="text" id="nome" name="nome" class="form-control" aria-label="Nome" required>
                <label>Nome</label>
    
            </div>
            <div class="col-md-3 input-form">
                <input type="text" id="cognome" name="cognome" class="form-control" aria-label="Cognome" required>
                <label>Cognome</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="email" id="email" name="email" class="form-control" aria-label="email" required>
                <label>E-mail</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="text" class="form-control" name="CF" id="CF" aria-label="Codice fiscale" required>
                <label>Codice Fiscale</label>
                <input type="hidden" name="data" value="'.$this->data.'">
                <input type="hidden" name="laboratorio" value="'.$this->laboratorio.'">
            </div>
        </div>
        <button class="btn btn-primary" type="submit">CONFERMA PRENOTAZIONE</button></form>';
    }

    function SelezionaData($prenotazione) {
        $this->prenotazione = $prenotazione;
        if(isset($_SESSION["valid"])) {
            echo '<form method="POST" action="#" style="text-align:center">
            <div class="row form-prenotazione ">';
            if($this->prenotazione == "data_selezionata_multipla") {
                echo '<div class="col-md-6 input-form">
                <label>Numero di test da prenotare</label>
                <select class="form-control" id="numero" name="numero" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select></div>';
            }
        echo '<div class="col-md-6 input-form">
            <label>Seleziona data</label>
            <input type="date" name="data" id="data" min="'. date("Y-m-d").'" class="form-control" aria-label="Data" placeholder="Data" required>
        </div>
        <div class="col-md-6 input-form">
            <input type="hidden" name="'.$this->prenotazione.'" value="ok">
            <button class="btn btn-outline-primary" type="submit">CONFERMA DATA</button>
        </div>    
        </form>';
        } else {
            echo '<div class="col-md-8" style="text-align:center; margin:auto;">
            <h3>Effettua il login prima di effettuare una prenotazione!</h3>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">LOGIN</button>
        </div>';
        }
    }

    function FormPrenotazioneMultipla($orariDisponibili, $data, $laboratorio,$numTamponi) {
        $this->orariDisponibili = $orariDisponibili;
        $this->data = $data;
        $this->laboratorio = $laboratorio;
        $this->numTamponi = $numTamponi;

        echo'<form method="POST" action="riepilogo-prenotazione" id="inputId" style="text-align:center; padding: 3rem 8rem;">
        <div class="row form-prenotazione ">
            <div class="col-md-12 input-form">
            <div class="col-md-6 input-form" style="margin:auto;">    
            <label>Tipo di tampone</label>
                <select class="form-control" id="tipo" name="tipo" required>
                    <option value="antigenico">Test antigenico</option>
                    <option value="molecolare">Test molecolare</option>
                </select>
                </div>
            </div>';
            for($tampone = 1; $tampone <= $this->numTamponi; $tampone++ ) {
                
            echo'<div class="col-md-3 input-form">
            <label>Seleziona Orario</label>
            <select class="form-control select2" id="orario" name="orario[]" required><option />';
            foreach($this->orariDisponibili as $orario){
                echo '<option value='.$orario.'>'. $orario .'</option>' ;
            }
            echo '</select></div>';
            echo'<div class="col-md-3 input-form">
                <input type="hidden" name="entry_id[]" value="'.$tampone.'">
                <input type="text" id="nome" name="nome[]" class="form-control" aria-label="Nome" required>
                <label>Nome</label>
    
            </div>
            <div class="col-md-3 input-form">
                <input type="text" id="cognome" name="cognome[]" class="form-control" aria-label="Cognome" required>
                <label>Cognome</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="email" id="email" name="email[]" class="form-control" aria-label="email" required>
                <label>E-mail</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="text" class="form-control" name="CF[]" id="CF" aria-label="Codice fiscale" required>
                <label>Codice Fiscale</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="text" class="form-control" name="regione[]" id="regione" aria-label="Regione" required>
                <label>Regione</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="text" class="form-control" name="citta[]" id="citta" aria-label="Città" required>
                <label>Città</label>
            </div>
            <div class="col-md-3 input-form">
                <input type="text" class="form-control" name="telefono[]" id="telefono" aria-label="Telefono" required>
                <label>Telefono</label>
            </div>
            <hr style="color:black;">
            ';
            }
        echo'</div>
        <input type="hidden" name="pren_comp" value="ok">
        <input type="hidden" name="data" value="'.$this->data.'">
        <input type="hidden" name="laboratorio" value="'.$this->laboratorio.'">
        <button class="btn btn-primary" type="submit">CONFERMA PRENOTAZIONE</button></form>';
    }
}
