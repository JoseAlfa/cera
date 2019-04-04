<div class="row">
	<div class="col s12 m1"></div>
	<div class="col s12 m10">
		<div class="row">
			<div class="col s8"><h4>Lista de Usuarios</h4></div>
			<div class="col s4 right-align">
				<button class="btn-floating blue waves-effect modal-trigger nuevo-bt tooltipped" <?php echo $this->tool('Nuevo','left'); ?> href="#modal1">+</button>
			</div>
		</div>
		<table>
        <thead>
          <tr>
              <th>Nombre</th>
              <th>Compañia</th>
              <th>Grupo</th>
              <th>Movil</th>
              <th>Dirección</th>
              <th>Municipio</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $mensaje; ?>
        </tbody>
      </table>
	</div>
</div>
<!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
<script>
	$(document).ready(function(){
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('.tooltipped').tooltip({delay: 50});
  });
</script>