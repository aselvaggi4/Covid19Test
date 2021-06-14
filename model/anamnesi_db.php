<?php
require_once('db.php');

class Anamnesi {
    private $tampone;
    function __construct($file, $tampone) {
      
        $this->tampone = $tampone;
        global $db;

        $currentDirectory = getcwd();
        $uploadDirectory = "/uploads/";

        $errors = []; // Store errors here

        $fileExtensionsAllowed = ['pdf']; // These will be the only file extensions allowed 

        $fileName = $file['name'];
        
        //$fileExtension = strtolower(end(explode('.', $fileName)));
        $temp = explode('.', $fileName);
        $fileExtension = strtolower(end($temp));

        $fileSize = $file['size'];
        $fileTmpName  = $file['tmp_name'];
        $fileType = $file['type'];
        
        if($fileExtension=='pdf') {
            $fileName = "anamnesi_".$_SESSION['id']."_".$this->tampone.".pdf";
        }


        $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 

        if (isset($_POST['submit'])) {
          if (! in_array($fileExtension,$fileExtensionsAllowed)) {
            $errors[] = "L'estensione di questo file non è consentita. Per favore carica un file PDF.";
            return $errors;
          }

          if ($fileSize > 4000000) {
            $errors[] = "File exceeds maximum size (4MB)";
            return $errors;
          }

          if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
                echo $uploadPath;
            
                // Cancellare i primi 27 valori "C:\xampp\htdocs\Covid19Test"
                // NB: Non funzionerà se XAMPP è registrato in un'altra cartella
                $str = substr($uploadPath, 28);
                $query = "UPDATE tampone SET anamnesi = '$str' WHERE id = '$tampone'";
                $statement = $db->prepare($query);
                $statement->execute();

            } else {
                return $errors;
            }
          }
        }
    }
}