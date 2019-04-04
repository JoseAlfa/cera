<h4>Detalles de grupo</h4>
<form onsubmit="app.editGrupo();return false;">
	<input type="hidden" id="gruRef" value="<?php echo $ref; ?>">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreEGr" name="nombreNGr" type="text" class="validate" required value="<?php echo $datos['nom']; ?>">
            <label for="nombreNGr">Nombre grupo</label>
          </div>
          <div class="input-field col s12">
            <input id="detallesEGr" name="detallesNGr" type="text" class="validate" required value="<?php echo $datos['det']; ?>">
            <label for="detallesNGr">Detalles grupo</label>
          </div>
        </div>
        <button type="submit" id="egbtn" hidden>save</button>
</form>