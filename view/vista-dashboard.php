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
            echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3>
            </div>
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le tue prenotazioni, annullarle o inserire e visualizzare i questionari anamnestici.</p>
        </div>   ';
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
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni aziendali e visualizzare i gli esiti dei tuoi dipendenti.</p>
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
                echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3>
                </div>
                <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
                
                <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
                <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni aziendali e visualizzare i gli esiti dei tuoi dipendenti.</p>
                </div>';
            }
        }
        // Tipo utente MEDICO
        if($_SESSION['tipo_utente'] == 3) {
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
                    <th scope="col">Paziente</th>
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
        
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni che hai effettuato per i tuoi pazienti e visualizzarne gli esiti.</p>
        </div> 
        <!-- Tamponi completati -->
            <div class="row dashboard-card" style="margin-top:3rem;">
                <h3 style="text-align:center; color:black;">Tamponi completati</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Paziente</th>
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
                echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3>
                </div>
                <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
                
                <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
                <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni che hai effettuato per i tuoi pazienti e visualizzarne gli esiti.</p>
                </div>';
            }
        }  
        if($_SESSION['tipo_utente'] == 4) {

            $cercaPrenotazioni = new PrenotazioneController();
            $tamponiLaboratorio = $cercaPrenotazioni->prenotazioniLaboratorio();
            $controlloTamponi = $this->controllaTamponi($tamponiLaboratorio);

            if($controlloTamponi) {

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
                <tr class="">
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
                echo '<tr>
                <th scope="row">'.$contatore.'</th>

                <td class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">'.$tamponePrenotato["utente"]. " ". $tamponePrenotato["cognome"].'</td>
                <td class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">'.$tamponePrenotato["data"].'</td>
                <td class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">'.substr($tamponePrenotato["orario"], -8, 5).'</td>
                <td class="clickable-row" data-href="prenotazione?pren='.$tamponePrenotato["id"].'">'.$tamponePrenotato["stato"].'</td>
                <td><button type="button" id="custId" data-href="prenotazione?pren='.$tamponePrenotato["id"].'&esito" class="btn btn-primary clickable-row" style="line-height:1.3;" ">INSERISCI ESITO</button></td>
                </tr>';
                $contatore++;
            }
        echo'</tbody></table>
        </div>
        <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
        <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
        <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni, visualizzare i questionari anamnestici ed inserire l\'esito.</p>
        <a href="modifica-disponibilita" class="btn btn-primary">MODIFICA DISPONIBILITÀ</a>

        </div>        
        </div>
        <!-- Tamponi completati -->
            <div class="row dashboard-card" style="margin-top:3rem;">
                <h3 style="text-align:center; color:black;">Tamponi completati</h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th  scope="col">#</th>
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
        }   else {
                echo '<h3 style="text-align:center; color:black;">Non sono state trovate prenotazioni</h3></div>
                <div class="col-md-3 dashboard-card" style="margin-left:auto; padding:1rem;">
                <p>Benvenuto <strong>'.$_SESSION['nome'].' '.$_SESSION['cognome']. '</strong></p>
                <p>Questa è la tua dashboard: da qui puoi visualizzare le prenotazioni, visualizzare i questionari anamnestici ed inserire l\'esito.</p>
                <a href="modifica-disponibilita" class="btn btn-primary">MODIFICA DISPONIBILITÀ</a>
                </div>';
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