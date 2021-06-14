<?php
require_once('./controller/gestione_as.php');

class DashboardAziendaSanitaria {

    function panoramicaCasi() {
        echo '
        <div class="card w-75">
            <div class="card-body centrato">
                <h3 class="card-title">Panoramica casi</h3>';
                $this->selezionaMese();

                if(isset($_POST['mese'])) {
                    $as = new AsController();
                    $casi = $as->panoramicaCasi($_POST['mese']);
                
                if($casi) {
        echo '<br><p>Questa tabella contiene tutti gli esiti dei test diagnostici effettuati nel mese selezionato, divisi per regione.</p><br>
        <div class="table-responsive"><table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">REGIONE</th>
                      <th scope="col">NUMERO DI TEST</th>
                      <th scope="col">POSITIVI</th>
                      <th scope="col">NEGATIVI</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $contatore = 1;
                  
                foreach($casi as $caso) {
                    if(isset($caso['positivi'])) {
                        $totale = $caso['positivi'];
                        if(isset($caso['negativi'])) {
                            $totale += $caso['negativi'];
                        }
                    }

              echo'<tr>
              <th scope="row">'.$contatore.'</th>
              <td>'.$caso['regione'].'</td>
              <td>'.$totale.'</td>';
            
              if(isset($caso['positivi'])) {
                  echo '<td>'.$caso['positivi'].'</td>';
              } else {
                  echo '<td>0</td>';
              }
              if(isset($caso['negativi'])) {
                  echo '<td>'.$caso['negativi'].'</td>';
              } else {
                  echo '<td>0</td>';
              } 
              
              $contatore++;
          }
                
            echo '</tbody>
                </table></div>';
            } else {
                echo "<h3>Non sono stati trovati casi nel mese selezionato.</h3>";
            }
        }
        echo'</div>
        </div>';
        
    }
    
    function pazientiPositivi() {
        echo '
        <div class="card w-75">
            <div class="card-body centrato">
                <h3 class="card-title">Pazienti positivi</h3>';
                $as = new AsController();
                $positivi = $as->utentiPositivi();
                echo '<p>Qui sono elencati tutti i pazienti positivi e le loro relative informazioni di contatto</p>';
                echo '<div class="table-responsive"><table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">CF</th>
                      <th scope="col">PAZIENTE</th>
                      <th scope="col">CITTÀ</th>
                      <th scope="col">TELEFONO</th>
                      <th scope="col">EMAIL</th>
                      <th scope="col">DATA</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $contatore = 1;
                foreach($positivi as $paziente) {
                    echo'
                    <tr>
                    <th scope="row">'.$contatore.'</th>
                    <td>'.$paziente["CF"].'</td>
                    <td>'.$paziente["nome"]. ' ' . $paziente["cognome"].'</td>
                    <td>'.$paziente["regione"].', '.$paziente["citta"].'</td>
                    <td>'.$paziente["tel"].'</td>
                    <td>'.$paziente["email"].'</td>
                    <td>'.$paziente["data"].'</td>';
                    $contatore ++;
                    }
            echo '</tbody>
                  </table></div>';
            echo'</div>
        </div>';
    }

    function esitiLaboratori() {
        echo '
        <div class="card w-75">
            <div class="card-body centrato">
                <h3 class="card-title">Esiti laboratori</h3><br>';
                echo '<p>Qui sono elencati gli esiti dei test diagnostici effettuati tramite la piattaforma, divisi per laboratori, con le loro relative informazioni. </p><br>';

                    $as = new AsController();
                    $laboratori = $as->esitiLaboratori();    
                    echo '<div class="table-responsive">
                    <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">LABORATORIO</th>
                                <th scope=col">REGIONE</th>
                                <th scope=col">CITTÀ</th>
                                <th scope="col">NUMERO DI TEST</th>
                                <th scope="col">POSITIVI</th>
                                <th scope="col">NEGATIVI</th>
                              </tr>
                            </thead>
                            <tbody>';
                    $contatore = 1;
                    foreach($laboratori as $laboratorio) {
                        if(isset($laboratorio['positivi'])) {
                            $totale = $laboratorio['positivi'];
                            if(isset($laboratorio['negativi'])) {
                                $totale += $laboratorio['negativi'];
                            }
                        }

                        echo'<tr>
                        <th scope="row">'.$contatore.'</th>
                        <td>'.$laboratorio['nome'].'</td>
                        <td>'.$laboratorio['regione'].'</td>
                        <td>'.$laboratorio['citta'].'</td>
                        <td>'.$totale.'</td>';
                        if(isset($laboratorio['positivi'])) {
                            echo '<td>'.$laboratorio['positivi'].'</td>';
                        } else {
                            echo '<td>0</td>';
                        }
                        if(isset($laboratorio['negativi'])) {
                            echo '<td>'.$laboratorio['negativi'].'</td>';
                        } else {
                            echo '<td>0</td>';
                        } 
                        
                        $contatore++;
                    }
            echo '</tbody>
                </table></div>';          
            echo '
            </div>
        </div>';

    }

    function selezionaMese() {
        echo'
        <div class="col-md-6 margin-auto centrato">
            <form method="POST" action="#">
            <h5>Seleziona un mese dell\'anno corrente</h5>
                <select class="form-control" name="mese">
                    <option value="01">Gennaio</option>
                    <option value="02">Febbraio</option>
                    <option value="03">Marzo</option>
                    <option value="04">Aprile</option>
                    <option value="05">Maggio</option>
                    <option value="06">Giugno</option>
                    <option value="07">Luglio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Settembre</option>
                    <option value="10">Ottobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Dicembre</option>
                </select>
            <button style="margin-top:2rem;" type="submit" class="btn btn-primary">VISUALIZZA RISULTATI</button>
            </form>
        </div>';
    }

    function contaTamponi($tamponi) {
        $positivi = array();
        $negativi = array();
        for($counter = 0; $counter < sizeof($tamponi); $counter++) {
            foreach($tamponi[$counter] as $tampone) {
            }
        }
    }
}