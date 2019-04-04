<div class="row">
	<div class="col s12 m1"></div>
	<div class="col s12 m10">
		<div class="row">
			<div class="col s12"><h4>Lista de Solicitudes <?php echo $tit; ?></h4></div>
		</div>
		<table>
        <thead>
          <tr>
              <th>Eviado por</th>
              <?php if ($rol==1) {
                echo "<th>Enviado a</th>";
              } ?>
              <th>Solicitud</th>
              <th>Detalles</th>
              <th>Enviado</th>
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
  <div id="modal<?php echo $mc;?>" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Detalles</h4>
      <div id="info<?php echo $mc; ?>"></div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect red btn">Cerrar</a>
    </div>
  </div>
<script>
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
    $('.detailM').click(function(event) {
      ref=$(this).data('refer');
      $('#modal<?php echo $mc;?>').modal('open');
      app.detalles("info<?php echo $mc; ?>",{'ref':ref,'dir':'solicitud'})
    });
    app.eliminar=function (id) {
      if (confirm('¿Desea eliminar esta solicitud?')) {
        alert('Eliminado');
      }else{
        return false;
      }
    }
  });
</script>