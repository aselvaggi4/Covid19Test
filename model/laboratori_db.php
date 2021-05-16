<?php
    require_once('db.php');

    function getLaboratori($regione, $provincia, $citta, $data ) {

        global $db;
        $query1 = "SELECT * FROM laboratori WHERE citta = '$citta'";
        $query2 = "SELECT * FROM laboratori WHERE provincia = '$provincia' AND NOT citta = '$citta'";
        $query3 = "SELECT * FROM laboratori WHERE regione = '$regione' AND NOT citta = '$citta' AND NOT provincia = '$provincia'";

        $statement1 = $db->prepare($query1);
        $statement2 = $db->prepare($query2);
        $statement3 = $db->prepare($query3);

        $statement1->execute();

        $count1 = $statement1->rowCount(); 

        $laboratori = array();
        while($row = $statement1->fetch(PDO::FETCH_ASSOC)) {
            $laboratori[] = $row;            
        }
        // Se ci sono meno di 4 laboratori per la città selezionata-> li cerca per provincia
        if($count1 < 4) {
            //Esegue query per provincia
            $statement2->execute();
            $count2 = $statement2->rowCount();
            while($row = $statement2->fetch(PDO::FETCH_ASSOC)) {
                $laboratori[] = $row;
            }
            //Se nella provincia ci sono meno di 4 laboratori -> cerca laboratori per regione
            //PROVA A CREARE ARRAY ASSOCIATIVO E APPEND TUTTI I VALORI PER POI ESEGUIRE UN UNICO RETURN
            // -> FOREACH LABORATORIO AS LABORATORIO (?)
            if($count2 < 4) {
                $statement3->execute();
                $count3 = $statement3->rowCount();
                    if($count3 > 0) {
                        while($row = $statement3->fetch(PDO::FETCH_ASSOC)) {
                            $laboratori[] = $row;  
                        }
                    }
                }
            
        }
        return $laboratori;
    }


?>