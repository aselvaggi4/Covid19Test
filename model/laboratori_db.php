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

    function registerLab($lab_email, $password, $regione, $provincia, $citta, $via, $iva, $nome) {

        global $db;
        // Call API per calcolare automaticamente latitudine e longitudine di un laboratorio
        $queryString = http_build_query([
            'access_key' => '190966a6a335f1f8d720580139d58698',
            'query' => $via." ".$regione,
            'region' => $citta,
            'output' => 'json',
            'limit' => 1,
          ]);
        print_r($queryString);
        $ch = curl_init(sprintf('%s?%s', 'http://api.positionstack.com/v1/forward', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          
        $json = curl_exec($ch);
          
        curl_close($ch);
          
        $apiResult = json_decode($json, true);
        print_r($apiResult);
        $lat = $apiResult['data'][0]['latitude'];
        $lng = $apiResult['data'][0]['longitude'];
        
        $sql = "SELECT * FROM laboratori WHERE username = '$lab_email'";

        $check = $db->prepare($sql);
        $check->execute();

        $count = $check->rowCount(); 
          echo "<br><br>".$count;
        if($count == 0) {
            
            $query = "INSERT INTO laboratori (lat, lng, regione, provincia, citta, via, iva, username, password, nome) VALUES ('$lat', '$lng', '$regione','$provincia', '$citta', '$via', '$iva', '$lab_email', '$password', '$nome')";
           
            $statement = $db->prepare($query);
            $statement->execute();
            return true;

        } else {
        return false;
    }
}
?>