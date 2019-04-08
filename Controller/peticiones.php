<?php 
@session_start();
include_once "../Model/database.php";
$dir=$_POST['dir'];
$pet=new Peticinoes();
if ($dir) {
	if (method_exists($pet, $dir)) {
		$pet->{$dir}();
	}else{
		echo 'Not Found '.$dir;
	}
}else{echo 'Not Found empty directory';}

/**
 * Proceos de peticiones al servidor
 */
class Peticinoes{
    /**
     * En el constructor se inicializa la clase de base de datos
     */
    public $reload="<p>es necesario recargar la página. Haz click <a href='#' onclick='window.location.reload();'>aquí</a>.</p>";
    public function __construct(){
        $this->db = new Database();
    }
    private function valid($param=''){
    	if ($param==null||$param=='') {
    		return false;
    	}else{
    		return true;
    	}
    }
    public function log(){
    	$user=$_POST['usuario'];
    	$pas=$_POST['contrasena'];
    	$mensaje='Verifique que haya ingresado los datos';
    	$error=true;
    	//echo $user.$pas;
    	if ($this->valid($user) && $this->valid($pas)) {
    		$sql="select p.ID_PERSONA idu,p.NOMBRE_PERSONA nom,p.APELLIDO_PATERNO pat from personas p where p.NOMBRE_USUARIO='".$user."' and p.CONTRASENA='".md5($pas)."';";
    		//echo $sql;
    		$consulta=$this->db->query($sql);
    		$fila = $consulta->fetch_assoc();
    		//var_dump($fila);
    		if ($fila!=null) {
    				$id=$fila['idu'];
    				$nombre=$fila['nom'];
    				$mensaje='Bienvenido '.$nombre;
    				$error=false;
    				$_SESSION['idu']=$id;
    		}else{
    			$mensaje="Error en usuario o contraseña";
    		}
    	}
    	echo json_encode(array('error'=>$error,'msg'=>$mensaje));
    }
    public function users(){
    	$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$sql='SELECT p.NOMBRE_PERSONA nom,p.APELLIDO_PATERNO pat,p.APELLIDO_MATERNO mat,p.TELEFONO_MOVIL mov,m.NOMBRE_MUNICIPIO mun, g.NOMBRE_GRUPO grup,c.NOMBRE_COMPANIA com, p.DIRECCION dir FROM personas p, municipios m,grupos g,companias c WHERE p.ID_GRUPO=g.ID_GRUPO and p.ID_COMPANIA=c.ID_COMPANIA and p.ID_MUNICIPIOS=m.ID_MUNICIPIOS and ID_PERSONA!='.$id.';';
	    		if ($resultado=$this->db->query($sql)) {
	    			$mensaje="";
	    			if($resultado->num_rows==0){
	    				$mensaje.='<tr><td colspan="6">No hay resultados</td></tr>';
	    			}else{
					   while ($user = $resultado->fetch_assoc()) {
						    $mensaje.='<tr>'.
						    			'<td>'. $user['nom'].' '. $user['pat'].' '. $user['mat'].'</td>'.
						    			'<td>'. $user['com'].'</td>'.
						    			'<td>'. $user['grup'].'</td>'.
						    			'<td>'. $user['mov'].'</td>'.
						    			'<td>'. $user['dir'].'</td>'.
						    			'<td>'. $user['mun'].'</td>'.
						    		'</tr>' ;
						}
					}
					include_once('../View/ajax/users.php');
				}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
    	//echo $mensaje;
    }
    private function isAdmin(){

    }
    private function getId(){
    	$id=0;
    	if (isset($_SESSION['idu'])) {
    		$id=$_SESSION['idu'];
    	}
    	return $id;
    }
    private function getRol($id=false){
	 	$rol=0;
	 	if ($id) {
	 		include_once('../Model/database.php');
	 		$bd= new Database();
	 		$sql="select p.ID_PERSONA idu,p.ID_ROL rol from personas p where p.ID_PERSONA='".$id."';";
	 		//echo $sql;
	 		$query=$bd->query($sql);
	 		$fila = $query->fetch_assoc();
	 		if ($fila!=null) {
	 			$rol=$fila['rol'];
	 		}
	 	}
	 	return $rol;
	}
	public function servicios(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$sql='SELECT s.ID_SERVICIO id, c.NOMBRE_CATEGORIA cat, s.NOMBRE_SERVICIO nomser, s.DIRECCION_SERVICIO dirser FROM servicios as s, categorias as c WHERE c.ID_CATEGORIA = s.ID_CATEGORIA;';
	    		$db=$this->db->getConnection();
	    		if ($resultado=$db->query($sql)) {
	    			$mensaje="";
	    			if($resultado->num_rows==0){
	    				$mensaje.='<tr><td colspan="3">No hay resultados</td></tr>';
	    			}else{
					   while ($user = $resultado->fetch_assoc()) {
					   		$id=$user['id'];
						    $mensaje.='<tr>'.
						    			'<td>'. $user['cat'].'</td>'.
						    			'<td>'. $user['nomser'].'</td>'.
						    			'<td>'. $user['dirser'].'</td>'.
						    			'<th><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$id.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped serv" data-refer=\''.$id.'\' '.$this->tool('Detalles').'></i></th>'.
						    		'</tr>' ;
						}
					}
					$categorias=$this->getCategoriasSel();
					include_once('../View/ajax/services.php');
				}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    		//echo $mensaje;
    	}else{
    		echo $this->reload;
    	}

    }

    public function getCategoriasSel($id='') {
    	$sql='SELECT c.ID_CATEGORIA id,c.NOMBRE_CATEGORIA nom FROM categorias c;';
    	$sel='';
    	$res=$this->db->get_data($sql);
    	if ($res['STATUS']=='OK') {
    		$res=$res['DATA'];
    		foreach ($res as $valor) {
    			if ($id==$valor['id']) {
    				$sel.='<option value="'.$valor['id'].'" selected>'.$valor['nom'].'</option>';
    			}else{
    				$sel.='<option value="'.$valor['id'].'">'.$valor['nom'].'</option>';
    			}
    		}
    	}
    	return $sel;
    }

	public function baseconocimientos(){
			$id=$this->getId();
	    	$mensaje="Error en la sesión";
	    	$error=true;
	    	$datos="";
	    	//echo $id;
	    	if ($id!=0) {
	    		$rol=$this->getRol($id);
	    		//echo $rol;
		    	if ($rol==1 or 2) {
		    		$sql='SELECT b.ID_BASECONOCIMIENTOS id, b.NOMBRE_CONOCIMIENTOS nomb,b.OBSERVACIONES_BASECONOCIMIENTOS obcon FROM baseconocimientos as b';
		    		if ($resultado=$this->db->query($sql)) {
		    			$mensaje="";
		    			if($resultado->num_rows==0){
		    				$mensaje.='<tr><td colspan="5">No hay resultados</td></tr>';
		    			}else{
						   while ($user = $resultado->fetch_assoc()) {
						   	//En espera de funcuinamiento
						   		$id=$user['id'];
							    $mensaje.='<tr>'.
							    			'<td>'. $user['nomb'].'</td>'.
							    			'<td>'. $user['obcon'].'</td>'.
							    			'<td><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$id.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped baseME" data-refer=\''.$ids.'\' '.$this->tool('Detalles').'></i></td>'.
							    		'</tr>' ;
							}
						}
						include_once('../View/ajax/baseconocimientos.php');
					}
		    	}else{
		    		$mensaje="No tienes permiso para realizar esta operación";
		    	}
	    	//echo $mensaje;
	    }else{
    		echo $this->reload;
    	}
	}
	public function noResolve()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$mc='001';
    	$tit='sin reolver';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$mensaje=$this->getServicios(2);
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	private function getServicios($type,$admin=true,$iduser=0)	{
		$sql='SELECT s.ID_SOLICITUD ids, pe.NOMBRE_PERSONA nompe,pe.APELLIDO_PATERNO patpe,pe.APELLIDO_MATERNO matpe, pr.NOMBRE_PERSONA nompr,pr.APELLIDO_PATERNO patpr,pr.APELLIDO_MATERNO matpr,st.NOMBRE_STATUS st, s.NOMBRE_SOLICITUD sol,s.FECHA_CREADO enviado,s.DESCRIPCION_SOLICITUD des,s.FECHA_EDITADO recibido FROM solicitudes s,personas pr,personas pe, status st WHERE s.ID_PERSONA=pe.ID_PERSONA AND st.ID_STATUS=s.ID_STATUS AND s.PER_ID_PERSONA=pr.ID_PERSONA AND s.ID_STATUS='.$type;
		if ($admin) {
			$sql.=';';
		}else{
			$sql.=' AND pr.ID_PERSONA='.$iduser.';';
		}
		#echo $sql;
		$mensaje='';
		if ($resultado=$this->db->query($sql)) {
	    	if($resultado->num_rows==0){
	    		$mensaje.='<tr><td colspan="6">No hay resultados</td></tr>';
	    	}else{
				while ($row = $resultado->fetch_assoc()) {
					$ids=$row['ids'];
					$reciv=$row['recibido'];
					$mensaje.='<tr>'.
						'<td>'. $row['nompe'].' '. $row['patpe'].' '. $row['matpe'].'</td>';
					if ($admin) {
						$mensaje.='<td>'.$row['nompr'].' '. $row['patpr'].' '. $row['matpr'].'</td>';
					}
					$mensaje.='<td>'. $row['sol'].'</td>'.
						'<td>'. $row['des'].'</td>'.
						'<td>'. $this->getDate($row['enviado']).'</td>'.
						'<td><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$ids.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped detailM" data-refer=\''.$ids.'\' '.$this->tool('Detalles').'></i></td>'.
					'</tr>' ;
					if (is_null($reciv)&&!admin) {
						$this->servicioReciv($ids);
					}
				}
			}
		}
		return $mensaje;

	}
	private function tool($text,$pos='top'){
		return ' data-position="'.$pos.'" data-delay="50" data-tooltip="'.$text.'"';
	}
	private function servicioReciv($ids){
		$sql='UPDATE solicitudes SET FECHA_EDITADO=now() WHERE  ID_SOLICITUD='.$ids.';';
		if ($this->db->query($sql)) {
			return true;
		}else{
			return false;
		}
	}
	public function resolve(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$tit='resueltas';
    	$mc='002';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$mensaje=$this->getServicios(1);
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function noAing(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$mc='003';
    	$tit='no asignadas';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$mensaje=$this->getServicios(3);
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function grupos(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$sql='SELECT g.ID_GRUPO id,g.NOMBRE_GRUPO nom,g.OBSERVACION_GRUPO det  FROM grupos g;';
	    		if ($resultado=$this->db->query($sql)) {
	    			$mensaje="";
	    			if($resultado->num_rows==0){
	    				$mensaje.='<tr><td colspan="3">No hay resultados</td></tr>';
	    			}else{
					   while ($row = $resultado->fetch_assoc()) {
					   		$id=$row['id'];
						    $mensaje.='<tr>'.
						    			'<td>'. $row['nom'].'</td>'.
						    			'<td>'. $row['det'].'</td>'.
						    			'<th><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$id.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped grup" data-refer=\''.$id.'\' '.$this->tool('Detalles').'></i></th>'.
						    		'</tr>' ;
						}
					}
					include_once('../View/ajax/grupos.php');
				}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function salir(){
		@session_destroy(); echo 1;
	}
	private function getDate($date='')	{
		$sql='SELECT DAYNAME(NOW()) dia, DAY(NOW()) dian,MONTH(NOW()) mesn,MONTHNAME(NOW()) mes,YEAR(NOW()) ano ;';
		if ($date!='') {
			$sql="SELECT DAYNAME('".$date."') dia, DAY('".$date."') dian,MONTH('".$date."') mesn,MONTHNAME('".$date."') mes,YEAR('".$date."') ano ;";
		}
		$res=$this->db->get_data($sql);
		if ($res['STATUS']=='OK') {
			$res=$res['DATA'][0];
			//var_dump($res);
			if ($res['mesn']<10) {
				$res['mesn']='0'.$res['mesn'];
			}
			if ($res['dian']<10) {
				$res['dian']='0'.$res['dian'];
			}
			$date=$res['dian'].' de '.$res['mesn'].' del '.$res['ano'];
		}
		return $date;
	}
	public function empresas(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$sql='SELECT c.ID_COMPANIA id,c.NOMBRE_COMPANIA nom,c.OBSERVACION_COMPANIA det FROM companias c';
	    		if ($resultado=$this->db->query($sql)) {
	    			$mensaje="";
	    			if($resultado->num_rows==0){
	    				$mensaje.='<tr><td colspan="3">No hay resultados</td></tr>';
	    			}else{
					   while ($row = $resultado->fetch_assoc()) {
					   		$id=$row['id'];
						    $mensaje.='<tr>'.
						    			'<td>'. $row['nom'].'</td>'.
						    			'<td>'. $row['det'].'</td>'.
						    			'<th><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$id.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped empre" data-refer=\''.$id.'\' '.$this->tool('Detalles').'></i></th>'.
						    		'</tr>';
						}
					}
					include_once('../View/ajax/empresas.php');
				}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function categorias(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==1) {
	    		$sql='SELECT c.ID_CATEGORIA id,c.NOMBRE_CATEGORIA nom,c.DESCRIPCION_CATEGORIA det FROM categorias c;';
	    		if ($resultado=$this->db->query($sql)) {
	    			$mensaje="";
	    			if($resultado->num_rows==0){
	    				$mensaje.='<tr><td colspan="3">No hay resultados</td></tr>';
	    			}else{
					   while ($row = $resultado->fetch_assoc()) {
					   		$id=$row['id'];
						    $mensaje.='<tr>'.
						    			'<td>'. $row['nom'].'</td>'.
						    			'<td>'. $row['det'].'</td>'.
						    			'<th><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$id.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped cate" data-refer=\''.$id.'\' '.$this->tool('Detalles').'></i></th>'.
						    		'</tr>';
						}
					}
					include_once('../View/ajax/categorias.php');
				}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function missolicitudresolve(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$tit='resueltas';
    	$mc='002';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==3) {
	    		$mensaje=$this->getServiciosUF(1,false,$id);
	    		#echo "sadsadsadasdasdsadasd";
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function missolicitudnoresolve(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$tit='resueltas';
    	$mc='002';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==3) {
	    		$mensaje=$this->getServiciosUF(1,false,$id);
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function missolicitudwait(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$tit='resueltas';
    	$mc='002';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		//echo $rol;
	    	if ($rol==3) {
	    		$mensaje=$this->getServiciosUF(3,false,$id);
				include_once('../View/ajax/solicitudes.php');
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	private function getServiciosUF($type,$admin=true,$iduser=0)	{
		$sql='SELECT s.ID_SOLICITUD ids, pe.NOMBRE_PERSONA nompe,pe.APELLIDO_PATERNO patpe,pe.APELLIDO_MATERNO matpe,st.NOMBRE_STATUS st, s.NOMBRE_SOLICITUD sol,s.FECHA_CREADO enviado,s.DESCRIPCION_SOLICITUD des,s.FECHA_EDITADO recibido FROM solicitudes s,personas pe, status st WHERE s.ID_PERSONA=pe.ID_PERSONA AND st.ID_STATUS=s.ID_STATUS AND s.ID_STATUS='.$type;
		if ($admin) {
			$sql.=';';
		}else{
			$sql.=' AND pe.ID_PERSONA='.$iduser.';';
		}
		#echo $sql;
		$mensaje='';
		if ($resultado=$this->db->query($sql)) {
	    	if($resultado->num_rows==0){
	    		$mensaje.='<tr><td colspan="6">No hay resultados</td></tr>';
	    	}else{
				while ($row = $resultado->fetch_assoc()) {
					$ids=$row['ids'];
					$reciv=$row['recibido'];
					$mensaje.='<tr>'.
						'<td>'. $row['nompe'].' '. $row['patpe'].' '. $row['matpe'].'</td>';
					if ($admin) {
						$mensaje.='<td>'.$row['nompr'].' '. $row['patpr'].' '. $row['matpr'].'</td>';
					}
					$mensaje.='<td>'. $row['sol'].'</td>'.
						'<td>'. $row['des'].'</td>'.
						'<td>'. $this->getDate($row['enviado']).'</td>'.
						'<td><i class="fas fa-trash point p03 fa-lg red-text tooltipped" onclick="app.eliminar('.$ids.')"'.$this->tool('Eliminar').'></i>'.
						'<i class="fas fa-info-circle p03 fa-lg point blue-text tooltipped detailM" data-refer=\''.$ids.'\' '.$this->tool('Detalles').'></i></td>'.
					'</tr>' ;
					if (is_null($reciv)&&!admin) {
						$this->servicioReciv($ids);
					}
				}
			}
		}
		return $mensaje;

	}
}
?>