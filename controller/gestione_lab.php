<?php 

require_once('model/laboratori_db.php');
require_once('model/user_db.php');

class LaboratorioController {
    //Registra laboratorio nel database dei lab, e lo registra come utente tipo 4
    function registraLaboratorio($regione, $provincia, $citta, $via, $iva, $lab_email, $nome, $lab_psw, $img, $telefono, $costo_molecolare, $costo_antigenico) {
        
        $lab = new Utente();
        $setLab = new Laboratorio();
        

        $risultato  = $setLab->setLaboratori($lab_email, $lab_psw, $regione, $provincia, $citta, $via, $iva, $nome, $img, $telefono, $costo_molecolare, $costo_antigenico);
        echo $risultato."<br><br>";
        if($risultato !== false) {
            
            $tipo_utente = 4;
            $cognome = " ";
            $identificatore = " ";
            $cap = " ";
            $tel = " ";
        
            $controllo = $lab->setUtente($tipo_utente, $nome, $cognome, $citta, $provincia, $cap, $via, $identificatore, $tel, $lab_email, $lab_psw);
            echo "<span style='color:red'>".$controllo."</span>";

            if ($controllo !== 0) {
                $res = $lab->getUtente($lab_email, $lab_psw);
                $cognome = "NULL";
                $lab->validaSessione($tipo_utente, $res->id, $lab_email, $nome, $cognome);
                return true;
    
            } else {
                throw new Exception("Email esistente!");
            }
        } else if($risultato == false) {
            return false;
        }
    }

    function ricercaLaboratori($regione, $provincia, $citta, $data) {
        $ricercaLab = new Laboratorio();

        $laboratori = $ricercaLab->getLaboratori($regione, $provincia, $citta, $data);
        
        if($laboratori) {
            return $laboratori;
        } else {
            return false;
        }
    }
    // Trova i dati di un laboratorio per restituirli alle pagine che necessitano i dati
    function trovaLab($id) {

        $trovaLab = new Laboratorio();
        $laboratorio = $trovaLab->mostraLab($id);
        
        return $laboratorio;
        
    }
    //Controlla la disponibilità di un laboratorio in particolare data per mostrare le date libere sulla vista
    function controllaDisponibilita($id, $data) {
        $date = new Laboratorio();
        $orariOccupati = array();
        $orariLavorativi = array(
            0 => "09:00",
            1 => "09:30",
            2 => "10:00",
            3 => "10:30",
            4 => "11:00",
            5 => "11:30",
            6 => "12:00",
            7 => "12:30",
            8 => "13:00",
            9 => "14:30",
            10 => "15:00",
            11 => "15:30",
            12 => "16:00",
            13 => "16:30",
            14 => "17:00",
            15 => "17:30"
        );

        $dateUtilizzate = $date->getDisponibilita($id, $data);
        // Questa funzione recupera tutte le prenotazioni effettuate in un laboratorio in un dato giorno
        if($dateUtilizzate == false) {
            return $orariLavorativi;
        } else {
            // Controlla le date che riceviamo (nel formato YYYY:MM:DD // HH:MM:SS)-->
            // Taglia la stringa rimuovendo la data ed i secondi-> così ci resta un orario nel formato HH:MM
            // Confronta con un array di orari dalle 9 alle 18 con intervalli di 30 minuti (30 minuti per ogni tampone)
            // Restituisce solo i valori dell'array non presenti nell'array che ci è tornato restituito 
            foreach ($dateUtilizzate as $date) {
                $orario = substr($date['orario'], -8, 5);
                $orariOccupati[] = $orario;
            }

            $orariDisponibili = array_diff($orariLavorativi, $orariOccupati);
            
            return $orariDisponibili;
        }

    }
}


?>