<form method="POST" action="#" style="text-align:center">
    <div class="row form-prenotazione ">
        <div class="col-md-6 input form">
        <label>Tipo di tampone</label>

        <select class="form-control" id="tipo" name="tipo">
            <option value="antigenico">Test antigenico</option>
            <option value="molecolare">Test molecolare</option>
        </select>
        </div>
        <div class="col-md-6 input-form">
            <input type="date" name="data" id="data" class="form-control" aria-label="Data" placeholder="Data" required>
        </div>
        <div class="col-md-3 input-form">
            <input type="text" id="nome" name="nome" class="form-control" aria-label="Nome" required>
            <label>Nome</label>

        </div>
        <div class="col-md-3 input-form">
            <input type="text" id="cognome" name="cognome" class="form-control" aria-label="Cognome" required>
            <label>Cognome</label>
        </div>
        <div class="col-md-3 input-form">
            <input type="email" id="email" name="email" class="form-control" aria-label="email" required>
            <label>E-mail</label>
        </div>
        <div class="col-md-3 input-form">
            <input type='text' class='form-control' name='CF' id='CF' aria-label='Codice fiscale' required>
            <label>Codice Fiscale</label>
        </div>
    </div>
</form>