 <div class="row">
 	<?php 
 		if ($rol==1) {
//s.ID_SOLICITUD,s.ID_PRIORIDAD,s.ID_TIPO,s.ID_STATUS,s.ID_FUENTE,s.ID_PERSONA,s.PER_ID_PERSONA,s.NOMBRE_SOLICITUD,s.FECHA_CREADO,s.FECHA_EDITADO,s.FECHA_RESUELTO,s.IMAGEN_SOLICITUD,s.DESCRIPCION_SOLICITUD,s.ARCHIVOS,s.RESPUESTA_AGENTE,p.NOMBRE_PRIORIDAD,p.OBSERVACIONES_PRIORIDADES,pe.ID_PERSONA idenvia,pe.NOMBRE_PERSONA nomenvia,pe.APELLIDO_PATERNO paenvia,pe.APELLIDO_MATERNO maenvia,pr.NOMBRE_PERSONA nomrecibe,pr.APELLIDO_PATERNO parecive,pr.APELLIDO_MATERNO marecive,pr.ID_PERSONA idrecive
 			//echo var_dump($datos);
 			?>
	<div class="col s12 m6">
		<b>Persona que envía:</b>
		<p><?php echo $datos['nomenvia'].' '.$datos['paenvia'].' '.$datos['maenvia']; ?></p>
	</div>
	<div class="col s12 m6">
		<b>Persona recibe:</b>
		<p><?php echo $datos['nomrecibe'].' '.$datos['parecive'].' '.$datos['marecive']; ?></p>
	</div>
	<div class="col s12 m6">
		<b>Nombre solicitud:</b>
		<p><?php echo $datos['NOMBRE_SOLICITUD']; ?></p>
	</div>
	<div class="col s12 m6">
		<b>Detalles de solicitud:</b>
		<p><?php echo $datos['DESCRIPCION_SOLICITUD']; ?></p>
	</div>
	<div class="col s12 m6">
		<b>Enviado:</b>
		<p><?php echo $this->getDate($datos['FECHA_CREADO']); ?></p>
	</div>
	<div class="col s12 m6">
		<b>Recibido:</b>
		<p><?php if(is_null($datos['FECHA_EDITADO'])){echo 'Aún no recibido.';}else{echo $this->getDate($datos['FECHA_EDITADO']);} ?></p>
	</div>
	<div class="col s12 m6">
		<b>Resuelto:</b>
		<p><?php if(is_null($datos['FECHA_RESUELTO'])){echo 'Aún no resuelto.';}else{echo $this->getDate($datos['FECHA_RESUELTO']);} ?></p>
	</div>
	<div class="col s12 m6">
		<b></b>
		<p></p>
	</div>
	<div class="col s12 m6">
		<b></b>
		<p></p>
	</div>
	<div class="col s12 m6">
		<b></b>
		<p></p>
	</div>
 			<?php
 		}else{
 			?>
	<form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input disabled value="I am not editable" id="disabled" type="text" class="validate">
          <label for="disabled">Disabled</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          This is an inline input field:
          <div class="input-field inline">
            <input id="email" type="email" class="validate">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
      </div>
    </form>



 	<?php
 		}
 	 ?>
 </div>