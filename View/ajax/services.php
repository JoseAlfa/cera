<div class="row">
	<div class="col s12 m1"></div>
	<div class="col s12 m10">
		<div class="row">
			<div class="col s8"><h4>Lista de Servicios</h4></div>
			<div class="col s4 right-align">
				<button class="btn-floating blue waves-effect modal-trigger nuevo-bt tooltipped" <?php echo $this->tool('Nuevo','left'); ?> href="#nuevoser">+</button>
			</div>
		</div>
		<table>
        <thead>
          <tr>
              <th>Categoría</th>
              <th>Nombre del Servicio</th>
              <th>Dirección del Servicio</th>
              <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $mensaje; ?>
        </tbody>
      </table>
	</div>
</div>
<!-- Modal Structure -->
  <div id="nuevoser" class="modal">
    <div class="modal-content">
      <h4>Nuevo servicio</h4>
      <form onsubmit="app.save();return false;" id="nuevosr">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreNSer" name="nombreNSer" type="text" class="validate" required>
            <label for="nombreNGr">Nombre servicio</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="detallesNSer" name="detallesNSer" type="text" class="validate" required>
            <label for="detallesNGr">Dirección</label>
          </div>
          <div class="input-field col s12">
          <select id="categoriaNser">
            <option value="undefined" disabled selected>Selccione una opción</option>
            <?php echo $categorias; ?>
          </select>
          <label>Categoria</label>
        </div>
        </div>
        <button type="submit" id="sgbtn" hidden>save</button>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      <a href="#!" class="waves-effect waves-green btn blue" onclick="$('#sgbtn').click();">Guardar</a>
    </div>
  </div>
<!-- Modal Structure -->
  <div id="serm" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div id="serviceC"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      <a href="#!" class="waves-effect waves-green btn blue" onclick="$('#edserbtn').click();">Guardar</a>
    </div>
  </div>
<script>
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
   $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
    $('.serv').click(function(event) {
      ref=$(this).data('refer');
      $('#serm').modal('open');
      app.detalles("serviceC",{'ref':ref,'dir':'servicio'})
    });
    app.eliminar=function (id) {
      if (confirm('¿Desea eliminar este servicio?')) {
        datos={
          url:'../Controller/guardar.php',
          type:'post',
          data:{'dir':'remservicio','ref':id},
          success:function (res) {
            if (res==1) {
              app.alert('servicio eliminado','green');
              $("#nuevoGr").modal('close');
              app.loadEl('servicios','servicios');
            }else{
              app.alert('Error: '+res,'red');
            }
          },
          error:function (ss,ff,gg) {
            app.alert('Error intente más tarde','red');
          }
        }
        app.send(datos);
      }else{
        return false;
      }
    }
    app.save=function () {
      if (!$("#categoriaNser").val()) {
        app.alert('selecciona categoria','red');
        return false;
      }
      datos={
        url:'../Controller/guardar.php',
        type:'post',
        data:{'dir':'nuevoservice','nom':$("#nombreNSer").val(),'det':$("#detallesNSer").val(),'cat':$("#categoriaNser").val()},
        success:function (res) {
          if (res==1) {
            app.alert('servicio guardado','green');
            $("#nuevoser").modal('close');
            setTimeout(function() {app.loadEl('servicios','servicios');}, 100);
            Materialize.Toast.removeAll();
          }else{
            app.alert('Error: '+res,'red');
          }
        },
        error:function (ss,ff,gg) {
          app.alert('Error intente más tarde','red');
        }
      }
      app.send(datos);
    }
    app.edit=function () {
      datos={
        url:'../Controller/guardar.php',
        type:'post',
        data:{'dir':'editarservice','nom':$("#nombreESer").val(),'det':$("#detallesESer").val(),
        'cat':$("#categoriaEser").val(),'ref':$("#refserv").val()},
        success:function (res) {
          if (res==1) {
            app.alert('Grupo guardado','green');
            $("#serm").modal('close');
              setTimeout(function() {app.loadEl('servicios','servicios');}, 100);
          }else{
            app.alert('Error: '+res,'red');
          }
        },
        error:function (ss,ff,gg) {
          app.alert('Error intente más tarde','red');
        }
      }
      app.send(datos);
    }
  });
</script>