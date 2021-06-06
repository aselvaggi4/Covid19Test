<?php
require_once('model/user_db.php');
require_once('controller/gestione_utente.php');
require_once('controller/gestione_tampone.php');
require_once('controller/gestione_prenotazione.php');

class Dashboard {
    function mostraDashboard($tipo_utente) {
        // Tipo utente / Cittadino
        if($tipo_utente == 1) {
            $tamponeController = new TamponeController();

            $tamponi = $tamponeController->mostraTamponi($_SESSION['id']);
            $controlloTamponi = $this->controllaTamponi($tamponi);
            
            if($controlloTamponi) {
            $tamponiPrenotati = array();
            $tamponiCompletati = array();
            foreach($tamponi as $tampone) {
                if($tampone["stato"] != "completato") {
                    $tamponiPrenotati[] = $tampone;
                } else {
                    $tamponiCompletati[] = $tampone;
                }
            }
        
            echo '<h3 style="text-align:center; color:black;">Tamponi prenotati</h3>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Laboratorio</th>
                    <th scope="col">Data</th>
                    <th scope="col">Orario</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>';
            $contatore = 1;
            foreach($tamponiPrenotati as $tamponePrenotato) {
                echo '<tr class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponePrenotato["nome"].'</td>
                <td>'.$tamponePrenotato["data"].'</td>
                <td>'.$tamponePrenotato["orario"].'</td>
                <td>'.$tamponePrenotato["stato"].'</td>
                </tr>';
                $contatore++;
            }
        echo'</tbody></table>
           
        </div>
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        <h3>Dashboard cittadino</h3><hr>
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le tue prenotazioni, annullarle o inserire e visualizzare i questionari anamnestici.</p>
        </div>    
        <!-- Tamponi completati -->
            <div class="row dashboard-card" style="margin-top:3rem;">
                <h3 style="text-align:center; color:black;">Tamponi completati</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Laboratorio</th>
                                <th scope="col">Data</th>
                                <th scope="col">Orario</th>
                                <th scope="col">Esito</th>
                            </tr>
                        </thead>
                        <tbody>';
            $contatore = 1;
            foreach($tamponiCompletati as $tamponeCompletato) {
                echo '<tr>
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponeCompletato["nome"].'</td>
                <td>'.$tamponeCompletato["data"].'</td>
                <td>'.$tamponeCompletato["orario"].'</td>
                <td style="font-weight:600;';
                if($tamponeCompletato["esito"] == "Positivo"){echo 'color:red;';} else{echo 'color:#0d6efd;';}
                echo'">'.$tamponeCompletato["esito"].'</td>
                </tr>';
                $contatore++;
            }
        } else {
            echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3>';
        }
        }  
        // Tipo utente AZIENDA
        if($_SESSION['tipo_utente'] == 2) {
            $prenotazione = new PrenotazioneController();
            $tuttiTamponi = $prenotazione->prenotazioniUtente($_SESSION['id']);
            $controlloTamponi = $this->controllaTamponi($tuttiTamponi);
            // Controlla se gli sono stati passati tamponi
            if($controlloTamponi) {
                
            $tamponiPrenotati = array();
            $tamponiCompletati = array();
            foreach($tuttiTamponi as $tamponi=>$val) {
                if(is_array($val)) {
                foreach($val as $tampone) {
                    if($tampone["stato"] != "completato") {
                        $tamponiPrenotati[] = $tampone;
                    } 
                    else {
                        $tamponiCompletati[] = $tampone;
                    }
                } 
            }
        }
            echo '<h3 style="text-align:center; color:black;">Tamponi prenotati</h3>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Laboratorio</th>
                    <th scope="col">Dipendente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Stato</th>
                </tr>
            </thead>
            <tbody>';
            $contatore = 1;
            foreach($tamponiPrenotati as $tamponePrenotato) {
                echo '<tr class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponePrenotato["nome"].'</td>
                <td>'.$tamponePrenotato["utente"]. " ". $tamponePrenotato["cognome"].'</td>
                <td>'.$tamponePrenotato["data"].'</td>
                <td>'.$tamponePrenotato["stato"].'</td>
                </tr>';
                $contatore++;
            }
        echo'</tbody></table>        
        </div>
        </div>
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        <h3>Dashboard cittadino</h3><hr>
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le tue prenotazioni, annullarle o inserire e visualizzare i questionari anamnestici.</p>
        </div> 
        <!-- Tamponi completati -->
            <div class="row dashboard-card" style="margin-top:3rem;">
                <h3 style="text-align:center; color:black;">Tamponi completati</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Dipendente</th>
                                <th scope="col">Data</th>
                                <th scope="col">Orario</th>
                                <th scope="col">Esito</th>
                            </tr>
                        </thead>
                        <tbody>';
            $contatore = 1;
            foreach($tamponiCompletati as $tamponeCompletato) {
                echo '<tr>
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponeCompletato["utente"]." ".$tamponeCompletato["cognome"].'</td>
                <td>'.$tamponeCompletato["data"].'</td>
                <td>'.$tamponeCompletato["orario"].'</td>
                <td style="font-weight:600;';
                if($tamponeCompletato["esito"] == "Positivo"){echo 'color:red;';} else{echo 'color:#0d6efd;';}
                echo'">'.$tamponeCompletato["esito"].'</td>
                </tr>';
                $contatore++; 
                } 
            } else {
                echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3>';
            }
        } 
        if($_SESSION['tipo_utente'] == 4) {

            $cercaPrenotazioni = new PrenotazioneController();
            $tamponiLaboratorio = $cercaPrenotazioni->prenotazioniLaboratorio();
            //print_r($tamponiLaboratorio);

            $tamponiPrenotati = array();
            $tamponiCompletati = array();
            foreach($tamponiLaboratorio as $tamponi=>$var) {
                foreach($var as $tampone) {
                    if($tampone["stato"] != "completato") {
                        $tamponiPrenotati[] = $tampone;
                    } 
                    else {
                        $tamponiCompletati[] = $tampone;
                    }
                }
            }
            
            echo '<h3 style="text-align:center; color:black;">Tamponi prenotati</h3>
            <table class="table table-hover">
            <thead>
                <tr class="clickable-row">
                    <th scope="col">#</th>
                    <th scope="col">Paziente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Orario</th>
                    <th scope="col">Stato</th>
                    <th scope="col">Inserisci Esito</th>
                </tr>
            </thead>
            <tbody>';
            $contatore = 1;
            foreach($tamponiPrenotati as $tamponePrenotato) {
                echo '<tr class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponePrenotato["utente"]. " ". $tamponePrenotato["cognome"].'</td>
                <td>'.$tamponePrenotato["data"].'</td>
                <td>'.substr($tamponePrenotato["orario"], -8, 5).'</td>
                <td>'.$tamponePrenotato["stato"].'</td>
                <td><button type="submit" class="btn btn-primary" style="line-height:1.3;">INSERISCI ESITO</button></td>
                </tr>';
                $contatore++;
            }
        echo'</tbody></table>
        </div>
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        <h3>Dashboard Laboratorio</h3><hr>
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni, visualizzare i questionari anamnestici ed inserire l\'esito.</p>
        </div>        
        </div>
        <!-- Tamponi completati -->
            <div class="row dashboard-card" style="margin-top:3rem;">
                <h3 style="text-align:center; color:black;">Tamponi completati</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Dipendente</th>
                                <th scope="col">Data</th>
                                <th scope="col">Orario</th>
                                <th scope="col">Esito</th>
                            </tr>
                        </thead>
                        <tbody>';
            $contatore = 1;
            foreach($tamponiCompletati as $tamponeCompletato) {
                echo '<tr>
                <th scope="row">'.$contatore.'</th>

                <td>'.$tamponeCompletato["utente"]." ".$tamponeCompletato["cognome"].'</td>
                <td>'.$tamponeCompletato["data"].'</td>
                <td>'.substr($tamponeCompletato["orario"], -8, 5).'</td>
                <td style="font-weight:600;';
                if($tamponeCompletato["esito"] == "Positivo"){echo 'color:red;';} else{echo 'color:#0d6efd;';}
                echo'">'.$tamponeCompletato["esito"].'</td>
                </tr>';
                $contatore++; 
                } 
        }     
} 
    
    function controllaTamponi($tamponi) {
        if($tamponi == false) {
            return false;
        } else {
            return true;
        }
    }
        
                    
                
}
?>