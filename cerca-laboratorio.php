<form method="GET" action="trova-laboratorio">
  <h3 class="white-text centrato">Cerca un laboratorio:</h3>
<div class="input-group">
  <div class="form-outline">

    <input class="form-control bordo-regione" name="regione" id="regione" type="text" placeholder="Regione" aria-label="regione" pattern="[A-Za-z]{1,}" oninvalid="setCustomValidity('Formato non valido')" required>
    <input class="form-control bordo-centrale" name="provincia" id="provincia" type="text" placeholder="Provincia" aria-label="provincia" pattern="[A-Za-z]{2}" oninvalid="setCustomValidity('Formato non valido. Es: BA, MI..')" required>
    <input class="form-control bordo-centrale" name="citta" id="citta" type="text" placeholder="Città" aria-label="citta" pattern="[A-Za-z]{1,}" oninvalid="setCustomValidity('Formato non valido')" required>
    <input class="form-control bordo-data" type="date" name="data" id="data" placeholder="Data" aria-label="data" required>
    <button id="search-button" type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
    
  </div>
 
</div>

</form>

