<?php 
 function getRol($id=false){
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

 ?>