<?php 
@session_start();
include_once "../Model/database.php";
$dir=$_POST['dir'];
$pet=new Detalles();
if ($dir) {
	if (method_exists($pet, $dir)) {
		$pet->{$dir}();
	}else{
		echo 'Not Found '.$dir;
	}
}else{echo 'Not Found empty directory';}

/**
 * @ Clase detalles, para cargar detalles de los elentos
 */
class Detalles{
	/**
     * En el constructor se inicializa la clase de base de datos
     */
    public $reload="<p>es necesario recargar la página. Haz click <a href='#' onclick='window.location.reload();'>aquí</a>.</p>";
    public function __construct(){
        $this->db = new Database();
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
	public function solicitud()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	$mc='001';
    	$tit='sin reolver';
    	//echo $id;
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
    		$sql='SELECT s.ID_SOLICITUD,s.ID_PRIORIDAD,s.ID_TIPO,s.ID_STATUS,s.ID_FUENTE,s.ID_PERSONA,s.PER_ID_PERSONA,s.NOMBRE_SOLICITUD,s.FECHA_CREADO,s.FECHA_EDITADO,s.FECHA_RESUELTO,s.IMAGEN_SOLICITUD,s.DESCRIPCION_SOLICITUD,s.ARCHIVOS,s.RESPUESTA_AGENTE,p.NOMBRE_PRIORIDAD,p.OBSERVACIONES_PRIORIDADES,pe.ID_PERSONA idenvia,pe.NOMBRE_PERSONA nomenvia,pe.APELLIDO_PATERNO paenvia,pe.APELLIDO_MATERNO maenvia FROM solicitudes s,prioridades p,personas pe WHERE s.ID_PRIORIDAD=p.ID_PRIORIDAD AND pe.ID_PERSONA=s.ID_PERSONA AND s.ID_SOLICITUD='.$ref;
	    	if ($rol==1) {
	    		$sql='SELECT s.ID_SOLICITUD,s.ID_PRIORIDAD,s.ID_TIPO,s.ID_STATUS,s.ID_FUENTE,s.ID_PERSONA,s.PER_ID_PERSONA,s.NOMBRE_SOLICITUD,s.FECHA_CREADO,s.FECHA_EDITADO,s.FECHA_RESUELTO,s.IMAGEN_SOLICITUD,s.DESCRIPCION_SOLICITUD,s.ARCHIVOS,s.RESPUESTA_AGENTE,p.NOMBRE_PRIORIDAD,p.OBSERVACIONES_PRIORIDADES,pe.ID_PERSONA idenvia,pe.NOMBRE_PERSONA nomenvia,pe.APELLIDO_PATERNO paenvia,pe.APELLIDO_MATERNO maenvia,pr.NOMBRE_PERSONA nomrecibe,pr.APELLIDO_PATERNO parecive,pr.APELLIDO_MATERNO marecive,pr.ID_PERSONA idrecive FROM solicitudes s,prioridades p,personas pe,personas pr WHERE s.ID_PRIORIDAD=p.ID_PRIORIDAD AND pe.ID_PERSONA=s.ID_PERSONA AND pr.ID_PERSONA=s.PER_ID_PERSONA AND s.ID_SOLICITUD='.$ref;
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		include_once('../View/ajax/detalles/solicitud.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}





	public function grupo()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
	    	if ($rol==1) {
	    		$sql='SELECT g.ID_GRUPO id,g.NOMBRE_GRUPO nom,g.OBSERVACION_GRUPO det  FROM grupos g WHERE g.ID_GRUPO='.$ref.';';
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		include_once('../View/ajax/detalles/grupC.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function servicio(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
	    	if ($rol==1) {
	    		$sql='SELECT s.ID_SERVICIO id, c.ID_CATEGORIA idc, c.NOMBRE_CATEGORIA cat, s.NOMBRE_SERVICIO nomser, s.DIRECCION_SERVICIO dirser FROM servicios as s, categorias as c WHERE c.ID_CATEGORIA = s.ID_CATEGORIA AND s.ID_SERVICIO='.$ref.';';
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		$categorias=$this->getCategoriasSel($datos['idc']);
	    		include_once('../View/ajax/detalles/servicio.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	private function getCategoriasSel($id='') {
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
	public function empresa(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
	    	if ($rol==1) {
	    		$sql='SELECT c.ID_COMPANIA id,c.NOMBRE_COMPANIA nom,c.OBSERVACION_COMPANIA det FROM companias c WHERE c.ID_COMPANIA = '.$ref.';';
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		$categorias=$this->getCategoriasSel($datos['idc']);
	    		include_once('../View/ajax/detalles/empresa.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function categoria()	{
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
	    	if ($rol==1) {
	    		$sql='SELECT c.ID_CATEGORIA id,c.NOMBRE_CATEGORIA nom,c.DESCRIPCION_CATEGORIA det FROM categorias c WHERE c.ID_CATEGORIA = '.$ref.';';
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		$categorias=$this->getCategoriasSel($datos['idc']);
	    		include_once('../View/ajax/detalles/categoria.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}
	public function base(){
		$id=$this->getId();
    	$mensaje="Error en la sesión";
    	$error=true;
    	$datos="";
    	if ($id!=0) {
    		$rol=$this->getRol($id);
    		$ref=$_POST['ref'];
	    	if ($rol==1) {
	    		$sql='SELECT c.ID_CATEGORIA id,c.NOMBRE_CATEGORIA nom,c.DESCRIPCION_CATEGORIA det FROM categorias c WHERE c.ID_CATEGORIA = '.$ref.';';
	    	}
	    	$query=$this->db->get_data($sql);
	    	if ($query['STATUS']=='OK') {
	    		$datos=$query['DATA'][0];
	    		include_once('../View/ajax/detalles/categoria.php');
	    	}else{
	    		echo "Error inesperado";
	    	}
    	}else{
    		echo $this->reload;
    	}
	}

}
