<?php 
require_once('./model/as_db.php');

class AsController {

    function panoramicaCasi($mese) {
        $as = new AziendaSanitaria();
        $panoramica = $as->trovaPanoramica($mese);
        if($panoramica) {
            $esiti = array();
            foreach($panoramica[0] as $negativi) { 
                $esiti[] = $negativi;
            }
            foreach($panoramica[1] as $positivi) {
                $chiave = array_search($positivi['regione'], array_column($esiti, 'regione'), TRUE);

                if(isset($chiave)) {
                    $esiti[$chiave]['positivi'] = $positivi['positivi'];
                }
            }
            return $esiti;
        } else {
            return false;
        }
    }
        
    function esitiLaboratori() {
        $as = new AziendaSanitaria();
        $esiti = $as->trovaEsiti();
        
        /* Per ogni oggetto dell'array (0 e 1) 
            Per ogni oggetto dell array 
                Aggiungi ad un array già creato con i vari valori 
                    Nome del laboratorio, positivi ecc
                SE array[nomeLaboratorio] == ricerca_valore(nuovoArray)
                    aggiungi "negativi" */

        $laboratori = array();
        foreach($esiti[0] as $laboratorio) { 
            $laboratori[] = $laboratorio;
        }
        foreach($esiti[1] as $laboratorioNegativo) {
            $chiave = array_search($laboratorioNegativo['username'], array_column($laboratori, 'username'), TRUE);
            if(isset($chiave)) {
                $laboratori[$chiave]['negativi'] = $laboratorioNegativo['negativi'];
            }
        }
        return $laboratori;
    }

    function utentiPositivi() {
        $as = new AziendaSanitaria();
        $positivi = $as->trovaPositivi();
        return $positivi;
    }

}
