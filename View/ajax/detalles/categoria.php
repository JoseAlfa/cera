<h4>Detalles de categoría</h4>
<form onsubmit="app.edit();return false;">
	<input type="hidden" id="empRef" value="<?php echo $ref; ?>">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreEempre" name="nombreNGr" type="text" class="validate" required value="<?php echo $datos['nom']; ?>">
            <label for="nombreNGr">Nombre categoría</label>
          </div>
          <div class="input-field col s12">
            <input id="detallesEempre" name="detallesNGr" type="text" class="validate" required value="<?php echo $datos['det']; ?>">
            <label for="detallesNGr">Detalles categoría</label>
          </div>
        </div>
        <button type="submit" id="edempbtn" hidden>save</button>
</form>