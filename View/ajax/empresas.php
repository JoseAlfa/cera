<div class="row">
	<div class="col s12">
		<div class="row">
			<div class="col s6"><h4>Lista de empresas</h4></div>
			<div class="col s4 right-align">
				<button class="btn-floating blue waves-effect modal-trigger nuevo-bt tooltipped" <?php echo $this->tool('Nuevo','left'); ?> href="#nuevaemp">+</button>
			</div>
		</div>
		<table>
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Detalles</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $mensaje; ?>
        </tbody>
      </table>
	</div>
</div>
<!-- Modal Structure -->
  <div id="nuevaemp" class="modal">
    <div class="modal-content">
      <h4>Nueva empresa</h4>
      <form onsubmit="app.save();return false;" id="nuevosr">
        <div class="row">
          <div class="input-field col s12 l6">
            <input id="nombreNemp" type="text" class="validate" required>
            <label for="nombreNGr">Nombre empresa</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="detallesNemp" name="detallesNSer" type="text" class="validate" required>
            <label for="detallesNGr">detalles de empresa</label>
          </div>
        </div>
        <button type="submit" id="snembtn" hidden>save</button>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      <a href="#!" class="waves-effect waves-green btn blue" onclick="$('#snembtn').click();">Guardar</a>
    </div>
  </div>
<!-- Modal Structure -->
  <div id="empModal" class="modal modal-fixed-footer">
    <div class="modal-content">
      <div id="empreC"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn red">Cerrar</a>
      <a href="#!" class="waves-effect waves-green btn blue" onclick="$('#edempbtn').click();">Guardar</a>
    </div>
  </div>
<script>
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
   $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
    $('.empre').click(function(event) {
      ref=$(this).data('refer');
      $('#empModal').modal('open');
      app.detalles("empreC",{'ref':ref,'dir':'empresa'})
    });
    app.eliminar=function (id) {
      if (confirm('¿Desea eliminar esta empresa?')) {
        datos={
          url:'../Controller/guardar.php',
          type:'post',
          data:{'dir':'remempresa','ref':id},
          success:function (res) {
            if (res==1) {
              app.alert('empresa eliminada','green');
              app.detalles('oterViewContent',{dir:'empresas'},'peticiones.php');
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
    app.save=function () {
      datos={
        url:'../Controller/guardar.php',
        type:'post',
        data:{'dir':'nuevaempre','nom':$("#nombreNemp").val(),'det':$("#detallesNemp").val()},
        success:function (res) {
          if (res==1) {
            app.alert('servicio guardado','green');
            $("#nuevaemp").modal('close');
            setTimeout(function() {app.detalles('oterViewContent',{dir:'empresas'},'peticiones.php');}, 100);
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
        data:{
          'dir':'editarempre',
          'nom':$("#nombreEempre").val(),
          'det':$("#detallesEempre").val(),
          'ref':$("#empRef").val()},
        success:function (res) {
          if (res==1) {
            app.alert('Grupo guardado','green');
            $("#empModal").modal('close');
              setTimeout(function() {app.detalles('oterViewContent',{dir:'empresas'},'peticiones.php');}, 100);
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