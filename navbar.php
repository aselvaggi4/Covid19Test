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
                              } ?>" href="#">GUIDA UNICA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($page_id == 3) {
                                echo "active";
                              } ?>" href="#">CONVENZIONA IL TUO LABORATORIO</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="login" data-toggle="modal" data-target="#exampleModal" href="#">LOGIN</a>
        </li>


      </ul>
      <form method="get" action="registrazione.php">
        <button type="submit" class="btn btn-light btn-navbar dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="registrazione">REGISTRATI</button>
        <div class="dropdown-menu" >
        
          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=1">Registrati come <span class="tipo-utente">Privato</span></a>
          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=2">Registrati come <span class="tipo-utente">Azienda</span></a>
          <a class="dropdown-item" style="color:black !important;" href="registrazione?id=3">Registrati come <span class="tipo-utente">Medico</span></a>
        </div>
      </form>
      <a class="fas fa-user" data-toggle="modal" data-target="#exampleModal" href="#"></a>
    </div>
  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="margin:auto;" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
          style="border: 0;background-color: #fff;font-size: 1.5rem;">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        Modificare testo
        <br><br>

        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Indirizzo email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
              placeholder="Inserisci il tuo indirizzo email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1"
              placeholder="Inserisci la tua password ">
          </div>
          <!--
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> -->
          <button type="submit" class="btn btn-primary bottone-accedi">Accedi</button>
        </form>

      </div>
    </div>
  </div>
</div>