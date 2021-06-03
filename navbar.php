<nav class="navbar navbar-expand-lg navbar-light">

  <div class="container-fluid">

    <a class="navbar-brand" href="index">
      <img src="img/logo_small.png" style="width:100%;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav centra-navbar">
        <li class="nav-item">
          <a class="nav-link <?php if ($page_id == 1) {
                                echo "active";
                              } ?>" aria-current="page" href="chi-siamo">CHI SIAMO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page_id == 2) {
                                echo "active";
                              } ?>" href="convenziona-laboratorio">CONVENZIONA IL TUO LABORATORIO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page_id == 3) {
                                echo "active";
                              } ?>" href="#">FAQ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="login" data-toggle="modal" data-target="#exampleModal" href="#">LOGIN</a>
        </li>


      </ul>
      <?php 
      
      // Se la sessione non è attiva stampa il bottone per registrarsi
      if(!isset($_SESSION["valid"])) { echo  '
      <form method="get" action="registrazione.php" class="logout">
        <button type="submit" class="btn btn-light btn-navbar dropdown-toggle" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false" href="registrazione">REGISTRATI</button>
        <div class="dropdown-menu">

          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=1">Registrati come <span
              class="tipo-utente">Privato</span></a>
          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=2">Registrati come <span
              class="tipo-utente">Azienda</span></a>
          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=3">Registrati come <span
              class="tipo-utente">Medico</span></a>
        </div>
      </form>
       '; } else echo 
       '<form method="POST" action="index" class="logout"><button type="submit" name="logout" class="btn btn-danger">Logout</button></form>'; 
       
       if(isset($_POST['logout'])) {

        session_destroy();
        echo "<meta http-equiv='refresh' content='0'>";
       }
       
       ?>
       
      <a class="fas fa-user" data-toggle="modal" data-target="#exampleModal" href="#"></a>
    </div>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header white-text">
        <h5 class="modal-title" style="margin:auto;" id="exampleModalLabel">Effettua il login</h5>
        
          <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>

        </button>

      </div>
      <div class="modal-body">
        <?php
        
if(isset($_POST['accesso'])) {
    
  $gestioneUtente = new UtenteController();
  
  try {
    $gestioneUtente->loginUtente($_POST['email'], $_POST['password']);
  } catch (Exception $e) {
    echo "<script>alert('I dati inseriti sono errati!')</script>";
  }

  echo "<meta http-equiv='refresh' content='0'>";

} 
    // Display the Form and the Submit Button

 else if(!isset($_SESSION["valid"])) { ?>
        <form method="post" action="">
          <div class="form-group input-form">
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <label for="exampleInputEmail1">Indirizzo email</label>
          </div>
          <div class="form-group input-form">
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            <label for="exampleInputPassword1">Password</label>
          </div>
          <input type="hidden" name="accesso">
          <!--
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> -->
          <button type="submit" class="btn btn-outline-primary bottone-accedi">Accedi</button>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>