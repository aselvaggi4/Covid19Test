<?php include("sessioni.php"); 
require_once('controller/gestione_lab.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca un laboratorio</title>

    <?php include("head-include.php"); 
    

    $page_id = 0;

   ?>
   <script>
        var googleKey = config.MAPS_KEY;

        function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key='+ googleKey +'&callback=initMap';
    
    document.body.appendChild(script);
}

window.onload = loadScript;    


   </script>


</head>

<body style="background: linear-gradient(#141e30, #243b55);">

    <?php include ("view/navbar.php"); ?>

    <?php 
    
    $latlng = array();
    $contatore = 0;
    
    
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 ricerca-lab" style="height:100vh; overflow: auto; color: black; background-color:#fff;">
                <h3 style="padding-top:15px; padding-bottom:15px;">Ricerca laboratori: <span style="color: #0a58ca;"><?php echo $_GET["citta"]; ?></span></h3>

                <?php  
                    
                    $lab = new LaboratorioController();

                    $laboratori = $lab->ricercaLaboratori($_GET["regione"], $_GET["provincia"], $_GET["citta"]);
                if(!empty($laboratori)) {                      
                    
                    foreach($laboratori as $laboratorio) {
                        echo "<a href='laboratorio?id=".$laboratorio['id']."'>"; 
                ?>
                <div class="row">
                
                    <div class="col-5">
                        <img src="<?php if($laboratorio['img'] != NULL) {echo $laboratorio['img'];} else echo 'img/test-tube.jpg';?>" width="100%">
                    </div>
                    <div class="col-7">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item nome-lab"><?php echo $laboratorio['nome'];?></li>
                            <li class="list-group-item">
                                <?php
                                    
                                    echo $laboratorio['via'].', '.$laboratorio['citta'] . ', ' . $laboratorio['provincia'];
                                    //$latlng = array($laboratorio['lat'], $laboratorio['lng']);
                                    $latlng[$contatore] = array($laboratorio['nome'],$laboratorio['lat'],$laboratorio['lng'],$laboratorio['via']);
                                    $contatore ++;
                                ?>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                </a>
                <?php } 
                } else {
                    echo "<h3>Non ci sono laboratori di analisi convenzionati nella zona selezionata </h3>"; } ?>
            </div>
            <div class="col-md-7 mappe">
                <?php 
                
                    $sizeArray = count($latlng);
                   
                    for ($row = 0; $row < $sizeArray; $row++) {
                        for ($col = 0; $col < 3; $col++) {
                         // echo $latlng[$row][$col];
                        }
                      }
                 ?>
                <div id="mapCanvas"></div>
            </div>
        </div>
    </div>

    <script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);
        
    // Multiple markers location, latitude, and longitude
    
    var markers = [
        <?php 
            $sizeArray = count($latlng);
            for ($riga = 0; $riga < $sizeArray; $riga++) {
                echo '["'.$latlng[$riga][0].'", '.$latlng[$riga][1].', '.$latlng[$riga][2].'],'; 
              }  
        ?>
    ];
                      
    // Info window content
    var infoWindowContent = [
        <?php 
            $sizeArray = count($latlng);
            for ($row = 0; $row < $sizeArray; $row++) {
                 ?>
                ['<div class="info_content">' +
                '<h5><?php echo $latlng[$row][0]; ?></h5>' +
                '<p><?php echo $latlng[$row][3]; ?></p>' + '</div>'],
        <?php } ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(10);
        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
    google.maps.event.addDomListener(window, 'load', initMap);
</script> 
       
    <?php include ("footer-include.php"); ?>
   

</body>

</html>