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
         
            $tamponiPrenotati = array();
            $tamponiCompletati = array();
            foreach($tamponi as $tampone) {
                if($tampone["stato"] != "completato") {
                    $tamponiPrenotati[] = $tampone;
                } else {
                    $tamponiCompletati[] = $tampone;
                }
            }
        
            echo '<table class="table table-hover">
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
        
        }  
        // Tipo utente AZIENDA
        if($_SESSION['tipo_utente'] == 2) {
            $prenotazione = new PrenotazioneController();
            $tuttiTamponi = $prenotazione->prenotazioniUtente($_SESSION['id']);

            print_r($tuttiTamponi);

            $tamponiPrenotati = array();
            $tamponiCompletati = array();
            foreach($tuttiTamponi as $tampone) {
                if($tampone["stato"] != "completato") {
                    $tamponiPrenotati[] = $tampone;
                } else {
                    $tamponiCompletati[] = $tampone;
                }
            }
            echo '<table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Laboratorio</th>
                    <th scope="col">Dipendente</th>
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
                <td>'.$tamponePrenotato["utente"]. " ". $tamponePrenotato["cognome"].'</td>
                <td>'.$tamponePrenotato["data"].'</td>
                <td>'.$tamponePrenotato["stato"].'</td>
                </tr>';
                $contatore++;
            }
        echo'</tbody></table>        
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
        }      
} 
    
        
        
                    
                
}
?>