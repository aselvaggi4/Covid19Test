<?php 

$servername="localhost";
$username = "root";
$password = "";
$dbname = "sitotamponi";

$tipo_utente = $_POST['tipo_utente'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$citta = $_POST['citta'];
$provincia = $_POST['provincia'];
$cap = $_POST['cap'];
$indirizzo = $_POST['indirizzo'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$psw = $_POST['password'];



echo "tipo utente:".$_POST['tipo_utente'];
 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

if ($tipo_utente === '1' ) {
    $CF = $_POST['CF'];
    $sql = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, CF, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$CF', '$email', '$psw')";

} else if($tipo_utente === '2') {
    $IVA = $_POST['IVA'];
    $sql = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, IVA, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$IVA', '$email', '$psw')";

} else if($tipo_utente === '3') {
    $CR = $_POST['CR'];
    $sql = "INSERT INTO utente (tipo_utente, Nome, Cognome, citta, provincia, cap, Indirizzo, tel, Codice_regionale, email, password) VALUES ('$tipo_utente','$nome', '$cognome', '$citta', '$provincia', '$cap', '$indirizzo', '$tel', '$CR', '$email', '$psw')";
}


if ($conn->query($sql) === TRUE) {
    echo "Inseriti i valori nella tabella.";
} else {
    echo "Error: ".$conn->error;
}

?>