<?php

function quitarEspacios($tags) {
	$tags = str_replace(",     ",",",$tags);
	$tags = str_replace(",    ",",",$tags);
	$tags = str_replace(",   ",",",$tags);
	$tags = str_replace(",  ",",",$tags);
	$tags = str_replace(", ",",",$tags);

	return $tags;
}

	require_once('config.php');


	if ($_POST) {
		$idPost = $_POST['idPost'];
		$idGroup = $_POST['idGroup'];
		$tipo = $_POST['tipo'];
		$fromId = $_POST['from_id'];
		$fromName = $_POST['from_name'];
		$date = $_POST['timestamp'];
		$msg = $_POST['message'];
		$tags = $_POST['tags'];
		$tags = quitarEspacios($tags);

		$link = $_POST['link'];

		try{
			$conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
			$conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
	    	echo json_encode(array('result' => false, 'message' => $e->getMessage()));
		}

		$query = "INSERT INTO POST (idPost, idGroup, tipo, fecha, tags, from_id, from_name, message, link) VALUES ('$idPost', '$idGroup', '$tipo', '$date', '$tags', '$fromId', '$fromName', '$msg', '$link')";

		try{
			$conexion->query( $query );
			echo json_encode(array('result' => true));
		}catch ( PDOException $e ) {
			echo json_encode(array('result' => false, 'msg' => $url));
		}

	} else {

	}
?>
