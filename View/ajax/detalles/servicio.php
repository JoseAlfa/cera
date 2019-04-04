<h4>Nuevo servicio</h4>
      <form onsubmit="app.edit();return false;" id="nuevosr">
        <input type="hidden" id="refserv" value="<?php echo $ref; ?>">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreESer" name="nombreNSer" type="text" class="validate" required value="<?php echo $datos['nomser']; ?>">
            <label for="nombreNGr">Nombre servicio</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="detallesESer" name="detallesNSer" type="text" class="validate" required value="<?php echo $datos['dirser']; ?>">
            <label for="detallesNGr">Dirección</label>
          </div>
          <div class="input-field col s12">
          <select id="categoriaEser">
            <option value="undefined" disabled>Selccione una opción</option>
            <?php echo $categorias; ?>
          </select>
          <label>Categoria</label>
        </div>
        </div>
        <button type="submit" id="edserbtn" hidden>save</button>
      </form>