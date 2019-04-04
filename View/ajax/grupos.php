<div class="row">
	<div class="col s12 m1"></div>
	<div class="col s12 m10">
		<div class="row">
			<div class="col s8"><h4>Lista de Usuarios</h4></div>
			<div class="col s4 right-align">
				<button class="btn-floating blue waves-effect modal-trigger nuevo-bt tooltipped" <?php echo $this->tool('Nuevo','left'); ?> href="#nuevoGr">+</button>
			</div>
		</div>
		<table>
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Detalles</th>
              <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $mensaje; ?>
        </tbody>
      </table>
	</div>
</div>
<!-- Modal Structure -->
  <div id="nuevoGr" class="modal">
    <div class="modal-content">
      <h4>Nuevo grupo</h4>
      <form onsubmit="app.saveGrupo();return false;" id="nuevoGrupo">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreNGr" name="nombreNGr" type="text" class="validate" required>
            <label for="nombreNGr">Nombre grupo</label>
          </div>
          <div class="input-field col s12">
            <input id="detallesNGr" name="detallesNGr" type="text" class="validate" required>
            <label for="detallesNGr">Detalles grupo</label>
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
  <div id="grupM" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div id="grupC"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      <a href="#!" class="waves-effect waves-green btn blue" onclick="$('#egbtn').click();">Guardar</a>
    </div>
  </div>
<script>
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
    $('.grup').click(function(event) {
      ref=$(this).data('refer');
      $('#grupM').modal('open');
      app.detalles("grupC",{'ref':ref,'dir':'grupo'})
    });
    app.eliminar=function (id) {
      if (confirm('¿Desea eliminar este grupo?')) {
        datos={
          url:'../Controller/guardar.php',
          type:'post',
          data:{'dir':'remgrupo','ref':id},
          success:function (res) {
            if (res==1) {
              app.alert('Grupo elimnado','green');
              $("#nuevoGr").modal('close');
              app.loadEl('grupos','grupos');
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
      }else{
        return false;
      }
    }
    app.saveGrupo=function () {
      datos={
        url:'../Controller/guardar.php',
        type:'post',
        data:{'dir':'nuevogrupo','nom':$("#nombreNGr").val(),'det':$("#detallesNGr").val()},
        success:function (res) {
          if (res==1) {
            app.alert('Grupo guardado','green');
            $("#nuevoGr").modal('close');
            setTimeout(function() {app.loadEl('grupos','grupos');}, 100);
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
    app.editGrupo=function () {
      datos={
        url:'../Controller/guardar.php',
        type:'post',
        data:{'dir':'editargrupo','nom':$("#nombreEGr").val(),'det':$("#detallesEGr").val(),'ref':$("#gruRef").val()},
        success:function (res) {
          if (res==1) {
            app.alert('Grupo guardado','green');
            $("#grupM").modal('close');
              setTimeout(function() {app.loadEl('grupos','grupos');}, 100);
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