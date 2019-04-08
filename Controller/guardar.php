<?php 
@session_start();
include_once "../Model/database.php";
$dir=$_POST['dir'];
$pet=new Guardar();
if ($dir) {
	if (method_exists($pet, $dir)) {
		$pet->{$dir}();
	}else{
		echo 'Not Found '.$dir;
	}
}else{echo 'Not Found empty directory';}
/**
 * guardar en base de datos
 */
class Guardar{
	public function __construct() {
 	$this->db= new Database();
    }
    public function password() {
    	$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol) {
	    		$psa=$_POST['psa'];//contraseña anterior
	    		$psn=$_POST['psn'];//nueva
	    		if ($psa==null||$psa=='undefined'||$psn==null||$psn=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$psa=md5($psa);
	    			$psn=md5($psn);
	    			if($psa==$psn){
	    				$mensaje="No puede asignarse la mísma contraseña";
	    			}else{
	    				if($this->verifipas($id,$psa)){
	    					$sql="UPDATE personas   SET CONTRASENA='".$psn."' WHERE ID_PERSONA=".$id.";";
	    					if($this->db->query($sql)){
	    						$mensaje= 1;
	    					}else{
	    						$mensaje="Error al intentar guardar la contraseña";
	    					}	    					
	    				}else{
	    					$mensaje='La contraseña anterior no es correcta';
	    				}
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
    }
    private function verifipas($idu,$pas){
    	$retornar=false;
    	$sql="select * from personas p where p.ID_PERSONA=".$idu." and p.CONTRASENA='".$pas."';";
    	$res=$this->db->query($sql);
    	$fila=$res->fetch_assoc();
    	if ($fila!=null) {
	 		$retornar=true;
	 	}
	 	return $retornar;
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
	public function nuevogrupo(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO grupos (NOMBRE_GRUPO, OBSERVACION_GRUPO) VALUES ('".$nombre."', '".$detalle."');";
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al guardar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function remgrupo(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		if ($ref==null||$ref=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="DELETE FROM grupos WHERE ID_GRUPO=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al eliminar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function editargrupo(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($ref==null||$ref=='undefined'||$nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="UPDATE grupos SET NOMBRE_GRUPO='".$nombre."', OBSERVACION_GRUPO='".$detalle."' WHERE  ID_GRUPO=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al actualizar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	//para servicicios _--------------------------->>>>>>>>>>>>>
	public function nuevoservice(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		$cat=$_POST['cat'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined'||$cat==null||$cat=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO servicios (ID_CATEGORIA, NOMBRE_SERVICIO,DIRECCION_SERVICIO) VALUES (".$cat.",'".$nombre."', '".$detalle."');";
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al guardar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function remservicio(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		if ($ref==null||$ref=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="DELETE FROM servicios WHERE ID_SERVICIO=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al eliminar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function editarservice()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		$cat=$_POST['cat'];
	    		if ($ref==null||$ref=='undefined'||$nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined'||$cat==null||$cat=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="UPDATE servicios SET ID_CATEGORIA=".$cat.", NOMBRE_SERVICIO='".$nombre."', DIRECCION_SERVICIO='".$detalle."' WHERE  ID_SERVICIO=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al actualizar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	private function isDependEmpresa($id){
		$sql='select count(p.ID_PERSONA) num from personas p where p.ID_COMPANIA='.$id.';';
		$num=false;
		$res=$this->db->get_data($sql);
		if ($res['STATUS']=='OK') {
			foreach ($res['DATA'] as $val) {
				$num=$val['num'];
			}
		}
		return $num;
	}
	public function remempresa(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    		$ref=$_POST['ref'];
	    		$depende=$this->isDependEmpresa($ref);
	    		if ($depende) {
	    			$mensaje='Error, la empresa tiene '.$depende.' dependencias';
	    		}else{
		    		$sql="DELETE FROM companias WHERE  ID_COMPANIA=".$ref.";";
		    		//echo $sql;
		    		if ($this->db->query($sql)) {
		    			$mensaje=1;
		    		}else{
		    			$mensaje='Error al eliminar datos';
		    		}
	    		}
	    }else{
	    	$mensaje="No tienes permiso para realizar esta operación";
	    }
    	echo $mensaje;
	}
	public function nuevaempre(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO companias(NOMBRE_COMPANIA,OBSERVACION_COMPANIA) VALUES  ('".$nombre."', '".$detalle."');";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al actualizar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function editarempre(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($ref==null||$ref=='undefined'||$nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="UPDATE companias SET  NOMBRE_COMPANIA='".$nombre."', OBSERVACION_COMPANIA='".$detalle."' WHERE  ID_COMPANIA=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al actualizar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	private function isDependcategory($id)	{
		$sql='select count(s.ID_SERVICIO) num from servicios s where s.ID_CATEGORIA='.$id.';';
		$num=false;
		$res=$this->db->get_data($sql);
		if ($res['STATUS']=='OK') {
			foreach ($res['DATA'] as $val) {
				$num=$val['num'];
			}
		}
		return $num;
	}
	public function remcategoria()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    		$ref=$_POST['ref'];
	    		$depende=$this->isDependcategory($ref);
	    		if ($depende) {
	    			$mensaje='Error, la categoría tiene '.$depende.' dependencias';
	    		}else{
		    		$sql="DELETE FROM categorias WHERE  ID_CATEGORIA=".$ref.";";
		    		//echo $sql;
		    		if ($this->db->query($sql)) {
		    			$mensaje=1;
		    		}else{
		    			$mensaje='Error al eliminar datos';
		    		}
	    		}
	    }else{
	    	$mensaje="No tienes permiso para realizar esta operación";
	    }
    	echo $mensaje;
	}
	public function nuevacatego(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO categorias(NOMBRE_CATEGORIA,DESCRIPCION_CATEGORIA) VALUES  ('".$nombre."', '".$detalle."');";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al guardar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function editarcatego(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$ref=$_POST['ref'];
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($ref==null||$ref=='undefined'||$nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="UPDATE categorias SET  NOMBRE_CATEGORIA='".$nombre."', DESCRIPCION_CATEGORIA='".$detalle."' WHERE  ID_CATEGORIA=".$ref.";";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al actualizar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	/////////base conocimientos
	public function nuevabase(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==1) {
	    		$nombre=$_POST['nom'];
	    		$detalle=$_POST['det'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO baseconocimientos(NOMBRE_CONOCIMIENTOS,OBSERVACIONES_BASECONOCIMIENTOS) VALUES  ('".$nombre."', '".$detalle."');";
	    			//echo $sql;
	    			if ($this->db->query($sql)) {
	    				$mensaje=1;
	    			}else{
	    				$mensaje='Error al guardar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
	public function rembase(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    		$ref=$_POST['ref'];
		    		$sql="DELETE FROM baseconocimientos WHERE  ID_BASECONOCIMIENTOS=".$ref.";";
		    		//echo $sql;
		    		if ($this->db->query($sql)) {
		    			$mensaje=1;
		    		}else{
		    			$mensaje='Error al eliminar datos';
		    		}
	    }else{
	    	$mensaje="No tienes permiso para realizar esta operación";
	    }
    	echo $mensaje;
	}
	/***************************************************solicitudes*******************/
	public function nuevasolicitud(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
	    	if ($rol==3) {
	    		$nombre=$_POST['nombre'];
	    		$detalle=$_POST['detalles'];
	    		$tipo=$_POST['tipo'];
	    		if ($nombre==null||$nombre=='undefined'||$detalle==null||$detalle=='undefined'||$tipo==null||$thipo=='0') {
	    			$mensaje='Faltan parametros';
	    		}else{
	    			$sql="INSERT INTO solicitudes(ID_TIPO,ID_PERSONA,ID_STATUS,NOMBRE_SOLICITUD,FECHA_CREADO,DESCRIPCION_SOLICITUD) VALUES  (".$tipo.",".$id.",3,'".$nombre."',now(), '".$detalle."');";
	    			//echo $sql;
	    			$result=$this->db->exec($sql);
	    			//var_dump($result);
	    			if ($result['STATUS']=='OK') {
	    				$mensaje=1;
	    			}else{
	    				echo $result['ERROR'];
	    				$mensaje='Error al guardar datos';
	    			}
	    		}
	    	}else{
	    		$mensaje="No tienes permiso para realizar esta operación";
	    	}
    	}
    	echo $mensaje;
	}
}

 ?>